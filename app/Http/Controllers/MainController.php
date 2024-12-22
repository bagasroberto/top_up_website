<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;
use App\Models\Order;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index(){

        $katalogs = Katalog::orderBy('created_at', 'desc')->take(8)->get();

        $orders = Order::leftJoin('katalogs', 'katalogs.id', 'orders.katalog_id') // Memuat data katalog yang terkait dengan order
            ->where('orders.user_id', auth()->id()) // Hanya untuk user yang sedang login
            ->orderBy('orders.order_date', 'desc') // Urutkan berdasarkan tanggal
            ->limit(4) // Ambil 4 pembelian terbaru
            ->get();

        // Pastikan `order_date` dikonversi menjadi objek Carbon sebelum dikirim ke view
        foreach ($orders as $order) {
            $order->order_date = Carbon::parse($order->order_date); // Mengubah menjadi objek Carbon
        }

        // dd($orders);

        return view('main-page.beranda', compact('katalogs', 'orders'));
    }

    public function indexProduk()
    {
        $featuredKatalogs = Katalog::take(6)->get(); // Ambil 6 katalog untuk "Featured Games"
        $topKatalogs = Katalog::orderBy('harga_katalog', 'desc')->take(3)->get(); // Ambil 3 katalog dengan harga tertinggi untuk "Top Downloaded"

        $featuredGames = Katalog::take(6)->get(); // Ambil 6 produk untuk "Featured Games"
        $topDownloaded = Katalog::orderBy('created_at', 'desc')->take(8)->get(); // Ambil 3 produk untuk "Top Downloaded"

        return view('main-page.produk', compact('featuredKatalogs', 'topKatalogs'));
    }

    public function showProduct($id)
    {
        $id = $id;
        // dd($id);
        $produk = Katalog::findOrFail($id); // Cari produk berdasarkan ID

        return view('main-page.detailproduk', compact('produk', 'id')); // Kirim data ke view
    }

    public function indexPesanan()
    {
        $orders = Order::leftJoin('katalogs', 'katalogs.id', '=', 'orders.katalog_id')
        ->where('orders.user_id', auth()->id())
        // ->select('orders.*', 'katalogs.*') // Pilih kolom yang tepat
        ->select('orders.*', 'katalogs.nama_katalog')

        ->get();


        // dd($orders);
        return view('main-page.pesanan', compact('orders'));

    }

    public function search($category)
    {
        // Mencari produk berdasarkan kategori yang dipilih
        if ($category === 'mobile') {
            $featuredKatalogs = Katalog::where('deskripsi_katalog', 'like', '%mobile%')->get();
            $topKatalogs = Katalog::where('deskripsi_katalog', 'like', '%mobile%')->orderBy('harga_katalog', 'desc')->get();
        } elseif ($category === 'pc') {
            $featuredKatalogs = Katalog::where('deskripsi_katalog', 'like', '%pc%')->get();
            $topKatalogs = Katalog::where('deskripsi_katalog', 'like', '%pc%')->orderBy('harga_katalog', 'desc')->get();
        } else {
            // Jika tidak ada kategori, tampilkan semua produk
            $featuredKatalogs = Katalog::all();
            $topKatalogs = Katalog::orderBy('harga_katalog', 'desc')->get();
        }

        return view('main-page.produk-pencarian', compact('featuredKatalogs', 'topKatalogs'));
    }
}
