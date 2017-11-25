# ARTERI (Arsip Elektronik Terintegrasi)
[![N|Solid](http://arteri.sainsinformasi.org/gambar/Selection_022.png)](http://arteri.sainsinformasi.org)
====================================================

Berikut ini adalah panduan instalasi aplikasi Arteri


# 1. Download Source Code Arteri
Source code dapat diunduh pada halaman http://arteri.sainsinformasi.org 
[![N|Solid](http://arteri.sainsinformasi.org/gambar/Selection_023.png)](http://arteri.sainsinformasi.org)

# 2. Extract File zip
Kemudian extract file zip dari arteri_web kedalam folder htdocs atau folder dari webserver anda. Pada contoh ini, penulis menggunakan zwampp sehingga file di extract pada folder "web"
[![N|Solid](http://arteri.sainsinformasi.org/gambar/arteri3.PNG)]()

# 3. Konfigurasi Database
Buatlah sebuah database, lalu import file **arteri.sql** kedalam database tersebut.
[![N|Solid](http://arteri.sainsinformasi.org/gambar/Selection_016.png)]()

[![N|Solid](http://arteri.sainsinformasi.org/gambar/Selection_017.png)]()

Setelah itu, buka file database.php yang terdapat pada folder application/config/ lalu edit kode username, password dan database sesuai dengan konfigurasi database anda

[![N|Solid](http://arteri.sainsinformasi.org/gambar/Selection_018.png)]()


# 4. Akses melalui URL
Masukan alamat url (localhost/[nama_folder]). Secara default, untuk masuk kedalam aplikasi, maka username dan password nya adalah
**username: admin**
**password: admin**
[![N|Solid](http://arteri.sainsinformasi.org/gambar/Selection_025.png)]()
