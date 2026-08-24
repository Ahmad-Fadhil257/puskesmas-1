# Design System & Blueprint: Puskesmas CareLink Landing Page

Dokumen ini merupakan panduan desain dan spesifikasi teknis UI/UX untuk landing page **Puskesmas CareLink**. Panduan ini diturunkan langsung dari acuan visual **Hero Section** dan akan diterapkan secara konsisten ke seluruh seksi halaman website.

---

## 1. Identitas Visual & Filosofi Desain

- **Nama Proyek / Brand**: Puskesmas CareLink
- **Tagline**: *"Melayani Kesehatan Masyarakat dengan Sepenuh Hati"*
- **Karakter Desain**:
  - **Modern & Bersih**: Memberikan rasa profesionalisme, higienis, dan terpercaya.
  - **Hangat & Humanis**: Mengedepankan kepedulian terhadap masyarakat dari segala usia.
  - **Aksesibel & Responsif**: Mudah dibaca, navigasi intuitif, dan tombol aksi (CTA) yang mencolok.

---

## 2. Palet Warna (Color Palette)

| Kategori | Hex Code | Nama Warna | Penggunaan Utama |
| :--- | :--- | :--- | :--- |
| **Primary** | `#0A5C45` | *Emerald Forest* | Tombol Utama, Teks Brand Logo, Badge Icon, Active State Nav |
| **Primary Hover** | `#084A37` | *Deep Forest* | Hover state tombol utama & link aktif |
| **Dark Neutral / Headings** | `#122822` | *Dark Pine* | Judul utama (H1, H2, H3), Teks berbobot tebal |
| **Body Text** | `#40564F` | *Muted Spruce* | Paragraf deskripsi, label, teks sekunder |
| **Light Background 1** | `#C5E5DD` | *Mint Mist* | Warna gradasi latar belakang utama (Hero background) |
| **Light Background 2** | `#EEF8F5` | *Soft Sage Ice* | Gradasi bawah / latar section konten |
| **Surface / Card** | `#FFFFFF` | *Pure White* | Floating navbar, kartu layanan, container konten |
| **Secondary Accent** | `#BBE4D8` | *Soft Mint* | Tombol sekunder ("Layanan Kami"), tag badge background |
| **Border / Stroke** | `#A8D7CA` | *Mint Stroke* | Garis tepi tombol sekunder, border kartu halus |
| **Highlight / Alert** | `#F59E0B` | *Amber Gold* | Notifikasi, badge akreditasi, bintang ulasan |

---

## 3. Tipografi (Typography)

- **Font Family Utama**: `Plus Jakarta Sans`, `Inter`, atau `Poppins` (Fallback: `sans-serif`)
- **Hierarki Tipografi**:
  - **H1 (Hero Title)**: `36px - 56px` | Weight: `Bold (700) / ExtraBold (800)` | Leading: `1.15`
  - **H2 (Section Title)**: `28px - 36px` | Weight: `Bold (700)` | Leading: `1.25`
  - **H3 (Card / Sub-title)**: `18px - 22px` | Weight: `SemiBold (600)`
  - **Tagline / Badge**: `12px - 14px` | Weight: `Bold (700)` | Letter-spacing: `0.05em (tracking-wider)` | Uppercase
  - **Body Large (Hero Desc)**: `16px - 18px` | Weight: `Regular (400) / Medium (500)` | Leading: `1.6`
  - **Body Normal**: `14px - 16px` | Weight: `Regular (400)` | Leading: `1.5`
  - **Button / Nav Links**: `14px - 15px` | Weight: `SemiBold (600)`

---

## 4. Komponen UI & Bentuk (Shapes & Components)

### A. Floating Navbar (Kapsul Mengambang)
- **Container**: `rounded-full` (border radius maksimal), latar belakang `#FFFFFF`, bayangan halus (`box-shadow: 0 4px 20px rgba(10, 92, 69, 0.08)`).
- **Brand Logo**: Teks tebal **"Puskesmas CareLink"** warna `#0A5C45`.
- **Menu Navigasi**: `Home` (ada indikator garis bawah warna hijau), `Layanan`, `Jadwal Dokter`, `Berita`, `Tentang Kami`, `Kontak`.
- **CTA Navbar**: Tombol pill kapsul (`rounded-full`) warna hijau `#0A5C45`, teks putih **"Janji Temu"**.

### B. Tombol (Buttons)
1. **Primary Button (e.g. "Janji Temu Online", "Janji Temu")**:
   - Bentuk: `rounded-full` (Pill).
   - Latar: `#0A5C45`, teks: `#FFFFFF`.
   - Efek: Hover skala mikro (`scale-[1.02]`), warna menjadi `#084A37`.
2. **Secondary Button (e.g. "Layanan Kami")**:
   - Bentuk: `rounded-full` (Pill).
   - Latar: `#BBE4D8` / transparan dengan border `#0A5C45`, teks: `#0A5C45`.
   - Efek: Hover latar `#A3DACB`.

### C. Visual Hero: 2x2 Image Grid
- **Struktur**: Grid 2 kolom x 2 baris menampilkan dokumentasi kegiatan nyata puskesmas.
- **Styling Gambar**:
  - Sudut melengkung `rounded-2xl` (16px - 20px).
  - Bayangan lembut (`shadow-md shadow-emerald-950/10`).
  - Efek hover: `transition-transform duration-300 hover:scale-[1.02]`.
- **Konten Visual**:
  1. Pemeriksaan kesehatan lansia/umum oleh dokter.
  2. Konsultasi kesehatan ibu & anak / posyandu.
  3. Ruang pendaftaran / lobi puskesmas yang rapi.
  4. Tenaga medis/bidan merawat bayi/balita.

---

## 5. Kesepakatan Diskusi & Fokus Pengerjaan

Berdasarkan hasil diskusi:
1. **Fokus Tahap 1**: Pengerjaan dan pematangan **Hero Section** terlebih dahulu agar presisi sesuai desain acuan.
2. **Model Navigasi**: *Single Page* dengan *Smooth Scrolling* ke seksi terkait (`scroll-smooth`).
3. **Aksi Tombol "Janji Temu"**: Difokuskan pada aspek visual/tampilan UI terlebih dahulu dengan efek interaktif/hover yang elegan.
4. **Manajemen Aset Foto**:
   - Direktori penyimpanan foto: `public/images/hero/`
   - Daftar foto yang disiapkan (2x2 Grid):
     - `hero-1.jpg` (Top-Left): Pemeriksaan dokter & pasien
     - `hero-2.jpg` (Top-Right): Konsultasi / kegiatan posyandu
     - `hero-3.jpg` (Bottom-Left): Ruang tunggu / lobi pendaftaran puskesmas
     - `hero-4.jpg` (Bottom-Right): Pelayanan ibu, anak, dan imunisasi

---

## 6. Stack & Rekomendasi Teknis
- **Framework**: Laravel 11/12 (Blade Template)
- **Styling**: Css vanilla
- **Font**: Google Fonts (`Plus Jakarta Sans`)
- **Aset Folder**: `public/images/hero/`

