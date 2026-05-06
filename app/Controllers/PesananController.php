<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pesanan; 
use App\Models\MenuProduk; // Sesuaikan jika nama model menu Anda berbeda

class PesananController extends BaseController
{
    protected $pesananModel;

    public function __construct() {
        // Inisialisasi model pesanan
        $this->pesananModel = new Pesanan();
        $this->helpers = ['form', 'url'];
    }

    /**
     * Menampilkan daftar pesanan dengan join ke tabel menu_produk
     */
    public function index() {
        $data = [
            'result' => $this->pesananModel->select('pesanan.*, menu_produk.nama_produk')
                                           ->join('menu_produk', 'menu_produk.id = pesanan.id_produk', 'left')
                                           ->orderBy('pesanan.id', 'desc')
                                           ->paginate(10),
            'pager'  => $this->pesananModel->pager,
            'title'  => 'Daftar Pesanan'
        ];
        return view('pesanan/list', $data);
    }

    /**
     * Membuka halaman tambah pesanan dengan data produk untuk dropdown
     */
    public function add() {
        session();
        $menuModel = new MenuProduk(); 
        
        $data = [
            'title'      => 'Tambah Pesanan Baru',
            'validation' => \Config\Services::validation(),
            'produk'     => $menuModel->findAll() // Untuk pilihan menu di add.php
        ];
        return view('pesanan/add', $data);
    }

    /**
     * Menyimpan data pesanan (Mendukung Multi-Menu)
     */
    public function store() {
        // Ambil data dari form
        $nama_pelanggan = $this->request->getPost('nama_pelanggan');
        $id_produk      = $this->request->getPost('id_produk'); // Array dari add.php
        $jumlah         = $this->request->getPost('jumlah');    // Array dari add.php
        $status_pesanan = $this->request->getPost('status_pesanan');
        $total_harga    = $this->request->getPost('total_harga'); // Total keseluruhan

        // Validasi dasar
        if (empty($nama_pelanggan) || empty($id_produk)) {
            session()->setFlashdata('error', 'Nama pelanggan dan menu wajib diisi.');
            return redirect()->back()->withInput();
        }

        $successCount = 0;

        // Looping untuk menyimpan setiap menu yang dipilih pelanggan
        foreach ($id_produk as $index => $prodId) {
            if (!empty($prodId)) {
                $dataSimpan = [
                    'nama_pelanggan'  => $nama_pelanggan,
                    'id_produk'       => $prodId,
                    'jumlah'          => $jumlah[$index],
                    'total_harga'     => $total_harga, 
                    'status_pesanan'  => $status_pesanan,
                    'tanggal_pesanan' => date('Y-m-d H:i:s'), 
                ];
                
                // Simpan ke database
                if ($this->pesananModel->save($dataSimpan)) {
                    $successCount++;
                }
            }
        }

        if ($successCount > 0) {
            session()->setFlashdata('success', 'Pesanan berhasil disimpan.');
            return redirect()->to(base_url('pesanan'));
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan pesanan.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menghapus pesanan berdasarkan ID
     */
    public function destroy($id)
    {
        if ($this->pesananModel->delete($id)) {
            session()->setFlashdata('success', 'Pesanan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus pesanan.');
        }
        return redirect()->to(base_url('pesanan'));
    }

    // Fungsi update/edit bisa ditambahkan di sini dengan logika serupa
    public function edit($id)
    {
        session();
        $menuModel = new MenuProduk();
        
        // Mencari data pesanan berdasarkan ID
        $pesanan = $this->pesananModel->find($id);
        
        // Jika data tidak ditemukan, kembalikan ke halaman daftar
        if (empty($pesanan)) {
            session()->setFlashdata('error', 'Data pesanan tidak ditemukan');
            return redirect()->to('/pesanan');
        }

        $data = [
            'title'      => 'Edit Pesanan',
            'result'     => $pesanan, // Mengirim satu baris data ke view
            'produk'     => $menuModel->findAll(), // Mengambil daftar produk untuk dropdown
            'validation' => \Config\Services::validation()
        ];

        return view('pesanan/edit', $data);
    }

    /**
     * Memperbarui data pesanan (Logika sederhana per baris)
     */
    public function update($id)
    {
        // Mengambil data dari form sesuai kolom di database db_kantin2
        $dataUpdate = [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'id_produk'      => $this->request->getPost('id_produk'),
            'jumlah'         => $this->request->getPost('jumlah'),
            'total_harga'    => $this->request->getPost('total_harga'),
            'status_pesanan' => $this->request->getPost('status_pesanan')
        ];

        // Melakukan update ke database berdasarkan ID
        if ($this->pesananModel->update($id, $dataUpdate)) {
            session()->setFlashdata('success', 'Data pesanan berhasil diperbarui');
            return redirect()->to(base_url('pesanan'));
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data pesanan');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Menampilkan detail pesanan berdasarkan ID
     */
    public function show($id)
    {
        // Ambil data pesanan beserta nama produk, harga, dan kategori dari tabel menu_produk
        $pesanan = $this->pesananModel->select('pesanan.*, menu_produk.nama_produk, menu_produk.harga, menu_produk.kategori, menu_produk.deskripsi')
                                      ->join('menu_produk', 'menu_produk.id = pesanan.id_produk', 'left')
                                      ->where('pesanan.id', $id)
                                      ->first();

        // Jika data tidak ditemukan
        if (empty($pesanan)) {
            session()->setFlashdata('error', 'Detail pesanan tidak ditemukan');
            return redirect()->to('/pesanan');
        }

        $data = [
            'title'  => 'Detail Pesanan',
            'result' => $pesanan
        ];

        return view('pesanan/show', $data);
    }
}