<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Anggaran;
use App\Models\RealisasiAnggaran;
use Illuminate\Support\Facades\DB;

// Clear existing data
DB::statement('PRAGMA foreign_keys = OFF');
RealisasiAnggaran::truncate();
Anggaran::truncate();
DB::statement('PRAGMA foreign_keys = ON');

$urutan = 0;

// Helper function
function createItem($kode, $uraian, $level, $parentId, $pagu = 0, &$urutanRef)
{
    return Anggaran::create([
        'kode' => $kode,
        'uraian' => $uraian,
        'level' => $level,
        'parent_id' => $parentId,
        'pagu_revisi' => $pagu,
        'limit_pagu' => $pagu,
        'realisasi_lalu' => 0,
        'realisasi_ini' => 0,
        'urutan' => ++$urutanRef,
    ]);
}

// ==================================================================================
// Program 1: GK.7448 Keterampilan Digital Dasar
// Total Pagu Estimate: ~595M
// ==================================================================================
$p1 = createItem('GK.7448', 'Keterampilan Digital Dasar', 'program', null, 595148000, $urutan);

// Keg 1: 051
$k1_1 = createItem('051', 'Persiapan & Evaluasi Pelatihan Digital', 'kegiatan', $p1->id, 0, $urutan);
$sk1_1_1 = createItem('051.0A', 'Persiapan & Evaluasi', 'sub_kegiatan', $k1_1->id, 0, $urutan);
// Akun
createItem('521211', 'Belanja Bahan', 'akun', $sk1_1_1->id, 20000000, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk1_1_1->id, 15000000, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk1_1_1->id, 45148000, $urutan);

// Keg 2: 052
$k1_2 = createItem('052', 'Pelaksanaan Pelatihan Digital', 'kegiatan', $p1->id, 0, $urutan);
$sk1_2_1 = createItem('052.0A', 'Pelaksanaan', 'sub_kegiatan', $k1_2->id, 0, $urutan);
// Akun
createItem('521211', 'Belanja Bahan', 'akun', $sk1_2_1->id, 150000000, $urutan);
createItem('521213', 'Belanja Honor Output Kegiatan', 'akun', $sk1_2_1->id, 80000000, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk1_2_1->id, 160000000, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk1_2_1->id, 125000000, $urutan);


// ==================================================================================
// Program 2: GK.7449 Pengembangan Talenta Digital
// Total Pagu Estimate: ~103M
// ==================================================================================
$p2 = createItem('GK.7449', 'Talenta Digital Masyarakat', 'program', null, 103148000, $urutan);

// Keg 1: 051
$k2_1 = createItem('051', 'Persiapan & Evaluasi', 'kegiatan', $p2->id, 0, $urutan);
$sk2_1_1 = createItem('051.0A', 'Persiapan & Evaluasi', 'sub_kegiatan', $k2_1->id, 0, $urutan);
// Akun
createItem('521211', 'Belanja Bahan', 'akun', $sk2_1_1->id, 10000000, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk2_1_1->id, 10000000, $urutan);
createItem('524111', 'Belanja Perjalanan Dinas Biasa', 'akun', $sk2_1_1->id, 5000000, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk2_1_1->id, 15000000, $urutan);

// Keg 2: 052
$k2_2 = createItem('052', 'Pelaksanaan', 'kegiatan', $p2->id, 0, $urutan);
$sk2_2_1 = createItem('052.0A', 'Pelaksanaan', 'sub_kegiatan', $k2_2->id, 0, $urutan);
// Akun
createItem('521211', 'Belanja Bahan', 'akun', $sk2_2_1->id, 20000000, $urutan);
createItem('521213', 'Belanja Honor Output Kegiatan', 'akun', $sk2_2_1->id, 13148000, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk2_2_1->id, 15000000, $urutan);
createItem('522191', 'Belanja Jasa Lainnya', 'akun', $sk2_2_1->id, 5000000, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk2_2_1->id, 10000000, $urutan);


// ==================================================================================
// Program 3: GK.7450 Aparatur & Kepemimpinan Digital (NEW)
// ==================================================================================
$p3 = createItem('GK.7450', 'Aparatur & Kepemimpinan Digital', 'program', null, 0, $urutan);

// Keg 1: 051
$k3_1 = createItem('051', 'Persiapan & Evaluasi', 'kegiatan', $p3->id, 0, $urutan);
$sk3_1_1 = createItem('051.0A', 'Persiapan', 'sub_kegiatan', $k3_1->id, 0, $urutan);
// Akun
createItem('521211', 'Belanja Bahan', 'akun', $sk3_1_1->id, 10000000, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk3_1_1->id, 15000000, $urutan);
createItem('524111', 'Belanja Perjalanan Dinas Biasa', 'akun', $sk3_1_1->id, 5000000, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk3_1_1->id, 20000000, $urutan);

// Keg 2: 052
$k3_2 = createItem('052', 'Pelaksanaan', 'kegiatan', $p3->id, 0, $urutan);
$sk3_2_1 = createItem('052.0A', 'Pelaksanaan', 'sub_kegiatan', $k3_2->id, 0, $urutan);
// Akun
createItem('521211', 'Belanja Bahan', 'akun', $sk3_2_1->id, 50000000, $urutan);
createItem('521213', 'Belanja Honor Output Kegiatan', 'akun', $sk3_2_1->id, 30000000, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk3_2_1->id, 50000000, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk3_2_1->id, 45000000, $urutan);


// ==================================================================================
// Program 4: WA.4485 Layanan Perkantoran
// Total Pagu Estimate: ~9.19B
// ==================================================================================
$p4 = createItem('WA.4485', 'Layanan Perkantoran', 'program', null, 9191149000, $urutan);

// Keg 1: 001 Gaji & Tunjangan
$k4_1 = createItem('001', 'Gaji & Tunjangan', 'kegiatan', $p4->id, 0, $urutan);
$sk4_1_1 = createItem('001.0A', 'Pembayaran Gaji PNS', 'sub_kegiatan', $k4_1->id, 0, $urutan);
// Akun
createItem('511111', 'Belanja Gaji Pokok PNS', 'akun', $sk4_1_1->id, 4000000000, $urutan);
createItem('511119', 'Belanja Pembulatan Gaji PNS', 'akun', $sk4_1_1->id, 500000000, $urutan);
createItem('511121', 'Belanja Tunjangan Suami/Istri PNS', 'akun', $sk4_1_1->id, 400000000, $urutan);
createItem('511122', 'Belanja Tunjangan Anak PNS', 'akun', $sk4_1_1->id, 250000000, $urutan);

// Keg 2: 002 Operasional
$k4_2 = createItem('002', 'Operasional Kantor', 'kegiatan', $p4->id, 0, $urutan);
// Sub Kegs
$sk4_2_1 = createItem('002.0G', 'Langganan Listrik', 'sub_kegiatan', $k4_2->id, 0, $urutan);
createItem('522111', 'Belanja Langganan Listrik', 'akun', $sk4_2_1->id, 800000000, $urutan);

$sk4_2_2 = createItem('002.0H', 'Langganan Telepon', 'sub_kegiatan', $k4_2->id, 0, $urutan);
createItem('522112', 'Belanja Langganan Telepon', 'akun', $sk4_2_2->id, 150000000, $urutan);

$sk4_2_3 = createItem('002.0I', 'Langganan Air', 'sub_kegiatan', $k4_2->id, 0, $urutan);
createItem('522113', 'Belanja Langganan Air', 'akun', $sk4_2_3->id, 60000000, $urutan);

$sk4_2_4 = createItem('002.0M', 'Langganan Internet', 'sub_kegiatan', $k4_2->id, 0, $urutan);
createItem('521111', 'Belanja Keperluan Perkantoran', 'akun', $sk4_2_4->id, 250000000, $urutan);

// Fill in remaining specific matches if necessary...

echo "Full Hierarchy Seeded Successfully.\n";
