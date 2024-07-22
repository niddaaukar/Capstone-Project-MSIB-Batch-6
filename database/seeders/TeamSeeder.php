<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = public_path('frontend/img/team/');
        $destinationPath = 'public/frontend/img/team/';

        $teams = [
            [
                'nama' => 'Nida Aulia Karima',
                'jabatan' => 'Chief Executive Officer (CEO)',
                'photo' => 'team-1.jpg',
                'bio' => 'Nida adalah pemimpin perusahaan yang mengarahkan visi dan strategi bisnis. Dia memastikan semua departemen bekerja menuju tujuan yang sama dan menjaga hubungan baik dengan stakeholder.'
            ],
            [
                'nama' => 'Kharafi Dwi Andika',
                'jabatan' => 'Chief Technology Officer (CTO)',
                'photo' => 'team-2.jpg',
                'bio' => 'Kharafi adalah pemimpin teknis yang memastikan semua solusi teknologi sejalan dengan tujuan bisnis perusahaan. Dia bertanggung jawab atas visi teknologi dan memastikan inovasi terus berkembang.'
            ],
            [
                'nama' => 'Valentino Aldo',
                'jabatan' => 'Chief Operating Officer (COO)',
                'photo' => 'team-3.jpg',
                'bio' => 'Valentino memastikan semua aspek operasional perusahaan berjalan lancar dan efisien. Dia mengkoordinasikan berbagai departemen untuk mencapai tujuan perusahaan.'
            ],
            [
                'nama' => 'Ahmad Shodiqin',
                'jabatan' => 'Chief Financial Officer (CFO)',
                'photo' => 'team-4.jpg',
                'bio' => 'Ahmad mengawasi keuangan perusahaan, memastikan anggaran digunakan dengan efektif dan efisien. Dia juga bertanggung jawab atas laporan keuangan dan strategi keuangan jangka panjang.'
            ],
            [
                'nama' => 'Avila Difa Adhiguna',
                'jabatan' => 'Chief Marketing Officer (CMO)',
                'photo' => 'team-5.jpg',
                'bio' => 'Avila bertanggung jawab atas semua aktivitas pemasaran dan promosi. Dia merancang strategi untuk meningkatkan visibilitas produk dan memastikan pesan perusahaan tersampaikan dengan efektif kepada pelanggan.'
            ],
        ];

        foreach ($teams as $team) {
            // Copy the image to the storage path
            $sourceFile = $sourcePath . $team['photo'];
            $destinationFile = $destinationPath . $team['photo'];

            if (!Storage::exists($destinationFile)) {
                Storage::put($destinationFile, file_get_contents($sourceFile));
            }

            // Update the photo path to storage path
            $team['photo'] = $destinationFile;

            // Create the team record
            Team::create($team);
        }
    }
}
