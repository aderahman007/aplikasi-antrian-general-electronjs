# Aplikasi Antrian Dynamic ElectronJs

Aplikasi Antrian merupakan perkembangan dari versi sebelumnya [aplikasi antrian general static](https://github.com/aderahman007/aplikasi-antrian-general-static) yang digunakan untuk mengelola antrian pengunjung pada suatu perusahaan atau instansi. Aplikasi antrian dapat digunakan sebagai sarana untuk mencapai kinerja efektif dan efisien bagi perusahaan atau instansi dalam melayani pengunjung.

**Aplikasi ini dibangun dengan :**

- Menggunakan bahasa pemrograman **Javascript** dan **NodeJs**.
- Menggunakan database management system **MySQL** atau **MariaDB**.
- Menggunakan **MySQLi Extension** untuk berkomunikasi dengan database.
- Menggunakan framework CSS **Bootstrap 5** untuk membuat desain tampilan aplikasi.
- Menggunakan **jQuery AJAX** untuk proses CRUD.
- Menggunakan **API** teks berbicara dalam bahasa Indonesia dari **ResponsiveVoice.JS** untuk suara panggilan antrian.

# Fitur Apilkasi

Aplikasi Antrian ini terdiri dari 4 interface, yaitu **Nomor Antrian**, **Panggilan Antrian** **Monitor Antrian** dan **Setting Aplikasi Antrian**. Aplikasi antrian ini sepenuhnya realtime tanpa anda reload page dan tampilan yang responsive serta dinamis.

### 1. Nomor Antrian

Halaman Nomor Antrian digunakan pengunjung untuk mengambil nomor antrian. Fitur ini bisa Kamu kembangkan lagi dengan menambahkan fungsi cetak nomor antrian secara langsung ke printer POS 88Cm.

### 2. Panggilan Antrian

Halaman Panggilan Antrian digunakan petugas loket untuk memanggil antrian pengunjung. Halaman ini menampilkan informasi jumlah antrian, nomor antrian yang sedang dipanggil nomor antrian selanjutnya yang akan dipanggil, sisa antrian yang belum dipanggil. Petugas loket dapat menekan tombol panggilan antrian pada layar untuk memanggil antrian dengan menggunakan suara yang bisa dihubungkan dengan alat pengeras suara.

### 3. Monitor Antrian

Halaman monitor antrian digunakan untuk menampilkan dashboard antrian dan untuk mengeluarkan suara antrian yang sedang dipanggil oleh petugas loket antrian

### 3. Setting Aplikasi Antrian

Halaman Setting Aplikasi Antrian untuk memudahkan dalam configurasi aplikasi seperti nama aplikasi, logo, loket, styling dashboard monitor antrian dan rekapitulasi antrian anda.

# Cara Install

## Siapkan system requirment berikut

- Xampp / Laragon (Rekomended)
- PHP 7.3 >= Newer
- MYSQL / MARIADB
- Composer

## Configurasi

- Buat database dan import database yang ada di directory database/aplikasi_antrian_v3.sql
- Jalankan **composer install**
- Copy dan Paste file env.copy.php kemudian rename menjadi env.php dan ubah konfigurasi sesuai dengan konfigurasi server pada file
- Akses aplikasi antrian
- Sesuaikan konfigurasi pada menu setting antrian
- Login default static Setting Aplikasi Antrian  
  Username : superadmin  
  Password : superadmin@123  

### RestAPI Get Antrian Cross Platform

Jika proses ambil antrian include pada aplikasi lain seperti anjungan, maka dapat merujuk pada url berikut dengan method POST

#### List type antrian

Url
```
<ip_server>/pages/nomor/action.php
```

Request Body
```
{
    type: 'get_list_type_antrian'
}
```

#### Ambil antrian

Url
```
<ip_server>/pages/nomor/action.php
```

Request Body
```
{
    type: 'create_antrian',
    code_antrian: <code_antrian>
}
```
Code antrian di dapat dari endpoint #List type antrian

# Configure Driver Printer ElectronJs

Driver printer electronJs dapat merujuk pada [driver printer electronjs](https://github.com/aderahman007/driver-printer-electronjs)

# Support me

Donation to give me a Gift   
Saweria : https://saweria.co/aderahman007

#### Script MIT Lisence
