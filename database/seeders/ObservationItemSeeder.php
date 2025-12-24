<?php

namespace Database\Seeders;

use App\Models\ObservationItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ObservationItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // PEMBINAAN KEPRIBADIAN

        // Kesadaran Beragama (Bobot: 2.8)
        $items = [
            ['code' => 'ka1', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Beragama', 'aspect_weight' => 2.8, 'item_name' => 'Membaca dan/atau belajar Kitab Suci', 'monthly_frequency' => 31, 'sort_order' => 1],
            ['code' => 'ka2', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Beragama', 'aspect_weight' => 2.8, 'item_name' => 'Ibadah tepat waktu / rutin', 'monthly_frequency' => 31, 'sort_order' => 2],
            ['code' => 'ka3', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Beragama', 'aspect_weight' => 2.8, 'item_name' => 'Melakukan Ibadah di luar ibadah wajib', 'monthly_frequency' => 4, 'sort_order' => 3],
            ['code' => 'ka4', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Beragama', 'aspect_weight' => 2.8, 'item_name' => 'Mengikuti kegiatan ceramah atau khotbah', 'monthly_frequency' => 4, 'sort_order' => 4],
            ['code' => 'ka5', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Beragama', 'aspect_weight' => 2.8, 'item_name' => 'Mengikuti ibadah secara berkelompok', 'monthly_frequency' => 31, 'sort_order' => 5],
        ];

        // Kesadaran Hukum, Berbangsa, dan Bernegara (Bobot: 1.6)
        $items = array_merge($items, [
            ['code' => 'kh1', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Mengikuti penyuluhan wawasan nusantara', 'monthly_frequency' => 1, 'sort_order' => 6],
            ['code' => 'kh2', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Mengikuti penyuluhan hukum dampak dan bahaya tindak pidana', 'monthly_frequency' => 1, 'sort_order' => 7],
            ['code' => 'kh3', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Memperoleh nilai evaluasi materi penyuluhan', 'monthly_frequency' => 1, 'sort_order' => 8],
            ['code' => 'kh4', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Mengikuti upacara', 'monthly_frequency' => 4, 'sort_order' => 9],
            ['code' => 'kh5', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Hormat bendera saat upacara', 'monthly_frequency' => 4, 'sort_order' => 10],
            ['code' => 'kh6', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Mengisi lembar self-assessment', 'monthly_frequency' => 4, 'sort_order' => 11],
            ['code' => 'kh7', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesadaran Hukum, Berbangsa, dan Bernegara', 'aspect_weight' => 1.6, 'item_name' => 'Mengikuti pramuka', 'monthly_frequency' => 4, 'sort_order' => 12],
        ]);

        // Kemampuan Intelektual (Bobot: 0.2)
        $items = array_merge($items, [
            ['code' => 'ki1', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kemampuan Intelektual', 'aspect_weight' => 0.2, 'item_name' => 'Membaca buku di perpustakaan', 'monthly_frequency' => 31, 'sort_order' => 13],
            ['code' => 'ki2', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kemampuan Intelektual', 'aspect_weight' => 0.2, 'item_name' => 'Mengikuti pendidikan paket A, B, C', 'monthly_frequency' => 4, 'sort_order' => 14],
            ['code' => 'ki3', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kemampuan Intelektual', 'aspect_weight' => 0.2, 'item_name' => 'Mengikuti materi CMT dan LST', 'monthly_frequency' => 4, 'sort_order' => 15],
        ]);

        // Kesehatan Jasmani (Bobot: 0.2)
        $items = array_merge($items, [
            ['code' => 'kj1', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesehatan Jasmani', 'aspect_weight' => 0.2, 'item_name' => 'Melakukan kegiatan rekreasi', 'monthly_frequency' => 1, 'sort_order' => 16],
            ['code' => 'kj2', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesehatan Jasmani', 'aspect_weight' => 0.2, 'item_name' => 'Melakukan olahraga luar ruangan (komunal)', 'monthly_frequency' => 31, 'sort_order' => 17],
            ['code' => 'kj3', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Kesehatan Jasmani', 'aspect_weight' => 0.2, 'item_name' => 'Mengikuti kegiatan kesenian', 'monthly_frequency' => 4, 'sort_order' => 18],
        ]);

        // Konseling dan Rehabilitasi (Bobot: 0.2)
        $items = array_merge($items, [
            ['code' => 'kr1', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Konseling dan Rehabilitasi', 'aspect_weight' => 0.2, 'item_name' => 'Mengikuti konseling psikologi', 'monthly_frequency' => 1, 'sort_order' => 19],
            ['code' => 'kr2', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Konseling dan Rehabilitasi', 'aspect_weight' => 0.2, 'item_name' => 'Mengikuti rehabilitasi sosial', 'monthly_frequency' => 1, 'sort_order' => 20],
            ['code' => 'kr3', 'variable' => 'pembinaan_kepribadian', 'aspect' => 'Konseling dan Rehabilitasi', 'aspect_weight' => 0.2, 'item_name' => 'Mengikuti rehabilitasi medis', 'monthly_frequency' => 1, 'sort_order' => 21],
        ]);

        // PEMBINAAN KEMANDIRIAN

        // Pelatihan Keterampilan
        $items = array_merge($items, [
            ['code' => 'pk1', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Hadir tepat waktu', 'monthly_frequency' => 20, 'sort_order' => 22],
            ['code' => 'pk2', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Mengikuti seluruh kegiatan pelatihan', 'monthly_frequency' => 20, 'sort_order' => 23],
            ['code' => 'pk3', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Mematuhi peraturan sesuai prosedur kegiatan', 'monthly_frequency' => 20, 'sort_order' => 24],
            ['code' => 'pk4', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Mematuhi peraturan dalam hubungan kerja', 'monthly_frequency' => 20, 'sort_order' => 25],
            ['code' => 'pk5', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Mendapatkan skor post test pengetahuan minimal 60', 'monthly_frequency' => 1, 'sort_order' => 26],
            ['code' => 'pk6', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Mendapatkan skor tes keterampilan minimal 60', 'monthly_frequency' => 1, 'sort_order' => 27],
            ['code' => 'pk7', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Pelatihan Keterampilan', 'aspect_weight' => 1.0, 'item_name' => 'Menerapkan prosedur K3 dengan baik', 'monthly_frequency' => 20, 'sort_order' => 28],
        ]);

        // Produksi Barang dan Jasa
        $items = array_merge($items, [
            ['code' => 'pb1', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Produksi Barang dan Jasa', 'aspect_weight' => 1.0, 'item_name' => 'Hadir tepat waktu', 'monthly_frequency' => 20, 'sort_order' => 29],
            ['code' => 'pb2', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Produksi Barang dan Jasa', 'aspect_weight' => 1.0, 'item_name' => 'Mengikuti seluruh kegiatan produksi kerja', 'monthly_frequency' => 20, 'sort_order' => 30],
            ['code' => 'pb3', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Produksi Barang dan Jasa', 'aspect_weight' => 1.0, 'item_name' => 'Mematuhi peraturan produksi barang/jasa yang berlaku', 'monthly_frequency' => 20, 'sort_order' => 31],
            ['code' => 'pb4', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Produksi Barang dan Jasa', 'aspect_weight' => 1.0, 'item_name' => 'Mematuhi peraturan dalam hubungan kerja', 'monthly_frequency' => 20, 'sort_order' => 32],
            ['code' => 'pb5', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Produksi Barang dan Jasa', 'aspect_weight' => 1.0, 'item_name' => 'Menghasilkan barang/jasa sesuai dengan standar', 'monthly_frequency' => 20, 'sort_order' => 33],
            ['code' => 'pb6', 'variable' => 'pembinaan_kemandirian', 'aspect' => 'Produksi Barang dan Jasa', 'aspect_weight' => 1.0, 'item_name' => 'Menerapkan prosedur K3 dengan baik', 'monthly_frequency' => 20, 'sort_order' => 34],
        ]);

        // SIKAP NARAPIDANA

        // Keberfungsian dan Rutinitas (Bobot: 1.5)
        $items = array_merge($items, [
            ['code' => 'kbr1', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menerima dan mengkonsumsi makanan dan minuman', 'monthly_frequency' => 31, 'sort_order' => 35],
            ['code' => 'kbr2', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menggunakan baju yang bersih dan rapi', 'monthly_frequency' => 31, 'sort_order' => 36],
            ['code' => 'kbr3', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menggunakan baju seragam', 'monthly_frequency' => 31, 'sort_order' => 37],
            ['code' => 'kbr4', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Membersihkan kamar hunian', 'monthly_frequency' => 31, 'sort_order' => 38],
            ['code' => 'kbr5', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Ikut kerja bakti', 'monthly_frequency' => 4, 'sort_order' => 39],
            ['code' => 'kbr6', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Mematuhi tata tertib lapas', 'monthly_frequency' => 31, 'sort_order' => 40],
            ['code' => 'kbr7', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menjawab salam dari petugas', 'monthly_frequency' => 31, 'sort_order' => 41],
            ['code' => 'kbr8', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Mengucapkan salam kepada petugas', 'monthly_frequency' => 31, 'sort_order' => 42],
            ['code' => 'kbr9', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Tersenyum kepada petugas', 'monthly_frequency' => 31, 'sort_order' => 43],
            ['code' => 'kbr10', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menyapa petugas', 'monthly_frequency' => 31, 'sort_order' => 44],
            ['code' => 'kbr11', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Berbincang dengan petugas', 'monthly_frequency' => 31, 'sort_order' => 45],
            ['code' => 'kbr12', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menerima kunjungan keluarga', 'monthly_frequency' => 1, 'sort_order' => 46],
            ['code' => 'kbr13', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Menerima kunjungan dinas', 'monthly_frequency' => 1, 'sort_order' => 47],
            ['code' => 'kbr14', 'variable' => 'sikap', 'aspect' => 'Keberfungsian dan Rutinitas', 'aspect_weight' => 1.5, 'item_name' => 'Mau merapikan rambut, janggut, dan kuku', 'monthly_frequency' => 4, 'sort_order' => 48],
        ]);

        // Agresi (Bobot: 1.0)
        $items = array_merge($items, [
            ['code' => 'ag1', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Melakukan pemukulan tembok', 'monthly_frequency' => 31, 'sort_order' => 49],
            ['code' => 'ag2', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Membanting barang-barang', 'monthly_frequency' => 31, 'sort_order' => 50],
            ['code' => 'ag3', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Menunjukan sikap marah-marah', 'monthly_frequency' => 31, 'sort_order' => 51],
            ['code' => 'ag4', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Berteriak-teriak', 'monthly_frequency' => 31, 'sort_order' => 52],
            ['code' => 'ag5', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Merusak CCTV/Inventaris lain', 'monthly_frequency' => 31, 'sort_order' => 53],
            ['code' => 'ag6', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Mengguncang atau menendang teralis', 'monthly_frequency' => 31, 'sort_order' => 54],
            ['code' => 'ag7', 'variable' => 'sikap', 'aspect' => 'Agresi', 'aspect_weight' => 1.0, 'item_name' => 'Memanjat teralis', 'monthly_frequency' => 31, 'sort_order' => 55],
        ]);

        // Pelanggaran Hukum (Bobot: 1.5)
        $items = array_merge($items, [
            ['code' => 'ph1', 'variable' => 'sikap', 'aspect' => 'Pelanggaran Hukum', 'aspect_weight' => 1.5, 'item_name' => 'Berupaya melarikan diri', 'monthly_frequency' => 31, 'sort_order' => 56],
            ['code' => 'ph2', 'variable' => 'sikap', 'aspect' => 'Pelanggaran Hukum', 'aspect_weight' => 1.5, 'item_name' => 'Mengancam/menyerang petugas', 'monthly_frequency' => 31, 'sort_order' => 57],
            ['code' => 'ph3', 'variable' => 'sikap', 'aspect' => 'Pelanggaran Hukum', 'aspect_weight' => 1.5, 'item_name' => 'Berkelahi dengan narapidana lain', 'monthly_frequency' => 31, 'sort_order' => 58],
            ['code' => 'ph4', 'variable' => 'sikap', 'aspect' => 'Pelanggaran Hukum', 'aspect_weight' => 1.5, 'item_name' => 'Melakukan dugaan tindak pidana lain', 'monthly_frequency' => 31, 'sort_order' => 59],
        ]);

        // Kemampuan Mempengaruhi (Bobot: 0.8)
        $items = array_merge($items, [
            ['code' => 'km1', 'variable' => 'sikap', 'aspect' => 'Kemampuan Mempengaruhi', 'aspect_weight' => 0.8, 'item_name' => 'Membujuk petugas Pemasyarakatan melakukan pelanggaran secara langsung', 'monthly_frequency' => 31, 'sort_order' => 60],
            ['code' => 'km2', 'variable' => 'sikap', 'aspect' => 'Kemampuan Mempengaruhi', 'aspect_weight' => 0.8, 'item_name' => 'Menggunakan jaringan untuk membujuk petugas Pemasyarakatan melakukan pelanggaran', 'monthly_frequency' => 31, 'sort_order' => 61],
            ['code' => 'km3', 'variable' => 'sikap', 'aspect' => 'Kemampuan Mempengaruhi', 'aspect_weight' => 0.8, 'item_name' => 'Membujuk atau mengajak narapidana lain melakukan pelanggaran', 'monthly_frequency' => 31, 'sort_order' => 62],
        ]);

        // Ekspresi Simbolik (Bobot: 0.2)
        $items = array_merge($items, [
            ['code' => 'es1', 'variable' => 'sikap', 'aspect' => 'Ekspresi Simbolik', 'aspect_weight' => 0.2, 'item_name' => 'Menggambar simbol yang berkaitan dengan ideologi ekstrimisme kekerasan', 'monthly_frequency' => 31, 'sort_order' => 63],
            ['code' => 'es2', 'variable' => 'sikap', 'aspect' => 'Ekspresi Simbolik', 'aspect_weight' => 0.2, 'item_name' => 'Meminta sesuatu yang berkaitan dengan ideologi ekstrimisme kekerasan', 'monthly_frequency' => 31, 'sort_order' => 64],
            ['code' => 'es3', 'variable' => 'sikap', 'aspect' => 'Ekspresi Simbolik', 'aspect_weight' => 0.2, 'item_name' => 'Membuat pernyataan yang menunjukkan niat untuk melakukan aksi teror seperti memberikan doktrin', 'monthly_frequency' => 31, 'sort_order' => 65],
            ['code' => 'es4', 'variable' => 'sikap', 'aspect' => 'Ekspresi Simbolik', 'aspect_weight' => 0.2, 'item_name' => 'Menggunakan kata "kami" dan "mereka" dalam maksud memisahkan antara kelompoknya dengan petugas', 'monthly_frequency' => 31, 'sort_order' => 66],
            ['code' => 'es5', 'variable' => 'sikap', 'aspect' => 'Ekspresi Simbolik', 'aspect_weight' => 0.2, 'item_name' => 'Menggunakan sandi untuk menghina petugas', 'monthly_frequency' => 31, 'sort_order' => 67],
        ]);

        // KONDISI MENTAL

        // Depresi
        $items = array_merge($items, [
            ['code' => 'dep1', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Tidak mau bangun dari tempat tidur', 'monthly_frequency' => 31, 'sort_order' => 68],
            ['code' => 'dep2', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Sulit tidur', 'monthly_frequency' => 31, 'sort_order' => 69],
            ['code' => 'dep3', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Tidak mau mandi', 'monthly_frequency' => 31, 'sort_order' => 70],
            ['code' => 'dep4', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Tidak mau makan/minum', 'monthly_frequency' => 31, 'sort_order' => 71],
            ['code' => 'dep5', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Murung terus-menerus', 'monthly_frequency' => 31, 'sort_order' => 72],
            ['code' => 'dep6', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Menangis terus-menerus', 'monthly_frequency' => 31, 'sort_order' => 73],
            ['code' => 'dep7', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Menatap dinding dengan lama', 'monthly_frequency' => 31, 'sort_order' => 74],
            ['code' => 'dep8', 'variable' => 'kondisi_mental', 'aspect' => 'Depresi', 'aspect_weight' => 1.0, 'item_name' => 'Tidak mau berbicara', 'monthly_frequency' => 31, 'sort_order' => 75],
        ]);

        // Kecemasan
        $items = array_merge($items, [
            ['code' => 'cemas1', 'variable' => 'kondisi_mental', 'aspect' => 'Kecemasan', 'aspect_weight' => 1.0, 'item_name' => 'Melakukan perilaku berulang-ulang', 'monthly_frequency' => 31, 'sort_order' => 76],
            ['code' => 'cemas2', 'variable' => 'kondisi_mental', 'aspect' => 'Kecemasan', 'aspect_weight' => 1.0, 'item_name' => 'Tidak bisa fokus terhadap banyak hal', 'monthly_frequency' => 31, 'sort_order' => 77],
            ['code' => 'cemas3', 'variable' => 'kondisi_mental', 'aspect' => 'Kecemasan', 'aspect_weight' => 1.0, 'item_name' => 'Takut ditempatkan di ruang sendiri', 'monthly_frequency' => 31, 'sort_order' => 78],
        ]);

        // Psikosomatis
        $items = array_merge($items, [
            ['code' => 'psiko1', 'variable' => 'kondisi_mental', 'aspect' => 'Psikosomatis', 'aspect_weight' => 1.0, 'item_name' => 'Mengalami gejala fisik pada saat situasi di bawah tekanan', 'monthly_frequency' => 31, 'sort_order' => 79],
        ]);

        // Malingering
        $items = array_merge($items, [
            ['code' => 'mal1', 'variable' => 'kondisi_mental', 'aspect' => 'Malingering', 'aspect_weight' => 1.0, 'item_name' => 'Mengeluhkan sesuatu secara terus-menerus untuk kepentingan diri sendiri untuk menghindari kewajiban', 'monthly_frequency' => 31, 'sort_order' => 80],
        ]);

        // Potensi Bunuh Diri
        $items = array_merge($items, [
            ['code' => 'bd1', 'variable' => 'kondisi_mental', 'aspect' => 'Potensi Bunuh Diri', 'aspect_weight' => 1.0, 'item_name' => 'Menyakiti diri sendiri', 'monthly_frequency' => 31, 'sort_order' => 81],
            ['code' => 'bd2', 'variable' => 'kondisi_mental', 'aspect' => 'Potensi Bunuh Diri', 'aspect_weight' => 1.0, 'item_name' => 'Membenturkan kepala ke benda keras', 'monthly_frequency' => 31, 'sort_order' => 82],
            ['code' => 'bd3', 'variable' => 'kondisi_mental', 'aspect' => 'Potensi Bunuh Diri', 'aspect_weight' => 1.0, 'item_name' => 'Melakukan usaha untuk bunuh diri', 'monthly_frequency' => 31, 'sort_order' => 83],
            ['code' => 'bd4', 'variable' => 'kondisi_mental', 'aspect' => 'Potensi Bunuh Diri', 'aspect_weight' => 1.0, 'item_name' => 'Mengatakan ingin bunuh diri', 'monthly_frequency' => 31, 'sort_order' => 84],
        ]);

        foreach ($items as $item) {
            ObservationItem::create($item);
        }
    }
}
