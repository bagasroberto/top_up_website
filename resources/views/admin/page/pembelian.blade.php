@extends('admin.layouts.main')
@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Data Pembelian User</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="#">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Form</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Data Pembelian</a>
          </li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Pembelian User</h4>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Katalog</th>
                            <th>User</th>
                            <th>ID Game</th>
                            <th>Email User</th>
                            <th>Pembelian Diamond</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $katalog)
                            <tr>
                                <td>Game {{ $katalog->nama_katalog }}</td>
                                <td>{{ $katalog->name }}</td>
                                <td>{{ $katalog->game_id }}</td>
                                <td>{{ $katalog->email }}</td>
                                <td>{{ ($katalog->diamond_amount)/($katalog->harga_katalog) }} Diamond</td>
                                <td>{{ $katalog->order_date }}</td>
                                <td>{{ $katalog->status }}</td>
                                <td>
                                    @if ($katalog->status == 'Pending')
                                        <!-- Form untuk mengubah status menjadi 'Completed' -->
                                        <form action="{{ route('pesanan.update', $katalog->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') <!-- Menggunakan metode PUT untuk pembaruan data -->
                                            <button type="submit" class="btn btn-sm btn-success">Proses Pesanan</button>
                                        </form>
                                    @else
                                        <!-- Menampilkan tombol jika sudah selesai -->
                                        <button type="button" class="btn btn-sm btn-primary">Selesai</button>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">Tambah</span>
                            <span class="fw-light">Katalog</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddKatalog" method="POST" action="{{ route('katalog.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama Katalog</label>
                                <input type="text" name="nama_katalog" class="form-control" placeholder="Masukkan nama katalog" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Katalog</label>
                                <input type="text" name="harga_katalog" class="form-control" placeholder="Masukkan harga katalog" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Katalog</label>
                                <textarea name="deskripsi_katalog" class="form-control" placeholder="Masukkan deskripsi katalog" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" form="formAddKatalog" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Edit Katalog</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editId" name="id">
                            <div class="form-group">
                                <label>Nama Katalog</label>
                                <input type="text" id="editNama" name="nama_katalog" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Katalog</label>
                                <input type="text" id="editHarga" name="harga_katalog" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Katalog</label>
                                <textarea id="editDeskripsi" name="deskripsi_katalog" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar Katalog</label>
                                <div>
                                    <img id="editImagePreview" src="" alt="Gambar Katalog" width="100">
                                </div>
                                <input type="file" id="editImage" name="image" class="form-control mt-2">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




      </div>
    </div>
  </div>



@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function () {
    $(document).ready(function () {
    $("#basic-datatables").DataTable({
        pageLength: 10,
        columnDefs: [
            {
                targets: [3], // Kolom untuk gambar
                orderable: false,
            },
            {
                targets: [4], // Kolom untuk aksi
                orderable: false,
            },
        ],
    });
});

$(document).on('click', '.btn-edit', function () {
    let id = $(this).data('id');
    let nama = $(this).data('nama');
    let harga = $(this).data('harga');
    let deskripsi = $(this).data('deskripsi');
    let image = $(this).data('image');

    // Isi data di modal
    $('#editId').val(id);
    $('#editNama').val(nama);
    $('#editHarga').val(harga);
    $('#editDeskripsi').val(deskripsi);
    $('#editImagePreview').attr('src', image);

    // Update form action URL
    $('#editForm').attr('action', '/katalog/update/' + id);
});


  });
</script>
