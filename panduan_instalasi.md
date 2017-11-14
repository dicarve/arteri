# ARTERI (Arsip Elektronik Terintegrasi)
====================================================

Berikut ini adalah panduan instalasi aplikasi Arteri


# 1. Download Source Code Arteri
Source code dapat diunduh pada halaman http://arteri.sainsinformasi.org 


# 2. Extract File zip
Kemudian extract file zip dari arteri_web kedalam folder htdocs atau folder dari webserver anda. Pada contoh ini, penulis menggunakan zwampp sehingga file di extract pada folder "web"


# 3. Konfigurasi Database
Buatlah sebuah database, lalu import file **arteri.sql** kedalam database tersebut. Setelah itu, buka file database.php yang terdapat pada folder application/config/ lalu edit kode username, password dan database sesuai dengan konfigurasi database anda


# 4. Akses melalui URL
Masukan alamat url (localhost/[nama_folder]). Secara default, untuk masuk kedalam aplikasi, maka username dan password nya adalah
**username: admin**
**password: admin**
