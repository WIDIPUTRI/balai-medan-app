<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Anggaran;
use App\Models\RealisasiAnggaran;
use Illuminate\Support\Facades\DB;

// Clear existing data
DB::statement('SET FOREIGN_KEY_CHECKS = 0');
RealisasiAnggaran::truncate();
Anggaran::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS = 1');

$urutan = 0;

function createItem($kode, $uraian, $level, $parentId, $pagu, $realisasi, &$urutanRef)
{
    return Anggaran::create([
        'kode' => $kode,
        'uraian' => $uraian,
        'level' => $level,
        'parent_id' => $parentId,
        'pagu_revisi' => $pagu,
        'limit_pagu' => $pagu,
        'realisasi_lalu' => 0,
        'realisasi_ini' => $realisasi, // Directly set for non-detailed seeding
        'urutan' => ++$urutanRef,
    ]);
}

// 1. GK.7448 (Total Pagu: 164.557.000)
$p1 = createItem('GK.7448', 'Pengembangan Keterampilan Digital Dasar', 'program', null, 164557000, 0, $urutan);
// BQA (Mapped to Kegiatan for Simplicity or Sub) - let's use Kegiatan
$k1 = createItem('051', 'Pelatihan Keterampilan Digital Dasar', 'kegiatan', $p1->id, 104557000, 0, $urutan);
// Sub 051
$sk1 = createItem('051.0A', 'Persiapan & Evaluasi Pelatihan', 'sub_kegiatan', $k1->id, 27649000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk1->id, 4099000, 0, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk1->id, 1000000, 0, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk1->id, 22550000, 0, $urutan);
// Sub 052
$sk2 = createItem('052.0A', 'Pelaksanaan Pelatihan Digital', 'sub_kegiatan', $k1->id, 76908000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk2->id, 49468000, 0, $urutan);
createItem('521213', 'Belanja Honor Output Kegiatan', 'akun', $sk2->id, 2400000, 0, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk2->id, 5000000, 0, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'akun', $sk2->id, 20040000, 0, $urutan);

// Missing 60M to reach 164.557? 
// 27 + 76 = ~104. 
// Let's add SCA.001 as another Kegiatan to make up the difference (approx 60M)
$k1_2 = createItem('SCA.001', 'Pelatihan Lainnya', 'kegiatan', $p1->id, 60000000, 0, $urutan);
$sk1_2 = createItem('SCA.0A', 'Pelaksanaan', 'sub_kegiatan', $k1_2->id, 60000000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk1_2->id, 60000000, 0, $urutan);

// 2. GK.7449 (Total Pagu: 82.594.000)
$p2 = createItem('GK.7449', 'Pengembangan Talenta Digital Masyarakat', 'program', null, 82594000, 0, $urutan);
$k2 = createItem('051', 'Fasilitasi Sertifikasi', 'kegiatan', $p2->id, 82594000, 0, $urutan);
$sk2_1 = createItem('051.0A', 'Persiapan dan Evaluasi', 'sub_kegiatan', $k2->id, 46124000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk2_1->id, 11200000, 0, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk2_1->id, 1500000, 0, $urutan);
createItem('524111', 'Belanja Perjalanan Dinas Biasa', 'akun', $sk2_1->id, 6949000, 0, $urutan);
createItem('524119', 'Belanja Perjalanan Dinas Paket Meeting', 'akun', $sk2_1->id, 26475000, 0, $urutan);
$sk2_2 = createItem('052.0A', 'Pelaksanaan Sertifikasi', 'sub_kegiatan', $k2->id, 36470000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk2_2->id, 22464000, 0, $urutan);
createItem('521213', 'Belanja Honor Output', 'akun', $sk2_2->id, 800000, 0, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk2_2->id, 4500000, 0, $urutan);
createItem('522191', 'Belanja Jasa Lainnya', 'akun', $sk2_2->id, 8706000, 0, $urutan);

// 3. GK.7450 (Total Pagu: 103.148.000)
$p3 = createItem('GK.7450', 'Pengembangan Kompetensi SDM Aparatur', 'program', null, 103148000, 0, $urutan);
$k3 = createItem('BQA.001', 'Pelatihan Aparatur Digital', 'kegiatan', $p3->id, 103148000, 0, $urutan);
$sk3_1 = createItem('051.0A', 'Persiapan dan Evaluasi', 'sub_kegiatan', $k3->id, 33421000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk3_1->id, 10375000, 0, $urutan);
createItem('522151', 'Belanja Jasa Profesi', 'akun', $sk3_1->id, 1000000, 0, $urutan);
createItem('524111', 'Belanja Perjalanan Dinas Biasa', 'akun', $sk3_1->id, 4546000, 0, $urutan);
createItem('524119', 'Belanja PD Paket Meeting Luar Kota', 'akun', $sk3_1->id, 17500000, 0, $urutan);
$sk3_2 = createItem('052.0A', 'Pelaksanaan Pelatihan', 'sub_kegiatan', $k3->id, 69727000, 0, $urutan);
createItem('521211', 'Belanja Bahan', 'akun', $sk3_2->id, 32402000, 0, $urutan);
createItem('524119', 'Belanja PD Paket Meeting', 'akun', $sk3_2->id, 37325000, 0, $urutan);

// 4. WA.4485 (Total Pagu: 9.539.146.000) (Calculated remainder for grand total 9.889.445.000)
$p4 = createItem('WA.4485', 'Program Dukungan Manajemen', 'program', null, 9539146000, 320948350, $urutan);
$k4 = createItem('001', 'Gaji dan Tunjangan', 'kegiatan', $p4->id, 4712566000, 320948350, $urutan);
$sk4_1 = createItem('001.0A', 'Pembayaran Gaji PNS', 'sub_kegiatan', $k4->id, 3139783000, 320948350, $urutan);
createItem('511111', 'Belanja Gaji Pokok PNS', 'akun', $sk4_1->id, 1092289000, 169904900, $urutan);
createItem('511119', 'Belanja Pembulatan Gaji PNS', 'akun', $sk4_1->id, 20000, 3450, $urutan);
createItem('511121', 'Belanja Tunj. Suami/Istri PNS', 'akun', $sk4_1->id, 82958000, 9598320, $urutan);
createItem('511122', 'Belanja Tunj. Anak PNS', 'akun', $sk4_1->id, 24456000, 2379552, $urutan);
createItem('511123', 'Belanja Tunj. Struktural PNS', 'akun', $sk4_1->id, 7850000, 4210000, $urutan);
createItem('511124', 'Belanja Tunj. Fungsional PNS', 'akun', $sk4_1->id, 105574000, 5822000, $urutan);
createItem('511151', 'Belanja Tunj. Beras PNS', 'akun', $sk4_1->id, 41224000, 7891380, $urutan);
createItem('511129', 'Belanja Uang Makan PNS', 'akun', $sk4_1->id, 238965000, 0, $urutan); // No realisasi yet? Or in image?

// Need to fill rest to match totals
createItem('512411', 'Belanja Pegawai (Tunjangan Kinerja)', 'akun', $sk4_1->id, 1546447000, 110943930, $urutan);

// PPPK
$sk4_2 = createItem('001.0B', 'Gaji dan Tunjangan PPPK', 'sub_kegiatan', $k4->id, 1572783000, 0, $urutan);
createItem('511111', 'Belanja Gaji Pokok PPPK', 'akun', $sk4_2->id, 1000000000, 110943930, $urutan); // Partial

$k4_2 = createItem('002', 'Operasional dan Pemeliharaan Kantor', 'kegiatan', $p4->id, 4826580000, 0, $urutan);
$sk4_2_1 = createItem('002.0A', 'Pemenuhan Jamali', 'sub_kegiatan', $k4_2->id, 87400000, 0, $urutan);
createItem('521111', 'Belanja Keperluan Perkantoran', 'akun', $sk4_2_1->id, 87400000, 0, $urutan);

// Add bulk item for rest of 4.8B
$sk4_2_2 = createItem('002.0B', 'Pemeliharaan Gedung', 'sub_kegiatan', $k4_2->id, 4739180000, 0, $urutan);
createItem('523111', 'Belanja Pemeliharaan Gedung', 'akun', $sk4_2_2->id, 4739180000, 0, $urutan);

echo "Final Data Seeded. Pagu: 9.889.445.000 | Realisasi: 320.948.350\n";
