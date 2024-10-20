# CMS SIMPLE BLOG
Aplikasi Blog Sederhana yang dibuat menggunakan framework Laravel

## Fitur Aplikasi
- Menampilkan 4 postingan terpopuler berdasarkan view terbanyak
- Menampilkan 3 penulis teratas berdasarkan jumlah postingan terbanyak
- Menampilkan semua daftar postingan
- Menampilkan daftar berdasarkan kategori dan penulis
- Tiap user bisa membuat, mengedit, dan menghapus postingan
- Tiap user bisa memilih untuk mempublikasi atau tidak postingannya
- Admin dapat menghapus postingan user yang terpublikasi jika postingan kurang pantas 
- Verifikasi user dan reset password via email

## Tech
Aplikasi ini dibangun dengan menggunakan :
- [Laravel](https://laravel.com/) - Laravel adalah framework berbasis bahasa pemrograman PHP yang bisa digunakan untuk membantu proses pengembangan sebuah website agar lebih maksimal.
- [Bootstrap](https://getbootstrap.com/) - Bootstrap merupakan sebuah library atau kumpulan dari berbagai fungsi yang terdapat di framework CSS dan dibuat secara khusus di bagian pengembangan pada front-end website
- [jQuery] - jQuery adalah library JavaScript yang akan mempercepat Anda dalam membuat website
- [HTML] - Hypertext Markup Language, yaitu bahasa markup standar untuk membuat dan menyusun halaman dan aplikasi web.
- [Admin LTE](https://adminlte.io/) - Template web untuk dashboard admin yang dibuat menggunakan bootstrap dan menyediakan berbagai komponen yang responsif untuk dipergunakan kembali
- [API Image Lorem Picsum](https://picsum.photos/) - Salah satu layanan API yang menyediakan berbagai macam gambar secara acak

## Requirement
- Laravel Valet 2.5.1 or later (optional)
- PHP 8.2.4 or later
- Composer 2.5.4 or later
- MySQL Server 8.0 or later
- MySQL Workbench 8.0 CE or later

## Instalasi
- Cloning repository git ke sebuah folder di local
```sh
git clone https://github.com/rahardian-dwi-saputra/simple-blog.git
```
- Install depedensi via composer
```sh
composer install
```
- Buat sebuah file .env
```sh
copy .env.example .env
```
- Buat database kosong menggunakan tool database yang anda sukai. Pada file `.env` isikan opsi `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai dengan kredensial database yang sudah anda buat
- Lakukan migrasi database dan jalankan seeder
```sh
php artisan migrate
php artisan db:seed
```
- Buat simbolik link agar fitur upload bisa berfungsi
```sh
php artisan storage:link
```
- Generate key
```sh
php artisan key:generate
```
- Jalankan valet laravel lewat cmd
```sh
valet start
```
- Buka aplikasi simple blog di browser
```sh
http://simple-blog.test
```