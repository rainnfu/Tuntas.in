<div align="center">

  <h1>🚀 Tuntas.in</h1>
  
  <p>
    <strong>Kelola Proyek Tanpa Drama. Terintegrasi dengan WhatsApp.</strong>
  </p>

  <p>
    <a href="https://laravel.com">
      <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    </a>
    <a href="https://tailwindcss.com">
      <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
    </a>
    <a href="https://alpinejs.dev">
      <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js" />
    </a>
    <a href="https://mysql.com">
      <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
    </a>
  </p>

  <br />

  </div>

<br />

## 📖 Tentang Proyek

**Tuntas.in** adalah aplikasi manajemen proyek berbasis web yang dirancang untuk meningkatkan produktivitas tim dengan pendekatan yang *clean* dan modern. 

Dibangun untuk menyelesaikan masalah komunikasi tim yang sering terputus, aplikasi ini menghadirkan fitur **Notifikasi WhatsApp Real-time** setiap kali ada tugas baru atau undangan kolaborasi. Tidak ada lagi alasan "lupa cek web".

Tema desain **"Architectural Sage"** dipilih untuk memberikan ketenangan visual saat bekerja, menjauhkan pengguna dari stres manajemen tugas yang kaku.

---

## ✨ Fitur Unggulan

### ⚡ Produktivitas & Manajemen
- **Kanban Board Interaktif:** Geser tugas (*Drag & Drop*) antar status (To Do, In Progress, Done) dengan mulus menggunakan SortableJS.
- **Deadline Presisi:** Penentuan tenggat waktu hingga ke jam & menit. Indikator visual otomatis berubah merah jika tugas terlambat.
- **Sistem Prioritas:** Label warna-warni (Low, Medium, High, Urgent) untuk membedakan urgensi tugas.

### 🤝 Kolaborasi Tim
- **Undangan via Email:** Undang anggota tim masuk ke proyek dengan mudah.
- **Penugasan (Assignee):** Tugaskan orang spesifik untuk kartu tertentu. Foto profil mereka akan muncul di kartu.
- **Diskusi & Komentar:** Kolom komentar *real-time* di setiap tugas.

### 🔔 Notifikasi Cerdas
- **WhatsApp Gateway (Fonnte):** Notifikasi otomatis terkirim ke WhatsApp saat:
  - User diundang ke proyek.
  - User ditugaskan (Assigned) ke sebuah task.
  - Tugas diselesaikan (Laporan ke Owner).

### 🛡️ Keamanan & Log
- **Role-Based Access:** Hanya *Owner* yang bisa membuat/menghapus tugas. *Member* hanya bisa menggeser dan mengerjakan.
- **Activity Logs:** Mencatat siapa melakukan apa (Create, Move, Delete) demi transparansi tim.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 11/12 (PHP 8.2+)
* **Frontend:** Blade Templates
* **Styling:** Tailwind CSS (Custom Config)
* **Interactivity:** Alpine.js & SortableJS
* **Database:** MySQL
* **API Service:** Fonnte (WhatsApp Gateway)

---

## ⚙️ Panduan Instalasi (Lokal)

Ikuti langkah ini untuk menjalankan proyek di komputer Anda:

### 1. Persiapan
Pastikan Anda sudah menginstal:
* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL (XAMPP/Laragon)

### 2. Clone & Install
```bash
# Clone repositori ini
git clone [https://github.com/username-anda/tuntas-in.git](https://github.com/username-anda/tuntas-in.git)

# Masuk ke folder
cd tuntas-in

# Install dependensi PHP
composer install

# Install dependensi Frontend
npm install && npm run build