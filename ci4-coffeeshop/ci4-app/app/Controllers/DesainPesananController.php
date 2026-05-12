<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DesainPesanan;

class DesainPesananController extends BaseController
{
    protected $model;

    public function __construct() {
        $this->model = new DesainPesanan();
        $this->helpers = ['form', 'url'];
    }

    public function index() {
        $data = [
            'result' => $this->model->orderBy('id', 'desc')->paginate(10),
            'pager'  => $this->model->pager,
            'title'  => 'Daftar Desain Pesanan'
        ];
        return view('desain_pesanan/list', $data);
    }

    public function add() {
        $data = [
            'title' => 'Tambah Desain Pesanan'
        ];
        return view('desain_pesanan/add', $data);
    }

    public function store() {
        $desain = [
            'id_pesanan'      => $this->request->getPost('id_pesanan'),
            'file_desain_url' => $this->request->getPost('file_desain_url'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'tanggal_upload'  => date('Y-m-d H:i:s'),
        ];

        if ($this->model->save($desain)) {
            session()->setFlashdata('success', 'Desain berhasil ditambahkan.');
            return redirect()->to(base_url('desain-pesanan'));
        }
        return redirect()->back()->withInput();
    }

    public function edit($id) {
        $desain = $this->model->find($id);
        if (!$desain) return redirect()->to('desain-pesanan');

        $data = [
            'title'  => 'Edit Desain Pesanan',
            'result' => $desain
        ];
        return view('desain_pesanan/edit', $data);
    }

    public function update($id) {
        $desain = [
            'id_pesanan'      => $this->request->getPost('id_pesanan'),
            'file_desain_url' => $this->request->getPost('file_desain_url'),
            'keterangan'      => $this->request->getPost('keterangan')
        ];

        $this->model->update($id, $desain);
        session()->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect()->to(base_url('desain-pesanan'));
    }

    public function destroy($id) {
        $this->model->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to(base_url('desain-pesanan'));
    }

    public function show($id) {
        $desain = $this->model->find($id);
        if (!$desain) {
            session()->setFlashdata('error', 'Detail desain pesanan tidak ditemukan');
            return redirect()->to('desain-pesanan');
        }

        $data = [
            'title'  => 'Detail Desain Pesanan',
            'result' => $desain
        ];
        return view('desain_pesanan/show', $data);
    }
}