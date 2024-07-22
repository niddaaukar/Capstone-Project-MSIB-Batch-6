<?php

namespace Database\Seeders;

use App\Models\Motorcycle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = public_path('frontend/img/motorcycles/');
        $destinationPath = 'public/motorcycles/images/';

        $motos = [
            [
                'id' => '1',
                'nama_motor' => 'Honda Beat',
                'plat_nomor'  => 'AD 2345 VW',
                'slug' => 'honda-beat',
                'type_id' => '1',
                'price' => '70000',
                'description' => 'Honda Beat Pink adalah pilihan sempurna bagi mereka yang mencari kendaraan dengan tampilan ceria dan energik. Warna pink yang mencolok sangat cocok untuk kaum muda atau mereka yang ingin tampil berbeda di jalan. Motor ini ideal untuk penggunaan harian di perkotaan, dengan desain yang ramping dan mudah dikendarai.',
                'image1' => 'matic-honda-beat-1-1-pink.jpg',
                'image2' => 'matic-honda-beat-1-2-pink.jpg',
                'image3' => 'matic-honda-beat-1-3-pink.jpg',
                'image4' => 'matic-honda-beat-1-4-pink.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'nama_motor' => 'Honda Beat',
                'plat_nomor'  => 'AD 2346 VW',
                'slug' => 'honda-beat',
                'type_id' => '1',
                'price' => '70000',
                'description' => 'Honda Beat Hitam menawarkan kesan elegan dan maskulin. Warna hitam yang klasik cocok untuk semua kalangan, baik pria maupun wanita. Motor ini sangat cocok untuk perjalanan sehari-hari, termasuk pergi ke kantor atau kampus, karena tampilannya yang netral dan elegan.',
                'image1' => 'matic-honda-beat-2-1-hitam.jpg',
                'image2' => 'matic-honda-beat-2-2-hitam.jpg',
                'image3' => 'matic-honda-beat-2-3-hitam.jpg',
                'image4' => 'matic-honda-beat-2-4-hitam.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'nama_motor' => 'Honda Beat',
                'plat_nomor'  => 'AD 2347 VW',
                'slug' => 'honda-beat',
                'type_id' => '1',
                'price' => '70000',
                'description' => 'Honda Beat Putih adalah pilihan yang sempurna bagi mereka yang menyukai tampilan bersih dan modern. Warna putih memberikan kesan stylish dan cocok untuk segala situasi, baik itu untuk aktivitas sehari-hari atau jalan-jalan santai di akhir pekan.',
                'image1' => 'matic-honda-beat-3-1-putih.jpg',
                'image2' => 'matic-honda-beat-3-2-putih.jpg',
                'image3' => 'matic-honda-beat-3-3-putih.jpg',
                'image4' => 'matic-honda-beat-3-4-putih.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '4',
                'nama_motor' => 'Honda Vario',
                'plat_nomor'  => 'AD 2348 VW',
                'slug' => 'honda-vario',
                'type_id' => '1',
                'price' => '80000',
                'description' => 'Honda Vario Hitam adalah motor yang menggabungkan kekuatan dan gaya. Warna hitam yang kuat membuatnya terlihat gagah dan cocok untuk pengendara yang membutuhkan kendaraan dengan performa tangguh serta desain yang menarik. Cocok untuk penggunaan di perkotaan maupun perjalanan jarak menengah.',
                'image1' => 'matic-honda-vario-1-1-hitam.jpg',
                'image2' => 'matic-honda-vario-1-2-hitam.jpg',
                'image3' => 'matic-honda-vario-1-3-hitam.jpg',
                'image4' => 'matic-honda-vario-1-4-hitam.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '5',
                'nama_motor' => 'Yamaha Lexi',
                'plat_nomor'  => 'AD 2349 VW',
                'slug' => 'yamaha-lexi',
                'type_id' => '1',
                'price' => '105000',
                'description' => 'Yamaha Lexi Hitam hadir dengan desain modern dan sporty. Warna hitamnya memberikan tampilan yang dinamis dan berkelas. Motor ini sangat cocok untuk mereka yang mencari kenyamanan dan kepraktisan dalam berkendara, terutama untuk perjalanan harian di kota.',
                'image1' => 'matic-yamaha-lexi-1-1-hitam.jpg',
                'image2' => 'matic-yamaha-lexi-1-2-hitam.jpg',
                'image3' => 'matic-yamaha-lexi-1-3-hitam.jpg',
                'image4' => 'matic-yamaha-lexi-1-4-hitam.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '6',
                'nama_motor' => 'Yamaha Nmax',
                'plat_nomor'  => 'AD 2350 VW',
                'slug' => 'yamaha-nmax',
                'type_id' => '1',
                'price' => '150000',
                'description' => 'Yamaha Nmax Putih adalah pilihan ideal untuk mereka yang menginginkan kenyamanan dan performa tinggi. Warna putih yang elegan membuat motor ini terlihat mewah dan cocok untuk pengendara yang sering melakukan perjalanan jarak jauh atau membutuhkan kenyamanan ekstra saat berkendara di kota.',
                'image1' => 'matic-yamaha-nmax-1-1-putih.jpg',
                'image2' => 'matic-yamaha-nmax-1-2-putih.jpg',
                'image3' => 'matic-yamaha-nmax-1-3-putih.jpg',
                'image4' => 'matic-yamaha-nmax-1-4-putih.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '7',
                'nama_motor' => 'Honda PCX',
                'plat_nomor'  => 'AD 2351 VW',
                'slug' => 'honda-pcx',
                'type_id' => '1',
                'price' => '135000',
                'description' => 'Honda PCX Hitam menawarkan kenyamanan dan kemewahan dalam satu paket. Warna hitamnya yang elegan cocok untuk pengendara yang mencari motor dengan fitur lengkap dan desain premium. Ideal untuk perjalanan harian maupun touring.',
                'image1' => 'matic-honda-pcx-1-1-hitam.jpg',
                'image2' => 'matic-honda-pcx-1-2-hitam.jpg',
                'image3' => 'matic-honda-pcx-1-3-hitam.jpg',
                'image4' => 'matic-honda-pcx-1-4-hitam.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '8',
                'nama_motor' => 'Honda Vario',
                'plat_nomor'  => 'AD 2352 VW',
                'slug' => 'honda-vario',
                'type_id' => '1',
                'price' => '80000',
                'description' => 'Honda Vario Merah adalah motor yang mencolok dan energik. Warna merah yang cerah sangat cocok untuk mereka yang ingin tampil berani dan penuh semangat. Motor ini sangat cocok untuk pengendara muda dan dinamis, baik untuk perjalanan ke kampus atau aktivitas harian lainnya.',
                'image1' => 'matic-honda-vario-2-1-merah.jpg',
                'image2' => 'matic-honda-vario-2-2-merah.jpg',
                'image3' => 'matic-honda-vario-2-3-merah.jpg',
                'image4' => 'matic-honda-vario-2-4-merah.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '9',
                'nama_motor' => 'Honda Revo',
                'plat_nomor'  => 'AD 2353 VW',
                'slug' => 'honda-revo',
                'type_id' => '2',
                'price' => '100000',
                'description' => 'Honda Revo Hitam adalah pilihan praktis untuk pengendara yang mencari efisiensi dan daya tahan. Warna hitamnya yang klasik membuatnya cocok untuk segala usia dan kebutuhan, baik untuk perjalanan sehari-hari atau kegiatan bisnis.',
                'image1' => 'bebek-honda-revo-1-1-hitam.jpg',
                'image2' => 'bebek-honda-revo-1-2-hitam.jpg',
                'image3' => 'bebek-honda-revo-1-3-hitam.jpg',
                'image4' => 'bebek-honda-revo-1-4-hitam.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '10',
                'nama_motor' => 'Honda Supra',
                'plat_nomor'  => 'AD 2354 VW',
                'slug' => 'honda-supra',
                'type_id' => '2',
                'price' => '70000',
                'description' => 'Honda Supra Biru menawarkan kesan segar dan dinamis. Warna birunya memberikan tampilan yang sporty dan modern, cocok untuk pengendara muda maupun dewasa yang mencari motor dengan performa handal dan tampilan menarik.',
                'image1' => 'bebek-honda-supra-2-1-biru.jpg',
                'image2' => 'bebek-honda-supra-2-2-biru.jpg',
                'image3' => 'bebek-honda-supra-2-3-biru.jpg',
                'image4' => 'bebek-honda-supra-2-4-biru.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '11',
                'nama_motor' => 'Honda Supra X',
                'plat_nomor'  => 'AD 2355 VW',
                'slug' => 'honda-supra-x',
                'type_id' => '2',
                'price' => '70000',
                'description' => 'Honda Supra X Merah adalah motor dengan desain sporty dan energik. Warna merahnya yang mencolok cocok untuk mereka yang ingin tampil berbeda dan penuh gaya di jalanan. Ideal untuk berbagai kebutuhan, dari aktivitas harian hingga perjalanan jarak menengah.',
                'image1' => 'bebek-honda-supra-3-1-merah.jpg',
                'image2' => 'bebek-honda-supra-3-2-merah.jpg',
                'image3' => 'bebek-honda-supra-3-3-merah.jpg',
                'image4' => 'bebek-honda-supra-3-4-merah.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '12',
                'nama_motor' => 'Honda Supra X',
                'plat_nomor'  => 'AD 2356 VW',
                'slug' => 'honda-supra-x',
                'type_id' => '2',
                'price' => '70000',
                'description' => 'Honda Supra X Merah adalah motor dengan desain sporty dan energik. Warna merahnya yang mencolok cocok untuk mereka yang ingin tampil berbeda dan penuh gaya di jalanan. Ideal untuk berbagai kebutuhan, dari aktivitas harian hingga perjalanan jarak menengah.',
                'image1' => 'bebek-honda-supra-1-1-merah.jpg',
                'image2' => 'bebek-honda-supra-1-2-merah.jpg',
                'image3' => 'bebek-honda-supra-1-3-merah.jpg',
                'image4' => 'bebek-honda-supra-1-4-merah.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '13',
                'nama_motor' => 'Yamaha R15',
                'plat_nomor'  => 'AD 2357 VW',
                'slug' => 'yamaha-r15',
                'type_id' => '3',
                'price' => '200000',
                'description' => 'Yamaha R15 Kuning adalah motor sport yang menawarkan performa tinggi dan desain agresif. Warna kuning yang mencolok membuatnya sangat menarik perhatian dan cocok untuk pengendara yang menginginkan kecepatan dan tampilan sporty.',
                'image1' => 'sport-yamaha-r15-1-1-kuning.jpg',
                'image2' => 'sport-yamaha-r15-1-2-kuning.jpg',
                'image3' => 'sport-yamaha-r15-1-3-kuning.jpg',
                'image4' => 'sport-yamaha-r15-1-4-kuning.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '14',
                'nama_motor' => 'Honda CBR',
                'plat_nomor'  => 'AD 2358 VW',
                'slug' => 'honda-cbr',
                'type_id' => '3',
                'price' => '200000',
                'description' => 'Honda CBR Oranye adalah motor sport dengan desain yang agresif dan penuh gaya. Warna oranye yang mencolok membuatnya ideal untuk mereka yang ingin tampil beda dan menonjol di jalanan. Cocok untuk pengendara yang mengutamakan performa dan tampilan.',
                'image1' => 'sport-honda-cbr-1-1-orange.jpg',
                'image2' => 'sport-honda-cbr-1-2-orange.jpg',
                'image3' => 'sport-honda-cbr-1-3-orange.jpg',
                'image4' => 'sport-honda-cbr-1-4-orange.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '15',
                'nama_motor' => 'Honda CBR',
                'plat_nomor'  => 'AD 2359 VW',
                'slug' => 'honda-cbr',
                'type_id' => '3',
                'price' => '200000',
                'description' => ' Honda CBR Hitam adalah motor sport yang menggabungkan performa tinggi dengan desain yang elegan dan agresif. Warna hitam yang klasik memberikan kesan maskulin dan mewah, membuat motor ini cocok untuk pengendara yang ingin tampil berkelas di jalan.',
                'image1' => 'sport-honda-cbr-2-1-hitam.jpg',
                'image2' => 'sport-honda-cbr-2-2-hitam.jpg',
                'image3' => 'sport-honda-cbr-2-3-hitam.jpg',
                'image4' => 'sport-honda-cbr-2-4-hitam.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '16',
                'nama_motor' => 'Suzuki GSX',
                'plat_nomor'  => 'H 6754 VW',
                'slug' => 'suzuki-gsx',
                'type_id' => '3',
                'price' => '200000',
                'description' => 'Suzuki GSX Biru adalah motor sport yang menawarkan performa tinggi dan desain stylish. Warna biru memberikan tampilan yang segar dan modern, cocok untuk pengendara yang mencari keseimbangan antara gaya dan kecepatan. Ideal untuk penggunaan di trek maupun di jalan raya.',
                'image1' => 'sport-suzuki-gsx-1-1-biru.jpg',
                'image2' => 'sport-suzuki-gsx-1-2-biru.jpg',
                'image3' => 'sport-suzuki-gsx-1-3-biru.jpg',
                'image4' => 'sport-suzuki-gsx-1-4-biru.jpg',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($motos as $moto) {
            // Iterate over each image
            for ($i = 1; $i <= 4; $i++) {
                $imageKey = 'image' . $i;

                // Get source and destination paths for the current image
                $sourceFile = $sourcePath . $moto[$imageKey];
                $destinationFile = $destinationPath . basename($moto[$imageKey]);

                // Check if the destination file doesn't exist
                if (!Storage::exists($destinationFile)) {
                    // Copy the image to the destination path
                    Storage::put($destinationFile, file_get_contents($sourceFile));
                }

                // Update the photo path to the storage path for the current image
                $moto[$imageKey] = 'motorcycles/images/' . basename($moto[$imageKey]);
            }

            // Create the motorcycle record
            Motorcycle::create($moto);
        }
    }
}
