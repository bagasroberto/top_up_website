@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="heading-section">
            <h4><em>Opsi Pembayaran</em> untuk Pesanan ID {{ $order->id }}</h4>
        </div>

        <form method="POST" action="{{ route('orders.pay', $order->id) }}">
            @csrf
            <div class="form-group">
                <label for="payment-method">Metode Pembayaran:</label>
                <select id="payment-method" name="payment_method" class="form-control" required>
                    <option value="dana">Dana</option>
                    <option value="ovo">OVO</option>
                    <option value="transfer">Transfer Bank</option>
                </select>
            </div>

            <br>
            <div id="dana-option" class="payment-option" style="display: none;">
                <p>Scan barcode berikut untuk pembayaran melalui Dana:</p>
                <img src="{{ asset('images/frame.png') }}" style="width: 50%;" alt="QR Dana">
            </div>

            <div id="transfer-option" class="payment-option" style="display: none;">
                <p>Silakan transfer ke rekening berikut:</p>
                <p><strong>Bank: Bank ABC</strong></p>
                <p><strong>Nomor Rekening: 123-456-789</strong></p>
            </div>

            <div id="ovo-option" class="payment-option" style="display: none;">
                <p>OVO akan segera tersedia sebagai metode pembayaran.</p>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
        </form>
    </div>
</div>

@endsection



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Event listener untuk perubahan metode pembayaran
        $('#payment-method').on('change', function() {
            // alert('a')
            // Sembunyikan semua opsi pembayaran
            $('.payment-option').hide();

            // Tampilkan opsi sesuai dengan pilihan
            const paymentMethod = $(this).val();
            if (paymentMethod === 'dana') {
                $('#dana-option').show();
            } else if (paymentMethod === 'ovo') {
                $('#ovo-option').show();
            } else if (paymentMethod === 'transfer') {
                $('#transfer-option').show();
            }
        });

        // Tampilkan opsi pembayaran berdasarkan metode default
        $('#payment-method').trigger('change');
    });
</script>

