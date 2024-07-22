<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Type;
use App\Models\TypeMotorcycle;
use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\User;
use App\Models\Contact;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $startOfWeek = Carbon::now()->subDays(7);
        $endOfWeek = Carbon::now();
        $startOfLastWeek = Carbon::now()->subDays(14);
        $endOfLastWeek = Carbon::now()->subDays(7);
        // dd($startOfWeek, $endOfWeek, $startOfLastWeek, $endOfLastWeek);

        // Menghitung jumlah booking dengan status "Menunggu Pembayaran"
        $countMenungguPembayaran = Booking::where('booking_status', 'Menunggu Pembayaran')->count();
        $countMenungguPembayaranThisWeek = Booking::where('booking_status', 'Menunggu Pembayaran')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
        $countMenungguPembayaranLastWeek = Booking::where('booking_status', 'Menunggu Pembayaran')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();
        // menghitung perbedaan jumlah menunggu pembayaran antara minggu ini dan minggu lalu
        $percentageChangeMenungguPembayaran = 0;
        $percentageChangeMenungguPembayaran = (($countMenungguPembayaranThisWeek - $countMenungguPembayaranLastWeek) / max($countMenungguPembayaranLastWeek, 1)) * 100;


        // Menghitung jumlah booking dengan status "Pembayaran Terkonfirmasi"
        $countPembayaranTerkonfirmasi = Booking::where('booking_status', 'Pembayaran Terkonfirmasi')->count();
        $countPembayaranTerkonfirmasiThisWeek = Booking::where('booking_status', 'Pembayaran Terkonfirmasi')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
        $countPembayaranTerkonfirmasiLastWeek = Booking::where('booking_status', 'Pembayaran Terkonfirmasi')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();
        // Hitung persentase perubahan per minggu
        $percentageChangePembayaranTerkonfirmasi = 0;
        $percentageChangePembayaranTerkonfirmasi = (($countPembayaranTerkonfirmasiThisWeek - $countPembayaranTerkonfirmasiLastWeek) / max($countPembayaranTerkonfirmasiLastWeek, 1)) * 100;


        // Menghitung semua booking yang belum dikembalikan
        $countBelumDikembalikan = Booking::where('booking_status', 'Belum Dikembalikan')->count();
        $countBelumDikembalikanThisWeek = Booking::where('booking_status', 'Belum Dikembalikan')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
        $countBelumDikembalikanLastWeek = Booking::where('booking_status', 'Belum Dikembalikan')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();
        // Hitung persentase perubahan per minggu
        $percentageChangeBelumDikembalikan = 0;
        $percentageChangeBelumDikembalikan = (($countBelumDikembalikanThisWeek - $countBelumDikembalikanLastWeek) / max($countBelumDikembalikanLastWeek, 1)) * 100;


        // menghitung jenis kendaraan
        $countJenisMobil =  Type::count();
        $countJenisMotor =  TypeMotorcycle::count();
        $countJenisKendaraanSaatIni = $countJenisMobil + $countJenisMotor;
        // menghitung jumlah kendaraan minggu ini
        $countJenisMobilThisWeek = Type::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $countJenisMotorThisWeek = TypeMotorcycle::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $countJenisKendaraanThisWeek = $countJenisMobilThisWeek + $countJenisMotorThisWeek;
        // menghitung semua kendaraan minggu lalu
        $countJenisMobilLastWeek = Type::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $countJenisMotorLastWeek = TypeMotorcycle::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $countJenisKendaraanLastWeek = $countJenisMobilLastWeek + $countJenisMotorLastWeek;
        // Hitung perbedaan jumlah kendaraan antara minggu ini dan minggu lalu
        $percentageChangeJenisKendaraan = 0;
        $percentageChangeJenisKendaraan = (($countJenisKendaraanThisWeek - $countJenisKendaraanLastWeek) / max($countJenisKendaraanLastWeek, 1)) * 100;


        // menghitung total kendaraan
        $countJumlahMobil =  Car::count();
        $countJumlahMotor =  Motorcycle::count();
        $countJumlahKendaraanSaatIni = $countJumlahMobil + $countJumlahMotor;
        // menghitung semua kendaraan minggu ini
        $countJumlahMobilThisWeek = Car::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $countJumlahMotorThisWeek = Motorcycle::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $countJumlahKendaraanMingguIni = $countJumlahMobilThisWeek + $countJumlahMotorThisWeek;
        // menghitung semua kendaraan minggu lalu
        $countJumlahMobilLastWeek = Car::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $countJumlahMotorLastWeek = Motorcycle::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $countJumlahKendaraanMingguLalu = $countJumlahMobilLastWeek + $countJumlahMotorLastWeek;
        // Hitung perbedaan semua kendaraan antara minggu ini dan minggu lalu
        $percentageChangeJumlahKendaraan = 0;
        $percentageChangeJumlahKendaraan = (($countJumlahKendaraanMingguIni - $countJumlahKendaraanMingguLalu) / max($countJumlahKendaraanMingguLalu, 1)) * 100;


        // menghitung semua booking
        $countBooking = Booking::count();
        $countBookingThisWeek = Booking::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $countBookingLastWeek = Booking::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        // Menghitung perbedaan jumlah booking antara minggu ini dan minggu lalu
        $percentageChangeBooking = 0;
        $percentageChangeBooking = (($countBookingThisWeek - $countBookingLastWeek) / max($countBookingLastWeek, 1)) * 100;


        // menghitung semua user
        $countUser = User::count();
        $countUserThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $countUserLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        // Menghitung perbedaan semua user antara minggu ini dan minggu lalu
        $percentageChangeUser = 0;
        $percentageChangeUser = (($countUserThisWeek - $countUserLastWeek) / max($countUserLastWeek, 1)) * 100;


        // menghitung semua hubungi kami
        $countHubungiKami = Contact::count();
        $countHubungiKamiThisWeek = Contact::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
        $countHubungiKamiLastWeek = Contact::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();
        // Hitung persentase perubahan per minggu
        $percentageChangeHubungiKami = 0;
        $percentageChangeHubungiKami = (($countHubungiKamiThisWeek - $countHubungiKamiLastWeek) / max($countHubungiKamiLastWeek, 1)) * 100;


        $bookings = Booking::orderBy('created_at', 'desc')->get(); // Mengambil semua booking
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get(); // Mengambil semua feedback
        $users = User::get(); // Mengambil semua user


        // Data untuk grafik berdasarkan jumlah booking per bulan selama 12 bulan terakhir
        $start = Carbon::now()->subMonths(11)->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        // Hitung perbedaan persentase antara bulan ini dan bulan lalu
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');
        $thisMonth = Carbon::now()->format('Y-m');


        // Data untuk grafik total pendapatan per bulan selama 12 bulan terakhir
        $incomeData = Booking::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_fee) as total'))
            ->where('booking_status', 'Selesai')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('month', 'asc')
            ->pluck('total', 'month');
        $formattedIncomeData = [];
        $current = $start->copy();
        while ($current <= $end) {
            $formattedIncomeData[$current->format('Y-m')] = $incomeData->get($current->format('Y-m'), 0);
            $current->addMonth();
        }
        // Hitung perbedaan persentase pendapatan antara bulan ini dan bulan lalu
        $incomeLastMonth = $formattedIncomeData[$lastMonth] ?? 0;
        $incomeThisMonth = $formattedIncomeData[$thisMonth] ?? 0;
        if ($incomeLastMonth > 0) {
            $incomePercentageChange = (($incomeThisMonth - $incomeLastMonth) / $incomeLastMonth) * 100;
        } else {
            $incomePercentageChange = $incomeThisMonth > 0 ? 100 : 0;
        }            

        // Mengirim data ke view
        return view(
            'home',
            compact(
                'countMenungguPembayaran',
                'countPembayaranTerkonfirmasi',
                'countBelumDikembalikan',
                'countJenisKendaraanSaatIni',
                'countJumlahKendaraanSaatIni',
                'countBooking',
                'countUser',
                'countHubungiKami',
                'bookings',
                'users',
                'feedbacks',
                'formattedIncomeData',
                'incomePercentageChange',
                'percentageChangeMenungguPembayaran',
                'percentageChangePembayaranTerkonfirmasi',
                'percentageChangeBelumDikembalikan',
                'percentageChangeBooking',
                'percentageChangeUser',
                'percentageChangeHubungiKami',
                'percentageChangeJenisKendaraan',
                'percentageChangeJumlahKendaraan',
                'percentageChangeHubungiKami',
            )
        );
    }
}
