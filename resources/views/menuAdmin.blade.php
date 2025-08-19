@extends('admin.main')

@section('content-admin')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Menu</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $warung->first()->nama_warung }}</li>
        </ol>
        <div class="row">
            <div class=" w-100 col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <button class="btn btn-primary w-100"
                    data-bs-toggle="modal" data-bs-target="#addMenuModal">
                        + Tambah Menu
                    </button>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Menu
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Harga</th>
                            <th>Promo</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu as $item)
                        <tr>
                            <td>{{ $item->id_menu }}.</td>
                            <td>{{ $item->nama_menu }}</td>
                            <td>{{ $item->harga }}</td>
                            <td><span class="badge bg-success">{{ $item->promo }}</span></td>
                            <td>{{ $item->deskripsi_menu }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            @php
                                $flayerPath = asset('style/image/'.$warung->flayer);
                            @endphp
                            <td><img src="{{ $item->foto_menu ? asset('style/image/' .$item->foto_menu) : $flayerPath }}"
                                    class="img-thumbnail" width="80">
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Button Edit -->
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editMenuModal{{ $item->id_menu }}">
                                        Edit
                                    </button>
                                    <!-- Button Hapus -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#HapusMenuModal{{ $item->id_menu }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editMenuModal{{ $item->id_menu }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.menu.update', $item->id_menu) }}"
                                    method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Menu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Nama Menu -->
                                            <div class="mb-3">
                                                <label>Nama Menu</label>
                                                <input type="text"
                                                    name="nama_menu"
                                                    value="{{ old('nama_menu', $item->nama_menu) }}"
                                                    class="form-control @error('nama_menu', 'edit') is-invalid @enderror">
                                                @error('nama_menu', 'edit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Kategori -->
                                            <div class="mb-3">
                                                <label>Kategori</label>
                                                <select name="id_kategori"
                                                        class="form-select @error('id_kategori', 'edit') is-invalid @enderror">
                                                    @foreach($kategori as $k)
                                                        <option value="{{ $k->id_kategori }}"
                                                            {{ old('id_kategori', $item->id_kategori)==$k->id_kategori?'selected':'' }}>
                                                            {{ $k->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_kategori', 'edit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Harga -->
                                            <div class="mb-3">
                                                <label>Harga</label>
                                                <input type="number"
                                                    name="harga"
                                                    value="{{ old('harga', $item->harga) }}"
                                                    class="form-control @error('harga', 'edit') is-invalid @enderror">
                                                @error('harga', 'edit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Harga Promo -->
                                            <div class="mb-3">
                                                <label>Harga Promo (Rp)</label>
                                                <input type="number"
                                                    name="promo"
                                                    value="{{ old('promo', $item->promo) }}"
                                                    class="form-control @error('promo', 'edit') is-invalid @enderror">
                                                @error('promo', 'edit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Kosongkan jika tidak ada promo</small>
                                            </div>

                                            <!-- Deskripsi -->
                                            <div class="form-group mb-3">
                                                <label for="deskripsi_menu">Deskripsi</label>
                                                <textarea name="deskripsi_menu"
                                                    class="form-control @error('deskripsi_menu', 'edit') is-invalid @enderror"
                                                    rows="3">{{ old('deskripsi_menu', $item->deskripsi_menu) }}</textarea>

                                                @error('deskripsi_menu', 'edit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Foto Menu -->
                                            <div class="mb-3">
                                                <label>Foto Menu</label><br>
                                                @if($item->foto_menu)
                                                    <img src="{{ asset('style/image/' .$item->foto_menu) }}"
                                                        width="80" class="rounded mb-2">
                                                @endif
                                                <input type="file"
                                                    name="foto_menu"
                                                    class="form-control @error('foto_menu', 'edit') is-invalid @enderror"
                                                    accept="image/*">
                                                @error('foto_menu', 'edit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                            <!-- Modal Hapus Menu -->
                            <div class="modal fade" id="HapusMenuModal{{ $item->id_menu }}" tabindex="-1" aria-labelledby="HapusKategoriModal{{ $item->id_kategori }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.menu.destroy', $item->id_menu) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="fs-4 fw-bolder modal-title" id="HapusMenuModal{{ $item->id_menu }}">
                                                    <span class="text-danger">!!!</span>
                                                    HAPUS MENU
                                                    <span class="text-danger">!!!</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Yakin ingin menghapus <span class="fw-bolder text-decoration-underline">{{ $item->nama_menu }}?</span>
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
    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text"
                                    name="nama_menu"
                                    class="form-control @error('nama_menu') is-invalid @enderror"
                                    value="{{ old('nama_menu') }}" required>
                            @error('nama_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="id_kategori"
                                    class="form-select @error('id_kategori') is-invalid @enderror"
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number"
                                    name="harga"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ old('harga') }}" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Promo (Rp)</label>
                            <input type="number"
                                name="promo"
                                class="form-control @error('promo') is-invalid @enderror"
                                value="{{ old('promo') }}">
                            @error('promo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika tidak ada promo</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text"
                                    name="deskripsi_menu"
                                    class="form-control @error('deskripsi_menu') is-invalid @enderror">
                            @error('deskripsi_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Menu</label>
                            <input type="file"
                                name="foto_menu"
                                class="form-control @error('foto_menu') is-invalid @enderror"
                                accept="image/*">
                            @error('foto_menu')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1) Jika named‐bag "edit" punya error, buka modal edit dengan ID yang kita flash
        @if ($errors->hasBag('edit'))
            let id = "{{ session('editMenuId') }}";
            let editModal = document.getElementById('editMenuModal' + id);
            new bootstrap.Modal(editModal).show();

      // 2) Jika default bag punya error (add), buka modal tambah
        @elseif ($errors->default->any())
            let addModal = document.getElementById('addMenuModal');
            new bootstrap.Modal(addModal).show();
        @endif
    });

</script>
@endsection

