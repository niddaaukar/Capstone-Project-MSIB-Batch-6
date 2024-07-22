<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{

    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara melakukan pemesanan Kendaraan di OtoRent?',
                'answer' => 'Kunjungi halaman pemesanan, pilih mobil dan waktu sewa, lalu isi formulir dan lakukan pembayaran. Admin akan mengonfirmasi penyewaan Anda.'
            ],
            [
                'question' => 'Apa syarat dan ketentuan untuk menyewa Kendaraan di OtoRent?',
                'answer' => 'Anda harus memiliki usia minimal 17 tahun. Memiliki SIM yang masih berlaku. Menyediakan identitas yang valid, seperti KTP.'
            ],
            [
                'question' => 'Bagaimana metode pembayaran yang diterima?',
                'answer' => 'Kami menerima pembayaran melalui transfer bank dan dompet digital.'
            ],
            [
                'question' => 'Apakah ada biaya tambahan yang harus saya bayar?',
                'answer' => 'Biaya sewa mobil sudah termasuk dalam harga yang tertera. Namun, biaya seperti pengemudi tambahan dan bahan bakar ditanggung oleh penyewa.'
            ],
            [
                'question' => 'Bagaimana kebijakan pembatalan?',
                'answer' => 'Jika pembayaran belum diterima dalam 1 hari, penyewaan otomatis dibatalkan.'
            ],
            [
                'question' => 'Bagaimana kebijakan Denda di OtoRent?',
                'answer' => 'Jika penyewa melebihi masa sewa, maka akan dikenakan denda sebesar biaya sewa per-hari'
            ],
            [
                'question' => 'Apakah ada batasan jarak perjalanan?',
                'answer' => 'Kami memberikan jarak perjalanan yang tidak terbatas.'
            ],
            [
                'question' => 'Bagaimana cara menghubungi Pihak OtoRent?',
                'answer' => 'Anda dapat menghubungi tim dukungan kami melalui nomor telepon atau email yang tertera di halaman kontak kami.'
            ],
        ];

        Faq::insert($faqs);
    }
}
