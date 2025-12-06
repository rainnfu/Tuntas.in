============================================================
PANDUAN INSTALASI - TUNTAS.IN (MANAJEMEN PROYEK)
Kelompok: [Nama Kelompok Anda]
Anggota: 
1. Raihan Ramadhan | H071241021
2. Ariel Mufaddhal | H071241024
============================================================

SYARAT SISTEM:
- PHP >= 8.1
- Composer
- MySQL (XAMPP)

LANGKAH INSTALASI:
1. Extract file zip ke folder htdocs atau folder kerja Anda.
2. Buka terminal di folder tersebut.
3. Jalankan perintah: 
   > composer install
   > npm install
   > npm run build

4. SETTING DATABASE:
   - Buat database baru di phpMyAdmin bernama: db_project_flow
   - Import file "db_project_flow.sql" yang ada di dalam folder ini ke database tersebut.
   - (Opsional) Jika perlu migrate ulang: > php artisan migrate:fresh --seed

5. KONFIGURASI .ENV:
   - File .env sudah disertakan dengan konfigurasi:
     DB_DATABASE=db_project_flow
     FONNTE_TOKEN=[Token Fonnte Anda]

6. JALANKAN APLIKASI:
   > php artisan serve

7. AKUN UNTUK LOGIN (DEMO):
   Role: OWNER / ADMIN
   Email: rainnrr.12@gmail.com
   Pass:  rainnfu 66


FITUR UNGGULAN:
- Logika Deadline (Warna Merah jika telat + Jam & Menit).
- Notifikasi WhatsApp Gateway (Fonnte).
- Kanban Board Drag & Drop.
- Log Aktivitas & Role Permission.

Terima kasih!