@extends('admin.main')

@section('content-admin')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kategori Menu</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $warung->first()->nama_warung }}</li>
        </ol>
        <div class="row">
            <div class=" w-100 col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <form class="CreateKategori" action="" method="POST">
                        @csrf
                        <button type="button" class="btn btn-primary w-100"
                                data-bs-toggle="modal" data-bs-target="#TambahKategoriModal">
                            + Tambah Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Kategori Menu
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Button Edit -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $item->id_kategori }}">
                                            Edit
                                        </button>
                                        <!-- Button Hapus -->
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#HapusKategoriModal{{ $item->id_kategori }}">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Kategori -->
                            <div class="modal fade" id="editKategoriModal{{ $item->id_kategori }}" tabindex="-1" aria-labelledby="editKategoriLabel{{ $item->id_kategori }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.kategori.update', $item->id_kategori) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="editKategoriLabel{{ $item->id_kategori }}">
                                                Edit Kategori {{ $item->nama_kategori }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_kategori_{{ $item->id_kategori }}" class="form-label">
                                                        Nama Kategori
                                                    </label>
                                                    <input
                                                        type="text"
                                                        name="nama_kategori"
                                                        id="nama_kategori_{{ $item->id_kategori }}"
                                                        class="form-control @error('nama_kategori','edit') is-invalid @enderror"
                                                        placeholder="Masukkan Nama Kategori">
                                                        @error('nama_kategori','edit')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Hapus Kategori -->
                            <div class="modal fade" id="HapusKategoriModal{{ $item->id_kategori }}" tabindex="-1" aria-labelledby="HapusKategoriModal{{ $item->id_kategori }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.kategori.destroy', $item->id_kategori) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="fs-4 fw-bolder modal-title" id="HapusKategoriModal{{ $item->id_kategori }}">
                                                    <span class="text-danger">!!!</span>
                                                    HAPUS KATEGORI
                                                    <span class="text-danger">!!!</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_kategori_{{ $item->id_kategori }}" class="form-label">
                                                        Semua menu yang ada di <span class="fw-bolder text-decoration-underline">{{ $item->nama_kategori }}</span> akan dihapus. 
                                                        yakin ingin menghapus kategori ini?
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="TambahKategoriModal" tabindex="-1" role="dialog" aria-labelledby="TambahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahKategoriModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input 
                            type="text"
                            name="nama_kategori"
                            id="nama_kategori_{{ $item->id_kategori ?? 'new' }}"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            placeholder="Masukkan Nama Kategori">
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1) Jika named‐bag "edit" punya error, buka modal edit dengan ID yang kita flash
        @if ($errors->hasBag('edit'))
            let id = "{{ session('editKategoriId') }}";
            let editModal = document.getElementById('editKategoriModal' + id);
            new bootstrap.Modal(editModal).show();

      // 2) Jika default bag punya error (add), buka modal tambah
        @elseif ($errors->default->has('nama_kategori'))
            let addModal = document.getElementById('TambahKategoriModal');
            new bootstrap.Modal(addModal).show();
        @endif
    });
</script>



@endsection