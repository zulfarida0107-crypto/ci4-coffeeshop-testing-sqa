<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesanKontak;

class PesanKontakController extends BaseController
{
    protected $pesanModel;

    public function __construct() {
        $this->pesanModel = new PesanKontak();
        $this->helpers = ['form', 'url'];
    }

    // READ: Menampilkan semua pesan (Dilengkapi fitur pagination)
    public function index() {
        $data = [
            'result' => $this->pesanModel->orderBy('id', 'desc')->paginate(10, 'pesan'),
            'pager'  => $this->pesanModel->pager,
            'title'  => 'Daftar Pesan Masuk'
        ];
        return view('pesan_kontak/list', $data);
    }

    // READ: Menampilkan detail pesan tertentu
    public function show($id)
    {
        $pesan = $this->pesanModel->find($id); 
        if (!$pesan) {
            session()->setFlashdata('error', 'Pesan tidak ditemukan.'); 
            return redirect()->to('/pesan-kontak');
        }
        $data = [
            'title'  => 'Detail Pesan: ' . $pesan['subjek'], 
            'result' => $pesan
        ];
        return view('pesan_kontak/show', $data);
    }

    // DELETE: Menghapus pesan
    public function destroy($id)
    {
        if ($this->pesanModel->find($id)) {
            $this->pesanModel->delete($id);
            session()->setFlashdata('success', 'Pesan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus! Pesan tidak ditemukan.');
        }
        return redirect()->to(base_url('pesan-kontak'));
    }

    // Jika ingin digunakan untuk form kontak di frontend
    public function add() {
        return view('pesan_kontak/add', ['title' => 'Kirim Pesan Baru']);
    }

    public function store() {
        $rules = [
            'nama'   => 'required',
            'email'  => 'required|valid_email',
            'subjek' => 'required',
            'pesan'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->pesanModel->save([
            'nama'            => $this->request->getPost('nama'),
            'email'           => $this->request->getPost('email'),
            'subjek'          => $this->request->getPost('subjek'),
            'pesan'           => $this->request->getPost('pesan'),
            'tanggal_dikirim' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'Pesan Anda telah terkirim.');
        return redirect()->to('/pesan-kontak');
    }
}