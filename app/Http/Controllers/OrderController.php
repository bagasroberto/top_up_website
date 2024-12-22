<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function storeProduct(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'game_id' => 'required|string',
            'diamond_amount' => 'required|integer',
            'order_date' => 'required|date',
            'katalog_id' => 'required',
        ]);

        $order = new Order();
        $order->user_id = auth()->id(); // Mendapatkan user ID
        $order->katalog_id = $validated['katalog_id'];
        $order->game_id = $validated['game_id'];
        $order->diamond_amount = $validated['diamond_amount'];
        $order->order_date = $validated['order_date'];
        $order->status = 'Pending';
        $order->save();

        return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan ke admin.');
    }

    // Menampilkan halaman pembayaran
    public function paymentPage(Order $order)
    {
        // Pastikan order statusnya 'pending'
        if ($order->status !== 'Pending') {
            return redirect()->route('home')->with('error', 'Pesanan tidak dalam status pending');
        }

        return view('main-page.payment', compact('order'));
    }

    // Memproses pembayaran
    public function processPayment(Order $order, Request $request)
    {
        // dd($request->all());
        // Logika untuk memproses pembayaran berdasarkan metode yang dipilih
        $paymentMethod = $request->input('payment_method');

        // Pembayaran logika bisa dikembangkan lebih lanjut
        $order->status = 'Paid'; // Misalnya setelah pembayaran sukses statusnya berubah
        $order->save();

        // Redirect ke halaman detail pesanan dengan pesan sukses
        return redirect()->route('main-page.payment', $order->id)->with('success', 'Pembayaran berhasil!');
    }

    public function updatePesanan($id)
    {

        $order = Order::find($id);
        // dd($order);

        if ($order) {
            // Periksa jika status masih Pending dan ubah menjadi Completed
            if ($order->status === 'Pending') {
                // dd('1');
                $order->status = 'Completed';
                $order->save();  // Simpan perubahan ke database

                return redirect()->back()->with('success', 'Pesanan berhasil diproses!');
            }

            return redirect()->back()->with('error', 'Pesanan sudah diproses sebelumnya!');
        }

        return redirect()->back()->with('error', 'Pesanan tidak ditemukan!');

    }
}
