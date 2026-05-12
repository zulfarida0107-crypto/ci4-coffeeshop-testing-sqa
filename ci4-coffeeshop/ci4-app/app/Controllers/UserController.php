<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct() {
        $this->userModel = new User();
        $this->helpers = ['form', 'url'];
    }

    public function index() {
        $data = [
            'result' => $this->userModel->orderBy('id', 'desc')->paginate(10),
            'pager'  => $this->userModel->pager,
            'title'  => 'Manajemen User'
        ];
        return view('user/list', $data); 
    }

    public function add() {
        return view('user/add', ['title' => 'Tambah User']);
    }

    public function store() {
        if (!$this->validate([
            'username'     => 'required|is_unique[user.username]|min_length[4]',
            'password'     => 'required|min_length[5]',
            'nama_lengkap' => 'required',
            'role'         => 'required|in_list[admin,karyawan]',
        ])) {
            return redirect()->back()->withInput();
        }

        $this->userModel->save([
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => $this->request->getPost('role'),
        ]);

        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id) {
        $data = [
            'user'  => $this->userModel->find($id),
            'title' => 'Edit User'
        ];
        return view('user/edit', $data);
    }

    public function update($id) 
    {
        // Mengambil data dari input form
        $data = [
            'username'     => $this->request->getPost('username'), // Pastikan baris ini ada
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => $this->request->getPost('role'),
        ];

        // Proses update berdasarkan ID
        if ($this->userModel->update($id, $data)) {
            session()->setFlashdata('success', 'User berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data.');
        }

        return redirect()->to(base_url('user'));
    }

    public function destroy($id)
    {
        // Cek apakah user ada
        $user = $this->userModel->find($id);

        if ($user) {
            $this->userModel->delete($id);
            session()->setFlashdata('success', 'User <strong>' . $user['username'] . '</strong> berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'User tidak ditemukan.');
        }

        return redirect()->to(base_url('user'));
    }
}