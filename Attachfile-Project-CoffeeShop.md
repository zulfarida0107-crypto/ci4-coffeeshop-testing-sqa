# Attachfile-Project-CoffeeShop

## 1. TEST PLAN
### Overview
- **System Description**: Aplikasi web Kopi Kenangan Petang (Coffee Shop) yang dibangun menggunakan kerangka kerja (framework) CodeIgniter 4 (CI4). Aplikasi ini mencakup fitur pengelolaan menu produk, manajemen pesanan (termasuk pesanan custom/desain), pengelolaan kontak/pesan pelanggan, manajemen pengguna, dan sistem autentikasi (login).
- **Test Objectives**: Menguji fungsionalitas, keamanan, keandalan, dan performa dari aplikasi Coffee Shop untuk memastikan bahwa semua fitur berjalan sesuai dengan persyaratan bisnis dan spesifikasi teknis, serta bebas dari kecacatan (bug) yang kritis sebelum dirilis ke produksi.

### Scope of Test (Features to be Tested)
Modul utama yang akan diuji meliputi:
1. Autentikasi & Otorisasi (`LoginCoffeeShopController`)
2. Manajemen Pengguna (`UserController`, `UserModel`)
3. Manajemen Menu Produk (`MenuProdukController`, `MenuProdukModel`)
4. Manajemen Pesanan Reguler (`PesananController`, `PesananModel`)
5. Manajemen Pesanan Custom/Desain (`DesainPesananController`, `DesainPesananModel`)
6. Manajemen Pesan Kontak Pelanggan (`PesanKontakController`, `PesanKontakModel`)

### Plan
- **Test Team**: Quality Assurance (QA) Tester, System Analyst, dan Developer.
- **Staffing and Training Needs**: Tester perlu memahami PHPUnit untuk pengujian backend (Unit, Feature, Database) di CI4, Apache JMeter untuk pengujian beban, dan teknik pengujian keamanan aplikasi web.
- **Budget**: [Disesuaikan dengan alokasi operasional QA, lisensi staging server, dan testing tools].
- **Requirements**: Lingkungan server lokal (XAMPP), database MySQL, PHP 8.x, Composer, Node.js (opsional untuk build aset frontend), serta web browser untuk eksekusi pengujian manual.

---

## 2. TEST TECHNIQUES

### Operations Testing
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| OT-01 | Pengujian backup database | Data pesanan dan pengguna aktif | Database berhasil dibackup dengan ekstensi .sql | [Sesuai eksekusi] | Pass jika file .sql terbentuk dan dapat di-restore | Backup System |
| OT-02 | Pengujian restore database | File backup .sql | Sistem kembali ke state saat backup dilakukan | [Sesuai eksekusi] | Pass jika data kembali normal tanpa korupsi | Recovery System |

### Compliance Testing
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| CT-01 | Akses aplikasi di Google Chrome | URL Aplikasi | Tata letak dan fitur berfungsi normal | [Sesuai eksekusi] | Pass jika tidak ada error layout & script berjalan | Cross-browser |
| CT-02 | Akses aplikasi di Mozilla Firefox | URL Aplikasi | Tata letak dan fitur berfungsi normal | [Sesuai eksekusi] | Pass jika UI responsif dan fungsionalitas konsisten | Cross-browser |

### Security Testing
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| ST-01 | **SQL Injection** pada form Login | Username: `' OR 1=1 --` | Sistem menolak input dan gagal login | [Sesuai eksekusi] | Pass jika Query Builder CI4 mencegah injeksi SQL | **Revisi (Added)** |
| ST-02 | **SQL Injection** pada pencarian produk | Keyword: `'; DROP TABLE menu_produk; --` | Sistem melakukan escape karakter dan tidak mengeksekusi perintah SQL | [Sesuai eksekusi] | Pass jika tidak ada struktur DB yang terpengaruh | **Revisi (Added)** |
| ST-03 | Pengujian XSS pada form Pesan Kontak | Pesan: `<script>alert('xss')</script>` | Sistem menyimpan data sebagai string literal, script tidak dieksekusi | [Sesuai eksekusi] | Pass jika tag HTML di-encode (escaped) | Cross-Site Scripting |
| ST-04 | Pengujian Bypass URL Admin | Akses langsung ke `/user/dashboard` tanpa login | Redirect ke halaman login | [Sesuai eksekusi] | Pass jika Filter Auth CI4 memblokir akses | Broken Auth |
| ST-05 | CSRF Protection pada form Checkout | Submit data tanpa token CSRF valid | Transaksi ditolak (403 Forbidden) | [Sesuai eksekusi] | Pass jika CI4 memblokir request tanpa token CSRF valid | Cross-Site Request Forgery |

### Requirements Testing

> **Catatan Revisi:** Requirement CRUD dan Logika Pemrograman di-breakdown (dipisah) agar spesifik dan tidak dicampur.

**A. Modul Menu Produk (`MenuProdukController` & `MenuProdukModel`)**
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| RT-MP-01 | **CREATE**: Tambah Menu Baru | Nama: Kopi Susu, Harga: 20000 | Data tersimpan di database | [Sesuai eksekusi] | Pass jika query Insert berhasil (`Model->insert`) | CRUD - Create |
| RT-MP-02 | **READ**: Tampil Daftar Menu | - | Menampilkan semua data dari tabel `menu_produk` | [Sesuai eksekusi] | Pass jika data dirender ke view dengan benar | CRUD - Read |
| RT-MP-03 | **UPDATE**: Ubah Harga Menu | ID: 1, Harga Baru: 25000 | Data di tabel diperbarui | [Sesuai eksekusi] | Pass jika query Update berhasil (`Model->update`) | CRUD - Update |
| RT-MP-04 | **DELETE**: Hapus Menu | ID: 1 | Data terhapus dari database | [Sesuai eksekusi] | Pass jika query Delete berhasil (`Model->delete`) | CRUD - Delete |
| RT-MP-05 | **LOGIC**: Validasi Format Input Form | Nama Produk: "", Harga: "huruf" | Sistem menolak input form dan redirect kembali | [Sesuai eksekusi] | Pass jika error `required`, `min_length[3]`, dan `numeric` mencegah insert | **Logika Pemrograman** |

**B. Modul Pesanan Reguler (`PesananController` & `PesananModel`)**
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| RT-P-01 | **CREATE**: Buat Pesanan Baru | ID Produk: 2, Qty: 3 | Record pesanan baru dibuat | [Sesuai eksekusi] | Pass jika transaksi pesanan tercatat di tabel `pesanan` | CRUD - Create |
| RT-P-02 | **READ**: Detail Pesanan (Join Tabel) | ID Pesanan: 1 | Menampilkan detail pesanan berserta info nama dan harga produk | [Sesuai eksekusi] | Pass jika relasi JOIN tabel `menu_produk` berjalan sukses di fungsi `show()` | CRUD - Read |
| RT-P-03 | **UPDATE**: Ubah Data Pesanan | ID Pesanan: 10, Status: 'Selesai' | Data pesanan berhasil diperbarui | [Sesuai eksekusi] | Pass jika proses update baris data sukses | CRUD - Update |
| RT-P-04 | **DELETE**: Hapus Pesanan | ID Pesanan: 10 | Pesanan dihapus selamanya dari DB | [Sesuai eksekusi] | Pass jika fungsi `destroy()` menghapus data | CRUD - Delete |
| RT-P-05 | **LOGIC**: Simpan Multi-Menu Item | Array `id_produk`: [1,2], Array `jumlah`: [1,2] | Dua baris row data tersimpan di tabel `pesanan` untuk pelanggan yang sama | [Sesuai eksekusi] | Pass jika logika iterasi (looping) array data berhasil menyimpan banyak data | **Logika Pemrograman** |
| RT-P-06 | **LOGIC**: Validasi Keamanan Input | Nama Pelanggan: KOSONG | Fungsi `store()` membatalkan simpan multi-menu | [Sesuai eksekusi] | Pass jika logika `if (empty($nama_pelanggan))` terpicu | **Logika Pemrograman** |

**C. Modul Desain Pesanan / Custom Cake (`DesainPesananController` & `DesainPesananModel`)**
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| RT-DP-01 | **CREATE**: Tambah Request Desain | Keterangan desain & ID Pesanan | Data pesanan custom tersimpan | [Sesuai eksekusi] | Pass jika fungsi `store()` menyimpan data | CRUD - Create |
| RT-DP-02 | **READ**: Detail Request Desain | ID Desain: 3 | Menampilkan spesifikasi custom | [Sesuai eksekusi] | Pass jika view menampilkan detail request spesifik | CRUD - Read |
| RT-DP-03 | **UPDATE**: Update Request Desain | ID: 3, Keterangan baru | Keterangan berubah | [Sesuai eksekusi] | Pass jika data terupdate melalui `update()` | CRUD - Update |
| RT-DP-04 | **DELETE**: Hapus Request Custom | ID: 3 | Request custom dihapus | [Sesuai eksekusi] | Pass jika data terhapus melalui `destroy()` | CRUD - Delete |
| RT-DP-05 | **LOGIC**: Autogenerate Tanggal Upload | Input form disubmit tanpa field tanggal | Tanggal terekam sesuai waktu server pada field `tanggal_upload` | [Sesuai eksekusi] | Pass jika logika fungsi PHP `date('Y-m-d H:i:s')` dieksekusi otomatis oleh Controller | **Logika Pemrograman** |

**D. Modul Kontak (`PesanKontakController` & `PesanKontakModel`)**
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| RT-K-01 | **CREATE**: Kirim Pesan | Nama: Budi, Pesan: "Tanya" | Pesan tersimpan | [Sesuai eksekusi] | Pass jika `save()` berhasil memposting data kontak | CRUD - Create |
| RT-K-02 | **READ**: Baca Pesan Masuk | - | Menampilkan list pesan beserta pagination | [Sesuai eksekusi] | Pass jika `paginate(10, 'pesan')` berjalan | CRUD - Read |
| RT-K-03 | **DELETE**: Hapus Pesan Inbox | ID: 5 | Pesan terhapus dari inbox | [Sesuai eksekusi] | Pass jika proses `delete()` dieksekusi | CRUD - Delete |
| RT-K-04 | **LOGIC**: Validasi Format Email | Email: "budimail.com" | Controller menolak query dan kembali ke form input | [Sesuai eksekusi] | Pass jika validasi CI4 aturan `valid_email` berhasil menghentikan proses | **Logika Pemrograman** |
| RT-K-05 | **LOGIC**: Autogenerate Tanggal Dikirim | Pesan Baru dikirim | Field `tanggal_dikirim` otomatis terekam berdasarkan timestamp | [Sesuai eksekusi] | Pass jika baris kode pengisian tanggal sistem tereksekusi akurat | **Logika Pemrograman** |

**E. Modul User & Login (`UserController`, `UserModel`, `LoginCoffeeShopController`)**
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| RT-U-01 | **CREATE**: Registrasi User Baru | Username, Nama, Role Admin | User masuk ke database | [Sesuai eksekusi] | Pass jika data user baru dapat tersimpan | CRUD - Create |
| RT-U-02 | **READ**: Tampil List User | - | Admin dapat melihat list akun user | [Sesuai eksekusi] | Pass jika pagination user muncul normal | CRUD - Read |
| RT-U-03 | **UPDATE**: Edit Info Role/Username | User ID: 1, Role: karyawan | Data profil user diperbarui | [Sesuai eksekusi] | Pass jika perubahan data profil akun berhasil | CRUD - Update |
| RT-U-04 | **DELETE**: Hapus User | ID User: 2 | Akun terhapus total dari DB | [Sesuai eksekusi] | Pass jika akun dinonaktifkan (dihapus data dari tabel) | CRUD - Delete |
| RT-U-05 | **LOGIC**: Hashing Password Kriptografi | Input Password: "admin" | Password disimpan bukan sebagai plain text, melainkan string teracak (hash bcrypt) | [Sesuai eksekusi] | Pass jika logika `password_hash()` dieksekusi sebelum controller menyentuh model | **Logika Pemrograman** |
| RT-U-06 | **LOGIC**: Verifikasi Login (Legacy Fallback) | Username Valid, Password Valid | User masuk dan sistem membuat Array Sesson berisi info nama dan role akun | [Sesuai eksekusi] | Pass jika pengecekan kombinasi `password_verify` beserta fungsi `session()->set()` berhasil memfasilitasi auth login | **Logika Pemrograman** |
| RT-U-07 | **LOGIC**: Validasi Aturan Role Spesifik | Role: "SuperAdmin" | Form create user menolak inputan | [Sesuai eksekusi] | Pass jika pengecekan role `in_list[admin,karyawan]` dan `is_unique[username]` sukses | **Logika Pemrograman** |

### Regression Testing
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| RGT-01 | Verifikasi form pemesanan setelah update modul diskon / ongkir | Pesanan standar | Modul pemesanan reguler tetap bekerja normal tanpa merusak fitur lama | [Sesuai eksekusi] | Pass jika tidak ada fungsionalitas lama yang patah (broken) | Regression Test |
| RGT-02 | Verifikasi halaman list produk setelah perbaikan fitur upload image | Akses `/produk` | Gambar produk lama tetap tampil normal, gambar baru masuk | [Sesuai eksekusi] | Pass jika `img src` mengarah ke path yang benar | Regression Test |

### Error Handling Testing
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| EHT-01 | Submit form tanpa mengisi field mandatory (Required) | Data form kosong | Muncul alert/pesan error validasi merah untuk setiap field yang kosong | [Sesuai eksekusi] | Pass jika validasi server-side (`$validation->getErrors()`) merespon | Error Handling |
| EHT-02 | Akses URL record yang tidak ada (misal detail id=999) | ID: 999 | Sistem menampilkan halaman 404 Page Not Found | [Sesuai eksekusi] | Pass jika ditangani dengan `PageNotFoundException` CI4 | Error Handling |

### Manual Support Testing
| S. No | Test Cases | Test Data | Expected Test Result | Actual Test Result | Pass or Fail Test Criteria | Comments |
|---|---|---|---|---|---|---|
| MST-01 | Pengujian UI/UX (Kemudahan navigasi menu) | Pengguna awam mencari tombol checkout | Pengguna dapat menemukan tombol Keranjang/Pesan dengan mudah | [Sesuai eksekusi] | Pass jika flow UX jelas (Usability baik) | Manual Test |
| MST-02 | Keterbacaan dan kejelasan Notifikasi Flashdata | Menyimpan data berhasil | Tampil pesan hijau "Data berhasil disimpan!" yang jelas di atas form | [Sesuai eksekusi] | Pass jika user langsung memahami status aksi terakhirnya | Manual Test |

---

## 3. TEST ENVIRONMENT

- **Hardware**: Laptop/PC dengan spesifikasi memadai (Min: RAM 4GB, Processor sekelas Core i3/Ryzen 3)
- **Operating System**: Windows / macOS / Linux
- **Software**: 
  - **Server Service**: XAMPP / MAMP / LAMP Stack (Menyediakan Apache & MySQL)
  - **Framework**: CodeIgniter 4 (PHP 8.1+)
  - **Dependency Manager**: Composer
  - **Browser Validasi**: Google Chrome, Mozilla Firefox (Versi stabil terbaru)

---

## 4. TESTING TOOLS

### Unit & Feature Testing Tools
Alat yang digunakan: **PHPUnit** (Terintegrasi dengan CI4).
Menguji komponen di dalam folder `tests/unit`, `tests/feature`, dan `tests/database`.
| S. No | Conditions | Output | Pass/Failed |
|---|---|---|---|
| UT-01 | `phpunit tests/unit/DesainPesananModelTest.php` | AssertTrue untuk test validasi Model DB | [Sesuai eksekusi] |
| UT-02 | `phpunit tests/database/MenuProdukDatabaseTest.php` | AssertDatabaseHas setelah simulasi insert db | [Sesuai eksekusi] |
| UT-03 | `phpunit tests/feature/PesananControllerTest.php` | AssertOK (200) saat hit routing HTTP Controller | [Sesuai eksekusi] |

### Manual Tools & Load Testing Tools
Alat yang digunakan: **Browser Developer Tools** (Manual) & **Apache JMeter** (Load/Performance).
| S. No | Conditions | Output | Pass/Failed |
|---|---|---|---|
| MT-01 | Black-box eksekusi manual via GUI Browser | Seluruh flow berjalan lancar dari form ke database | [Sesuai eksekusi] |
| MT-02 | Load test file `tests/jmeter/CoffeeshopLoadTest.jmx` | View Results Tree hijau, Response time dapat diterima, Error 0% | [Sesuai eksekusi] |

---

## 5. ACCEPTANCE TESTING

| S.No | Acceptance Criteria | Critical Success Factors of the Software (Yes/No) | Test Results (Accept/Reject) | Comments |
|---|---|---|---|---|
| AT-01 | Pengguna dapat melihat menu, melakukan pemesanan (reguler dan desain custom), serta mengirim pesan secara sukses | Yes | [Accept/Reject] | Kriteria lulus utama pengguna |
| AT-02 | Proses login, registrasi, dan pengaturan sesi (session auth) berfungsi dengan aman dan persisten | Yes | [Accept/Reject] | Autentikasi |
| AT-03 | Admin dapat mengelola penuh semua modul (Menu, Pesanan, User, Kontak) via dashboard admin secara real-time | Yes | [Accept/Reject] | Manajemen Data |
| AT-04 | Website dapat diakses dengan cepat dan tidak down saat disimulasikan menggunakan jMeter load test | Yes | [Accept/Reject] | Keandalan & Performa |

---

## 6. RISK

### Software Risks
| Risk | Probability | Impact | Risk Factor | Responsibility | Mitigation Steps | Start Date | End Date |
|---|---|---|---|---|---|---|---|
| Kegagalan relasi Database (Foreign Key Constraint) antar pesanan dan produk | Medium | High | Functional | Developer | Menyiapkan schema migrations CI4 yang tepat (`onDelete('CASCADE')`) dan Database Seeder valid | [Tgl Mulai] | [Tgl Selesai] |

### Business Risks
| Risk | Probability | Impact | Risk Factor | Responsibility | Mitigation Steps | Start Date | End Date |
|---|---|---|---|---|---|---|---|
| Perhitungan harga pesanan tidak valid atau pesanan custom tidak dibayar | Low | High | Financial | Product Owner / Dev | Breakdown mendalam Logika Pemrograman saat perhitungan `total_harga` di Controller | [Tgl Mulai] | [Tgl Selesai] |

### Premature Release Risks
| Risk | Probability | Impact | Risk Factor | Responsibility | Mitigation Steps | Start Date | End Date |
|---|---|---|---|---|---|---|---|
| Server down karena rilis terburu-buru tanpa uji beban (Load testing) | Medium | High | Reliability | DevOps / QA | Lakukan run komprehensif `CoffeeshopLoadTest.jmx` sebelum deployment ke production server | [Tgl Mulai] | [Tgl Selesai] |

### Testing Risks
| Risk | Probability | Impact | Risk Factor | Responsibility | Mitigation Steps | Start Date | End Date |
|---|---|---|---|---|---|---|---|
| Pengujian regresi manual memakan terlalu banyak waktu saat rilis versi baru | High | Medium | Timeline | QA Engineer | Mengandalkan 100% PHPUnit Automation Test untuk fungsionalitas CRUD Backend API/Controllers | [Tgl Mulai] | [Tgl Selesai] |

---

## 7. TEST METRICS

- **Stage Discovered**: 
  - **System Testing:** Ditemukan mayoritas defect logika programming (seperti logic total harga dan validasi input upload) saat eksekusi PHPUnit.
  - **Acceptance Testing:** Evaluasi UX/UI saat testing manual oleh stakeholder.
- **DRE (Defect Removal Efficiency)**: [Hitung Persentase: (Bug Pre-Release) / (Bug Pre-Release + Bug Post-Release) x 100]
- **DD (Defect Density)**: [Hitung Rasio: Total Defect ditemukan dibagi Total KLOC (Kilo Lines Of Code) pada folder app/Controllers dan app/Models]
