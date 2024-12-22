@extends('layouts.main')

@section('content')

    <!-- ***** Banner Start ***** -->
    <div class="main-banner">
        <div class="row">
            <div class="col-lg-7">
                <div class="header-text">
                    <h6>Selamat Data {{ Auth()->user()->name }}, di Awan Store</h6>
                    <h4><em>TOP UP Diamond</em> Paling Terpercaya</h4>
                    <div class="main-button">
                        <a href="{{ route('produk') }}">Cari Kebutuhan Anda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="most-popular">

        <div class="row">
            <div class="col">
                <div id="opsi">
                    <h5>Cari Diamond untuk Game Apa?</h5>
                <p>Pilih kategori game untuk mencari diamond:</p>
                <button id="mobileCategory" class="btn btn-primary">Mobile</button>
                <button id="pcCategory" class="btn btn-primary">PC</button>
                {{-- <button id="skipCategory" class="btn btn-secondary">Lewati</button> --}}
            </div>
        </div>
        </div>
    </div>
    <!-- Opsi untuk memilih kategori game -->


    <!-- ***** Banner End ***** -->

    <!-- ***** Most Popular Start ***** -->
    <div class="most-popular">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section">
                    <h4><em>Most Popular</em> Right Now</h4>
                </div>
                <div class="row">
                    @foreach ($katalogs as $katalog)
                        <div class="col-lg-3 col-sm-6">
                            <div class="item">
                                <img src="{{ asset($katalog->image) }}" alt="{{ $katalog->nama_katalog }}">
                                <h4>{{ $katalog->nama_katalog }}<br><span>{{ $katalog->deskripsi_katalog }}</span></h4>
                                <ul>
                                    <li><i class="fa fa-star"></i> {{ $katalog->rating ?? '4.8' }}</li>
                                    <li><i class="fa fa-download"></i> {{ $katalog->downloads ?? '2.3M' }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="main-button">
                            <a href="{{ route('produk') }}">Lihat Lebih Banyak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Most Popular End ***** -->

    <!-- ***** Gaming Library Start ***** -->
    <div class="gaming-library">
        <div class="col-lg-12">
            <div class="heading-section">
                <h4><em>Riwayat</em> Pembelian</h4>
            </div>

            @foreach($orders as $order)
                <div class="item">
                    <ul>
                        <li><img src="{{ asset($order->image) }}" alt="" class="templatemo-item"></li>
                        <li><h4>{{ $order->nama_katalog }}</h4><span>Game</span></li>
                        <li><h4>Date Purchased</h4><span>{{ $order->order_date->format('d/m/Y') }}</span></li>
                        <li><h4>Diamonds Purchased</h4><span>{{ $order->diamond_amount }}</span></li>
                        <li><h4>Status</h4><span>{{ $order->status }}</span></li>
                    </ul>
                </div>
            @endforeach

            <div class="col-lg-12">
                <div class="main-button">
                    <a href="{{ route('pesanan.index') }}">Lihat Lebih Banyak</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Gaming Library End ***** -->

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


<!-- Script -->
<script>
    $(document).ready(function(){
        $('#mobileCategory').on('click', function(){
            window.location.href = '{{ route('produk.search', ['category' => 'mobile']) }}';
        });

    });

</script>

