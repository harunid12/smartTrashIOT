# SmartTrashIOT

## Deskripsi

SmartTrashIOT adalah sistem IoT untuk pemantauan tong sampah pintar. Sistem ini menggunakan backend Laravel dan UI berbasis template Bootstrap. Data sensor dikirim dan diambil melalui API dari ThingSpeak.

## Instalasi

1. Clone repository ini:
    ```bash
    git clone https://github.com/harunid12/smartTrashIOT.git
    ```
2. Masuk ke direktori proyek:
    ```bash
    cd smartTrashIOT
    ```
3. Install dependencies Laravel:
    ```bash
    composer install
    ```
4. Copy file environment:
    ```bash
    cp .env.example .env
    ```
5. Generate application key:
    ```bash
    php artisan key:generate
    ```
6. Konfigurasi database di `.env`:
    ```env
    DB_CONNECTION=mariadb
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=smartTrash
    DB_USERNAME=username
    DB_PASSWORD=password
    ```
7. Jalankan migrasi database:
    ```bash
    php artisan migrate
    ```
8. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

## Cara Penggunaan

1. Pastikan server Laravel berjalan.
2. Akses aplikasi melalui browser di `http://127.0.0.1:8000`.
3. Sistem akan mengambil data dari sensor melalui API ThingSpeak.

## Kontak

Jika ada pertanyaan atau saran, hubungi : [ahmadharun.jambi@gmail.com](mailto:ahmadharun.jambi@gmail.com)
