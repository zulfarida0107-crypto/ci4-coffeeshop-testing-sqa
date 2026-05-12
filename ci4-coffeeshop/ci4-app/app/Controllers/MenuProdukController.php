<?php

namespace App\Controllers;

use App\Models\MenuProduk;

class MenuProdukController extends BaseController
{
    protected $model;

    public function __construct() {
        $this->model = new MenuProduk();
        $this->helpers = ['form', 'url'];
    }

    public function index() {
        $data = [
            'result' => $this->model->orderBy('id', 'desc')->paginate(10),
            'pager'  => $this->model->pager,
            'title'  => 'Daftar Menu Kopi & Pastry'
        ];
        return view('menu_produk/list', $data);
    }

    public function add() {
        $data = ['title' => 'Tambah Menu Baru'];
        return view('menu_produk/add', $data);
    }

    public function store() {
        if (!$this->validate([
            'nama_produk' => 'required|min_length[3]',
            'harga'       => 'required|numeric',
            'kategori'    => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        $this->model->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'kategori'    => $this->request->getPost('kategori'),
        ]);

        session()->setFlashdata('success', 'Menu berhasil ditambahkan!');
        return redirect()->to(base_url('menu-produk'));
    }



    // ... (fungsi index, add, dan store sudah ada) ...

    /**
     * Membuka halaman form edit menu
     */
    public function edit($id) {
        $menu = $this->model->find($id); // Mencari data berdasarkan ID

        if (!$menu) {
            session()->setFlashdata('error', 'Menu tidak ditemukan!');
            return redirect()->to(base_url('menu-produk'));
        }

        $data = [
            'title'  => 'Edit Menu: ' . $menu['nama_produk'],
            'result' => $menu, // Mengirim satu baris data ke view
        ];

        return view('menu_produk/edit', $data);
    }

    /**
     * Memperbarui data menu di database
     */
    public function update($id) {
        // Validasi input sama seperti saat simpan baru
        if (!$this->validate([
            'nama_produk' => 'required|min_length[3]',
            'harga'       => 'required|numeric',
            'kategori'    => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        // Melakukan update berdasarkan ID
        $this->model->update($id, [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'kategori'    => $this->request->getPost('kategori'),
        ]);

        session()->setFlashdata('success', 'Menu berhasil diperbarui!');
        return redirect()->to(base_url('menu-produk'));
    }

    /**
     * Menghapus menu dari database
     */
    /**
     * Menghapus data menu berdasarkan ID
     */
    public function destroy($id)
    {
        // Mengecek apakah data dengan ID tersebut ada di database
        $menu = $this->model->find($id);

        if ($menu) {
            // Jika ada, lakukan penghapusan
            $this->model->delete($id);
            session()->setFlashdata('success', 'Menu "' . $menu['nama_produk'] . '" berhasil dihapus.');
        } else {
            // Jika data tidak ditemukan
            session()->setFlashdata('error', 'Gagal menghapus! Data menu tidak ditemukan.');
        }

        // Kembali ke halaman daftar menu
        return redirect()->to(base_url('menu-produk'));
    }

    /**
     * Menampilkan detail satu menu produk
     */
    public function show($id)
    {
        $model = new \App\Models\MenuProduk(); // Ganti sesuai model yang relevan
        $data['result'] = $model->find($id);

        if (empty($data['result'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }

        $data['title'] = 'Detail Produk';
        return view('menu_produk/show', $data); // Pastikan path view benar
    }
}