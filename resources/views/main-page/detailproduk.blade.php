@extends('layouts.main')

@section('content')
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

          <div class="game-details">
            <div class="row">
              <div class="col-lg-12">
                <h3 style="text-align: center;">Diamond Game {{ $produk->nama_katalog }}</h3>
              </div>
              <br><br><br>
              <div class="col-lg-12">
                <div class="content">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="left-info">
                        <input type="text" name="harga_dm" id="harga_dm" value={{ $produk->harga_katalog }} hidden>

                        <h4>Fortnite Diamond Top-Up</h4>
                        <p>Silakan pilih jumlah diamond yang ingin Anda beli:</p>
                        <table class="table" style="color: white;">
                          <thead>
                            <tr>
                              <th>Jumlah Diamond</th>
                              <th>Harga (IDR)</th>
                            </tr>
                          </thead>
                          <tbody id="diamond-pricing">
                            <!-- Dynamic rows populated by JavaScript -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="right-info">
                        <h4>Tambah ke Keranjang</h4>
                        <form id="cart-form" action="{{ route('submit.order') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="katalog_id" id="katalog_id" value="{{ $id  }}" hidden>
                              <label for="diamond-amount">Pilih Jumlah Diamond:</label>
                              <select id="diamond-amount" name="diamond_amount" class="form-control">
                                <!-- Options populated by JavaScript -->
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="game-id">ID Game:</label>
                              <input type="text" id="game-id" name="game_id" class="form-control" placeholder="Masukkan ID Game">
                            </div>
                            <div class="form-group">
                              <label for="order-date">Tanggal:</label>
                              <input type="date" id="order-date" name="order_date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <br>
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                            </div>
                          </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Daftar jumlah diamond
  const diamondAmounts = [10, 20, 50, 100, 200];

  // Ambil elemen yang diperlukan
  const hargaInput = document.getElementById("harga_dm");
  const diamondPricingTable = document.getElementById("diamond-pricing");
  const diamondAmountSelect = document.getElementById("diamond-amount");
  const totalPriceDisplay = document.getElementById("total-price");

  // Fungsi untuk memperbarui tabel dan dropdown
  const updatePricing = () => {
    const hargaPerDm = parseFloat(hargaInput.value); // Harga per diamond
    if (isNaN(hargaPerDm) || hargaPerDm <= 0) {
      diamondPricingTable.innerHTML = "<tr><td colspan='2'>Invalid price</td></tr>";
      diamondAmountSelect.innerHTML = `<option value="">Invalid price</option>`;
      totalPriceDisplay.textContent = "0";
      return;
    }

    // Kosongkan tabel dan dropdown
    diamondPricingTable.innerHTML = "";
    diamondAmountSelect.innerHTML = "";

    // Perbarui tabel dan dropdown
    diamondAmounts.forEach((amount) => {
      const totalPrice = hargaPerDm * amount;

      // Tambahkan ke tabel
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${amount} Diamond</td>
        <td>Rp ${totalPrice.toLocaleString()}</td>
      `;
      diamondPricingTable.appendChild(row);

      // Tambahkan ke dropdown
      const option = document.createElement("option");
      option.value = totalPrice;
      option.text = `${amount} Diamond - Rp ${totalPrice.toLocaleString()}`;
      diamondAmountSelect.appendChild(option);
    });
  };

  // Event listener untuk input harga
  hargaInput.addEventListener("input", updatePricing);

  // Event listener untuk dropdown jumlah diamond
  diamondAmountSelect.addEventListener("change", (e) => {
    totalPriceDisplay.textContent = `Rp ${parseFloat(e.target.value).toLocaleString()}`;
  });

  // Inisialisasi awal
  updatePricing();
});

  // Tambahkan ke keranjang
  function addToCart() {
    const diamondAmount = parseInt(document.getElementById("diamond-amount").value);
    const quantity = parseInt(document.getElementById("quantity").value);

    if (quantity < 1) {
      alert("Jumlah paket minimal adalah 1.");
      return;
    }

    const selectedDiamond = diamondPrices.find((item) => item.amount === diamondAmount);
    const totalPrice = selectedDiamond.price * quantity;

    alert(`Berhasil menambahkan ${quantity} paket (${diamondAmount * quantity} Diamond) ke keranjang. Total Harga: Rp ${totalPrice.toLocaleString()}`);
  }

document.getElementById("cart-form").addEventListener("submit", function (e) {
  const gameId = document.getElementById("game-id").value;
  const diamondAmount = document.getElementById("diamond-amount").value;

  if (!gameId || !diamondAmount) {
    e.preventDefault();
    alert("Harap lengkapi semua data sebelum menambahkan ke keranjang.");
  }
});

</script>
@endsection
