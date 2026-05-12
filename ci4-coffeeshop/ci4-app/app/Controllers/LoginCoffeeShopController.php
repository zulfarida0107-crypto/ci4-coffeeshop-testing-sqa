<?php namespace App\Controllers;

use App\Models\User;

class LoginCoffeeShopController extends BaseController {
    
    public function index() {
        return view('login'); 
    }

    // public function auth() {
    //     $session = session();
    //     $model = new User();
        
    //     $username = $this->request->getVar('username');
    //     $password = $this->request->getVar('password');
        
    //     // Memanggil fungsi dari Model User
    //     $data = $model->where('username', $username)->first();
    //     if($data) {
    //         $pass = $data['password'];
    //         // Cek password (plain text atau hash)
    //         if(password_verify($password, $pass) || $password == $pass) {
    //             $ses_data = [
    //                 'id'        => $data['id'],
    //                 'username'  => $data['username'],
    //                 'role'      => $data['role'],
    //                 'logged_in' => TRUE
    //             ];
    //             $session->set($ses_data);
    //             return redirect()->to('/user');
    //         } else {
    //             $session->setFlashdata('error', 'Password Salah');
    //             return redirect()->to('/login');
    //         }
    //     } else {
    //         $session->setFlashdata('error', 'Username tidak ditemukan');
    //         return redirect()->to('/login');
    //     }
    // }

    public function auth() {
    $session = session();
    $model = new User();
    
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');
    
    // Cari user berdasarkan username
    $data = $model->where('username', $username)->first();

    if ($data) {
        // Ambil hash password dari database
        $hashPassword = $data['password'];

        // Verifikasi password input dengan hash di database atau text biasa (legacy)
        if (password_verify($password, $hashPassword) || $password === $hashPassword) {
            $ses_data = [
                'id'           => $data['id'],
                'username'     => $data['username'],
                'nama_lengkap' => $data['nama_lengkap'], // Tambahkan ini jika butuh sapaan nama
                'role'         => $data['role'],
                'logged_in'    => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/user');
        } else {
            // Jika password salah
            $session->setFlashdata('error', 'Password salah!');
            return redirect()->to('/login');
        }
    } else {
        // Jika username tidak ditemukan
        $session->setFlashdata('error', 'Username tidak ditemukan!');
        return redirect()->to('/login');
    }
}

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}