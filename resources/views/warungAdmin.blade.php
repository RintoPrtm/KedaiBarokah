@extends('admin.main')

@section('content-admin')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Profile kedai</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $warung->first()->nama_warung }}</li>
        </ol>
        <div class="row">
            <div class=" w-100 col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <button type="button"
                            class="btn btn-primary w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#editWarungModal">
                        Edit Informasi Kedai
                    </button>
                </div>
            </div>
        </div>
        <div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Warung</th>
                            <th>Alamat Warung</th>
                            <th>Deskripsi Warung</th>
                            <th>Foto</th>
                            <th>Flayer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $warung->nama_warung }}.</td>
                            <td>{{ $warung->alamat_warung }}</td>
                            <td>{{ $warung->deskripsi_warung }}</td>
                            <td><img src="{{ asset('style/image/' .$warung->foto_warung) }}"
                                    class="img-thumbnail" width="150"></td>
                            <td><img src="{{ asset('style/image/' .$warung->flayer) }}"
                                    class="img-thumbnail" width="150"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kedai -->
    <div class="modal fade" id="editWarungModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-sm">

            <!-- header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-store-alt me-2"></i>
                    Edit Informasi Kedai
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

                <form action="{{ route('admin.warung.update', $warung->id_warung) }}"
                        method="POST"
                        enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- body -->
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @error('nama_warung') is-invalid @enderror"
                                        id="nama_warung"
                                        name="nama_warung"
                                        placeholder="Nama Warung"
                                        value="{{ old('nama_warung', $warung->nama_warung) }}">
                                    <label for="nama_warung">Nama Warung</label>
                                    @error('nama_warung')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control @error('alamat_warung') is-invalid @enderror"
                                            placeholder="Alamat Warung"
                                            id="alamat_warung"
                                            name="alamat_warung"
                                            style="height: 60px">{{ old('alamat_warung', $warung->alamat_warung) }}</textarea>
                                    <label for="alamat_warung">Alamat Warung</label>
                                    @error('alamat_warung')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control @error('deskripsi_warung') is-invalid @enderror"
                                            placeholder="Deskripsi Warung"
                                            id="deskripsi_warung"
                                            name="deskripsi_warung"
                                            style="height: 100px">{{ old('deskripsi_warung', $warung->deskripsi_warung) }}</textarea>
                                    <label for="deskripsi_warung">Deskripsi Warung</label>
                                    @error('deskripsi_warung')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="foto_warung" class="form-label">Foto Warung</label>
                                <input class="mb-2 form-control form-control-sm @error('foto_warung') is-invalid @enderror"
                                    type="file"
                                    id="foto_warung"
                                    name="foto_warung">
                                @error('foto_warung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($warung->foto_warung)
                                    <small class="text-muted">Current: <img src="{{ asset('style/image/' .$warung->foto_warung) }}"width="80" class="rounded mb-2"></small>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="flayer" class="form-label">Flayer</label>
                                <input class="mb-2 form-control form-control-sm @error('flayer') is-invalid @enderror"
                                    type="file"
                                    id="flayer"
                                    name="flayer">
                                @error('flayer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($warung->flayer)
                                    <small class="text-muted">Current: <img src="{{ asset('style/image/' .$warung->flayer) }}"width="80" class="rounded mb-2"></small>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- footer -->
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->default->any())
                let addModal = document.getElementById('editWarungModal');
                new bootstrap.Modal(addModal).show();
            @endif
        });
    </script>

@endsection