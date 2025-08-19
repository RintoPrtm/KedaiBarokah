@extends('admin.main')

@section('content-admin')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $warung->first()->nama_warung }}</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Pesanan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Nomer Telpon</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $item)
                        <tr>
                            <td>{{ $item->id_pesanan }}.</td>
                            <td>{{ $item->users->username }}</td>
                            <td>{{ $item->users->telp_user }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->jam_pesanan)->format('H:i') }}</td>
                            <td><span class="badge {{ $item->status=='Diproses' ? 'bg-danger' : 
                                    ($item->status=='Selesai' ? 'bg-success' : ($item->status=='Sudah Siap' ? 'bg-warning' : 'bg-secondary')) }}">{{ $item->status }}</span></td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $item->id_pesanan }}">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($pesanan as $item)
                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail{{ $item->id_pesanan }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">Detail Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama Pelanggan:</strong> {{ $item->users->username }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y') }}</p>
                                <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($item->jam_pesanan)->format('H:i') }}</p>
                                <p><strong>Status:</strong> 
                                <span class="badge {{ $item->status=='Diproses' ? 'bg-danger' : 
                                    ($item->status=='Selesai' ? 'bg-success' : ($item->status=='Sudah Siap' ? 'bg-warning' : 'bg-secondary')) }}">{{ ucfirst($item->status) }}</span></p>
                                <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Promo</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item->detail as $d)
                                    <tr>
                                        <td>{{ $d->menu->nama_menu }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>Rp {{ number_format($d->menu->harga) }}</td>
                                        <td>
                                            @if($d->menu->promo && $d->menu->promo > 0)
                                                <span class="badge bg-success">
                                                    Rp {{ number_format($d->menu->promo, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>Rp {{number_format($d->jumlah * $d->menu->effective_price,0, ',', '.')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                @php
                                  $total = $item->detail->sum(fn($d) => $d->jumlah * $d->menu->effective_price);
                                @endphp
                                <h5 class="text-end">Total Harga: Rp {{ number_format($total) }}</h5>

                                <form action="{{ route('admin.pesanan.updateStatus', $item->id_pesanan) }}"
                                        method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($item->status === 'Selesai')
                                    <div class="d-flex justify-content-end mt-3">
                                            <a href="{{ route('invoice.generate', $item->id_pesanan) }}"
                                                    target="_blank"
                                                    class="btn btn-primary">
                                                <i class="bi bi-file-earmark-pdf"></i> Cetak Invoice
                                            </a>
                                        </div>
                                    @else
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Ubah Status Pesanan</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="Sudah Siap">Sudah Siap</option>
                                                    <option value="Selesai">Selesai</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-end">
                                                <button type="submit" class="btn btn-success ms-auto">Ubah Status</button>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection