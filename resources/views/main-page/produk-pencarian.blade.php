@extends('layouts.main')

@section('content')

<div class="row">
  <div class="col-lg-8">
    <div class="featured-games header-text">
      <div class="heading-section">
        <h4><em>Product Diamond</em> Awan Store</h4>
      </div>
      <div class="owl-features owl-carousel">
        @foreach ($featuredKatalogs as $katalog)
        <div class="item">
          <div class="thumb">
            <img src="{{ asset($katalog->image) }}" alt="{{ $katalog->nama_katalog }}">
            <div class="hover-effect">
              <h6>{{ $katalog->harga_katalog }}</h6>
            </div>
          </div>
          <h4>
            <a href="{{ route('produk.detail', $katalog->id) }}">
              {{ $katalog->nama_katalog }}<br>
              <span>{{ $katalog->harga_katalog }}</span>
            </a>
          </h4>
          <p>{{ $katalog->deskripsi_katalog }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="top-downloaded">
      <div class="heading-section">
        <h4><em>Top</em> Sell</h4>
      </div>
      <ul>
        @foreach ($topKatalogs as $katalog)
        <li>
          <img src="{{ asset($katalog->image) }}" alt="{{ $katalog->nama_katalog }}" class="templatemo-item">
          <h4>{{ $katalog->nama_katalog }}</h4>
          <h6>{{ $katalog->deskripsi_katalog }}</h6>
          <span><i class="fa fa-money" style="color: green;"></i> {{ $katalog->harga_katalog }}</span>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

@endsection
