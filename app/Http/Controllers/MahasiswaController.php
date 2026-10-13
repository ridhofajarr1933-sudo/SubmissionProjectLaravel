<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    private function dataMahasiswa()
    {
        return [
            [
                'nama' => 'Andi Saputra',
                'nim' => '2401001',
                'prodi' => 'Informatika',
                'ipk' => 3.80,
            ],
            [
                'nama' => 'Budi Santoso',
                'nim' => '2401002',
                'prodi' => 'Sistem Informasi',
                'ipk' => 3.20,
            ],
            [
                'nama' => 'Citra Lestari',
                'nim' => '2401003',
                'prodi' => 'Informatika',
                'ipk' => 3.60,
            ],
            [
                'nama' => 'Dedi Pratama',
                'nim' => '2401004',
                'prodi' => 'Sistem Informasi',
                'ipk' => 1.80,
            ],
            [
                'nama' => 'Eka Wulandari',
                'nim' => '2401005',
                'prodi' => 'Informatika',
                'ipk' => 2.90,
            ],
        ];
    }

    public function profil()
    {
        $nama = 'Ridho Fajar Ramadani';
        $nim = '242520011';
        $prodi = 'Informatika';

        return view('mahasiswa.profil', compact(
            'nama',
            'nim',
            'prodi'
        ));
    }

    public function daftar()
    {
        $mahasiswa = $this->dataMahasiswa();

        return view('mahasiswa.daftar', compact('mahasiswa'));
    }

    public function detail($nim)
    {
        $mahasiswa = collect($this->dataMahasiswa())
            ->firstWhere('nim', $nim);

        if (!$mahasiswa) {
            abort(404);
        }

        return view('mahasiswa.detail', compact('mahasiswa'));
    }
}
