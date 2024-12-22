@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="heading-section">
            <h4><em>Status</em> Pesanan Saya</h4>
        </div>
        <div class="table-responsive">
            <table id="orders-table" class="table" style="color: white;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game</th>
                        <th>ID Game</th>
                        <th>Jumlah Diamond</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->nama_katalog }}</td>
                        <td>{{ $order->game_id }}</td>
                        <td>{{ $order->diamond_amount }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if($order->status === 'Pending')
                                <a href="{{ route('orders.payment', $order->id) }}" class="btn btn-success btn-sm">
                                    Bayar Sekarang
                                </a>

                            @else
                                <span class="text-muted">Tidak Tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk Opsi Pembayaran -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Pilih Metode Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Opsi Pembayaran -->
                <div>
                    <label for="payment-method">Metode Pembayaran:</label>
                    <select id="payment-method" class="form-control">
                        <option value="dana">Dana</option>
                        <option value="ovo">OVO</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                </div>

                <!-- Barcode untuk Dana -->
                <div id="dana-option" class="payment-option" style="display: none;">
                    <p>Scan barcode berikut untuk pembayaran melalui Dana:</p>
                    <img src="https://via.placeholder.com/150x150.png?text=QR+Dana" alt="QR Dana">
                </div>

                <!-- Rekening untuk Transfer -->
                <div id="transfer-option" class="payment-option" style="display: none;">
                    <p>Silakan transfer ke rekening berikut:</p>
                    <p><strong>Bank: Bank ABC</strong></p>
                    <p><strong>Nomor Rekening: 123-456-789</strong></p>
                </div>

                <!-- Placeholder untuk OVO -->
                <div id="ovo-option" class="payment-option" style="display: none;">
                    <p>OVO akan segera tersedia sebagai metode pembayaran.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="confirm-payment">Konfirmasi Pembayaran</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            "order": [[0, "desc"]]
        });
    });

     // Event listener untuk perubahan metode pembayaran
     $('#payment-method').on('change', function() {
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

        // Ketika modal dibuka, reset form dan sembunyikan semua opsi pembayaran
        $('#paymentModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget); // Tombol yang diklik
            const orderId = button.data('order-id');
            const orderAmount = button.data('order-amount');

            // Reset modal dan form
            $('#payment-method').val('dana');
            $('.payment-option').hide();
            $('#dana-option').show();

            // Menangani konfirmasi pembayaran
            $('#confirm-payment').on('click', function() {
                // Logika pembayaran
                alert('Pembayaran untuk Order ID ' + orderId + ' sebesar ' + orderAmount + ' Diamonds telah diproses.');
                $('#paymentModal').modal('hide');
            });
        });
</script>
@endpush
