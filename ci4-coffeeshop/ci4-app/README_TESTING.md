# Panduan Pengujian (Testing Guide) - Coffee Shop

Dokumen ini berisi panduan untuk menjalankan pengujian (testing) pada proyek **Kopi Kenangan Petang** menggunakan **PHPUnit** dan **Apache JMeter**.

> **Semua perintah dijalankan dari direktori utama proyek:** `ci4-coffeeshop/ci4-app/`

---

## 1. Persiapan Environment & Database

Sebelum menjalankan pengujian (baik Manual Black Box maupun Automated Testing), pastikan konfigurasi sudah tepat agar tidak terjadi *error routing* (seperti 404 Not Found):

1. Buka file `.env` (di dalam folder `ci4-app`).
2. Pastikan `app.baseURL` sudah diatur ke path aplikasi XAMPP kamu secara penuh, contoh: `app.baseURL = 'http://localhost:8080/coffeeshop7-v2/ci4-coffeeshop/ci4-app/public/'`
3. Buka **phpMyAdmin** dan buat database khusus testing bernama: `coffeeshop_test`
4. Konfigurasi database testing sudah tersedia di `phpunit.xml` (bagian `<php>`)
5. Pastikan **XAMPP** (Apache & MySQL) dalam keadaan aktif

---

## 2. Instalasi Dependensi

```bash
composer install
```

---

## 3. Menjalankan PHPUnit (Unit, Feature, & Database Test)

### Jalankan Semua Test Sekaligus
```bash
vendor\bin\phpunit
```
atau dengan format tampilan lebih detail:
```bash
vendor\bin\phpunit --testdox
```

### Jalankan Per Kategori Test

**Unit Test (Model):**
```bash
vendor\bin\phpunit tests/unit/
```

**Feature Test (Controller):**
```bash
vendor\bin\phpunit tests/feature/
```

**Database Test (Migration & Seeder):**
```bash
vendor\bin\phpunit tests/database/
```

---

## 4. Menjalankan Test Per Modul

### DesainPesanan
```bash
vendor\bin\phpunit tests/unit/DesainPesananModelTest.php
vendor\bin\phpunit tests/feature/DesainPesananControllerTest.php
vendor\bin\phpunit tests/database/DesainPesananDatabaseTest.php
```
### MenuProduk
```bash
vendor\bin\phpunit tests/unit/MenuProdukModelTest.php
vendor\bin\phpunit tests/feature/MenuProdukControllerTest.php
vendor\bin\phpunit tests/database/MenuProdukDatabaseTest.php
```

### Pesanan
```bash
vendor\bin\phpunit tests/unit/PesananModelTest.php
vendor\bin\phpunit tests/feature/PesananControllerTest.php
vendor\bin\phpunit tests/database/PesananDatabaseTest.php
```

### PesanKontak
```bash
vendor\bin\phpunit tests/unit/PesanKontakModelTest.php
vendor\bin\phpunit tests/feature/PesanKontakControllerTest.php
vendor\bin\phpunit tests/database/PesanKontakDatabaseTest.php
```

### User
```bash
vendor\bin\phpunit tests/unit/UserModelTest.php
vendor\bin\phpunit tests/feature/UserControllerTest.php
vendor\bin\phpunit tests/database/UserDatabaseTest.php
```

### Login
```bash
vendor\bin\phpunit tests/feature/LoginCoffeeShopControllerTest.php
```

---

## 5. Cakupan Test Per Modul

| Modul         | Unit | Feature (CRUD) | Database |
|---------------|------|----------------|----------|
| DesainPesanan | ✅   | index, show, add, store, edit, update, destroy | ✅ |
| MenuProduk    | ✅   | index, show, add, store, edit, update, destroy | ✅ |
| Pesanan       | ✅   | index, show, add, store, edit, update, destroy | ✅ |
| PesanKontak   | ✅   | index, show, store, destroy                   | ✅ |
| User          | ✅   | index, add, store, edit, update, destroy       | ✅ |
| Login         | —    | login page, login success, login failure       | — |

---

## 6. Membaca Hasil Test

| Warna Output | Artinya |
|---|---|
| 🟢 **Hijau (OK)** | Semua test berhasil (Passed) |
| 🔴 **Merah (FAIL)** | Ada test yang gagal — cek pesan error |
| 🟡 **Kuning (WARNING)** | Ada peringatan non-fatal |

---

## 7. Load Testing dengan Apache JMeter

Load testing digunakan untuk mensimulasikan banyak pengguna mengakses aplikasi secara bersamaan.

**File JMeter:** `tests/jmeter/CoffeeshopLoadTest.jmx`

**Konfigurasi:**
- **100 virtual users** (threads)
- **Ramp-up:** 10 detik
- **Target:** `http://localhost:8080/coffeeshop7-v2/ci4-coffeeshop/ci4-app/public/`

**Cara menjalankan:**
1. Buka aplikasi **Apache JMeter**
2. Klik **File > Open**, lalu pilih file `tests/jmeter/CoffeeshopLoadTest.jmx`
3. Tambahkan Listener (opsional): klik kanan **Thread Group > Add > Listener > View Results Tree** atau **Summary Report**
4. Klik tombol **▶ Play (Start)** berwarna hijau di toolbar
5. Pantau hasil di panel Listener yang telah ditambahkan

---

*Dibuat untuk proyek: **Kopi Kenangan Petang** — CodeIgniter 4 Coffee Shop App*
