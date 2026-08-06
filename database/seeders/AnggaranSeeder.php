<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\AkunBelanja;

class AnggaranSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'kode' => 'GB',
                'nama' => 'Program Pemanfaatan Teknologi Informasi dan Komunikasi (TIK)',
                'kegiatans' => [
                    [
                        'kode' => 'GB.4153',
                        'nama' => 'SDM Vokasi Bidang Kominfo',
                        'akun' => [
                            ['kode' => '521211', 'nama' => 'Belanja Bahan', 'pagu' => 10000000],
                            ['kode' => '522151', 'nama' => 'Belanja Jasa Profesi', 'pagu' => 15000000],
                            ['kode' => '524119', 'nama' => 'Belanja Perjalanan Dinas Paket Meeting Luar Kota', 'pagu' => 8000000],
                        ]
                    ],
                    [
                        'kode' => 'GB.4495',
                        'nama' => 'Pengembangan Kompetensi Digital Bagi Masyarakat',
                        'akun' => [
                            ['kode' => '521213', 'nama' => 'Belanja Honor Output Kegiatan', 'pagu' => 7000000],
                            ['kode' => '522191', 'nama' => 'Belanja Jasa Lainnya', 'pagu' => 5000000],
                        ]
                    ],
                ]
            ],
            [
                'kode' => 'GK',
                'nama' => 'Program Pengembangan dan Penguatan Ekosistem dan Ruang Digital',
                'kegiatans' => [
                    [
                        'kode' => 'GK.7449',
                        'nama' => 'Pengembangan Talenta Digital Masyarakat',
                        'akun' => [
                            ['kode' => '521219', 'nama' => 'Belanja Barang Non Operasional Lainnya', 'pagu' => 9000000],
                            ['kode' => '524111', 'nama' => 'Belanja Perjalanan Dinas Biasa', 'pagu' => 4000000],
                        ]
                    ],
                ]
            ],
            [
                'kode' => 'WA',
                'nama' => 'Program Dukungan Manajemen',
                'kegiatans' => [
                    [
                        'kode' => 'WA.4485',
                        'nama' => 'Pengelolaan Keuangan, BMN dan Umum',
                        'akun' => [
                            ['kode' => '511111', 'nama' => 'Belanja Gaji Pokok PNS', 'pagu' => 20000000],
                            ['kode' => '511151', 'nama' => 'Belanja Tunjangan Umum PNS', 'pagu' => 10000000],
                            ['kode' => '521111', 'nama' => 'Belanja Keperluan Perkantoran', 'pagu' => 5000000],
                        ]
                    ]
                ]
            ],
        ];

        foreach ($programs as $p) {
            $program = Program::create([
                'kode' => $p['kode'],
                'nama' => $p['nama'],
            ]);

            foreach ($p['kegiatans'] as $k) {
                $kegiatan = Kegiatan::create([
                    'program_id' => $program->id,
                    'kode' => $k['kode'],
                    'nama' => $k['nama'],
                ]);

                // Create dummy SubKegiatan
                $subKegiatan = \App\Models\SubKegiatan::create([
                    'kegiatan_id' => $kegiatan->id,
                    'kode' => $k['kode'] . '.01',
                    'nama' => 'Sub Kegiatan Default',
                ]);

                // Create dummy Komponen
                $komponen = \App\Models\Komponen::create([
                    'sub_kegiatan_id' => $subKegiatan->id,
                    'kode' => '001',
                    'nama' => 'Komponen Default',
                ]);

                foreach ($k['akun'] as $a) {
                    AkunBelanja::create([
                        'komponen_id' => $komponen->id,
                        'kode' => $a['kode'],
                        'nama' => $a['nama'],
                        'pagu' => $a['pagu'],
                    ]);
                }
            }
        }
    }
}
