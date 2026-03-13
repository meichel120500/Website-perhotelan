# PPKD Hotel — Management System
**Laravel · Elegant Hotel Reservation Web App**

---

## 📁 Struktur Project

```
ppkd-hotel/
├── app/
│   ├── Http/Controllers/
│   │   └── ReservationController.php
│   └── Models/
│       └── Reservation.php
├── database/
│   └── migrations/
│       └── 2024_01_01_000001_create_reservations_table.php
├── resources/
│   ├── css/
│   │   ├── app.css          ← Style utama (sidebar, form, table, btn)
│   │   └── print.css        ← Style khusus cetak / print
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── reservations/
│       │   ├── index.blade.php   ← Dashboard & daftar reservasi
│       │   ├── create.blade.php  ← Form reservasi baru
│       │   ├── show.blade.php    ← Detail reservasi
│       │   └── edit.blade.php    ← Edit reservasi
│       └── print/
│           ├── reservation.blade.php   ← Reservation Confirmation (Foto 2)
│           └── registration.blade.php  ← Formulir Pendaftaran (Foto 1)
└── routes/
    └── web.php
```

---

## 🚀 Cara Install

### 1. Buat project Laravel baru
```bash
composer create-project laravel/laravel ppkd-hotel
cd ppkd-hotel
```

### 2. Copy semua file dari folder ini ke project Laravel
Salin setiap file ke path yang sesuai di project Laravel.

### 3. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppkd_hotel
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Buat database
```sql
CREATE DATABASE ppkd_hotel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan migrasi
```bash
php artisan migrate
```

### 6. Publish CSS ke public
Copy file CSS ke `public/css/`:
```bash
mkdir -p public/css
cp resources/css/app.css public/css/app.css
cp resources/css/print.css public/css/print.css
```

> **Catatan:** Jika menggunakan Vite/Webpack, tambahkan di `vite.config.js` atau
> gunakan `php artisan storage:link` sesuai kebutuhan.

### 7. (Opsional) Tambahkan logo
```bash
mkdir -p public/images
# Letakkan logo PPKD sebagai: public/images/logo.png
```

### 8. Jalankan server
```bash
php artisan serve
```
Buka: **http://localhost:8000**

---

## 🗄️ Struktur Database

### Tabel: `reservations`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint PK | Auto increment |
| booking_number | varchar unique | PPKD-XXXXXXXX |
| room_number | varchar | No. kamar |
| room_type | varchar | Standard/Deluxe/Suite/dll |
| no_of_persons | integer | Jumlah tamu |
| no_of_rooms | integer | Jumlah kamar |
| receptionist | varchar | Nama resepsionis |
| first_name | varchar | **Required** |
| last_name | varchar | |
| profession | varchar | Pekerjaan |
| company | varchar | Perusahaan |
| nationality | varchar | Kewarganegaraan |
| passport_no | varchar | No. KTP / Paspor |
| birth_date | date | Tanggal lahir |
| address | text | Alamat |
| phone | varchar | Telepon |
| mobile_phone | varchar | HP |
| email | varchar | Email |
| member_no | varchar | No. Member |
| company_agent | varchar | Nama agen/perusahaan |
| book_by | varchar | Dipesan oleh |
| agent_phone | varchar | Telp agen |
| agent_fax | varchar | Fax agen |
| agent_email | varchar | Email agen |
| arrival_date | datetime | **Required** |
| arrival_time | time | Waktu kedatangan |
| departure_date | datetime | **Required** |
| total_nights | integer | Dihitung otomatis |
| person_pax | integer | Jumlah tamu |
| room_rate_net | decimal | Tarif kamar |
| room_unit_type | varchar | |
| payment_method | enum | credit_card / bank_transfer |
| card_number | varchar | No. kartu kredit |
| card_holder_name | varchar | Nama pemegang kartu |
| card_type | varchar | Visa/MC/JCB/AMEX |
| card_expired | varchar | MM/YY |
| mandiri_account | varchar | No. rekening Mandiri |
| mandiri_name_account | varchar | Nama rekening |
| safety_deposit_box_no | varchar | No. kotak deposit |
| issued_by | varchar | Dikeluarkan oleh |
| issued_date | date | Tanggal dikeluarkan |
| status | enum | pending/confirmed/checked_in/checked_out/cancelled |
| notes | text | Catatan |
| created_at / updated_at | timestamp | |

---

## 📄 Halaman & Fitur

| Route | URL | Keterangan |
|-------|-----|-----------|
| `reservations.index` | `/reservations` | Dashboard + daftar reservasi |
| `reservations.create` | `/reservations/create` | Form reservasi baru |
| `reservations.store` | `POST /reservations` | Simpan reservasi |
| `reservations.show` | `/reservations/{id}` | Detail reservasi |
| `reservations.edit` | `/reservations/{id}/edit` | Edit reservasi |
| `reservations.update` | `PUT /reservations/{id}` | Update reservasi |
| `reservations.destroy` | `DELETE /reservations/{id}` | Hapus reservasi |
| `reservations.print` | `/reservations/{id}/print` | **Cetak Reservation Confirmation** |
| `reservations.print-registration` | `/reservations/{id}/print-registration` | **Cetak Formulir Pendaftaran** |

---

## 🎨 Design System

- **Font Display:** Cormorant Garamond (serif, elegant)
- **Font UI:** Montserrat (sans-serif, clean)
- **Warna Utama:** Gold `#C9A84C` + Charcoal `#1C1C1E`
- **Background:** Cream `#F9F5EE`
- **Tema:** Luxury / Art Deco — sesuai permintaan klien "elegant"

---

## 🖨️ Fitur Cetak

Dua jenis dokumen yang bisa dicetak:

1. **Formulir Pendaftaran** (`print/registration.blade.php`)
   - Sesuai Foto 1 (form registrasi tamu)
   - Berisi data kamar, tamu, tanggal check-in/out
   - Safety deposit box section

2. **Reservation Confirmation** (`print/reservation.blade.php`)
   - Sesuai Foto 2 (konfirmasi pemesanan)
   - Berisi detail booking, agent info, payment, cancellation policy
   - Section tanda tangan receptionist, tamu, manager

Keduanya menggunakan `print.css` yang terpisah dan sudah dioptimasi untuk cetak A4.
