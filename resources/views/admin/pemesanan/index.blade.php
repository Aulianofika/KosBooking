@extends('admin.layouts') 
@section('content')

<style>
    .section-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: #7e57c2; /* Ungu pastel */
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #e1bee7;
        padding-bottom: 10px;
        position: relative;
    }

    .section-title::after {
        content: "💜💌";
        position: absolute;
        right: 10px;
        font-size: 1.2rem;
    }

    .table-purple thead {
        background-color: #ede7f6 !important; /* Ungu muda */
    }

    .table-purple th {
        color: #6a1b9a;
        text-align: center;
    }

    .badge-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .badge-pending {
        background-color: #e0d7f3;
        color: #6a1b9a;
    }

    .badge-diterima {
        background-color: #d0f0e0;
        color: #388e3c;
    }

    .badge-ditolak {
        background-color: #f9d6e2;
        color: #c62828;
    }

    .btn-update {
        background-color: #ba68c8;
        color: white;
        border: none;
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 8px;
    }

    .btn-update:hover {
        background-color: #9c27b0;
    }

    .form-select-sm {
        border-color: #e1bee7;
    }

    .img-bukti {
        border: 2px solid #d1c4e9;
        border-radius: 6px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #faf7fc;
    }
</style>

<div class="container mt-4">
    <h2 class="section-title">Manajemen Pemesanan Kos</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-purple align-middle">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Kos / Kamar</th>
                    <th>Tanggal</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $b)
                <tr>
                    <td>
                        <strong>{{ $b->user->name ?? 'User dihapus' }}</strong><br>
                        <small class="text-muted">{{ $b->user->email ?? '-' }}</small>
                    </td>
                    <td>
                        <strong>{{ $b->kos->nama_kos ?? '-' }}</strong><br>
                        <small class="text-muted">{{ $b->kamar->nama_kamar ?? '-' }}</small>
                    </td>
                    <td>{{ $b->tanggal_mulai }}</td>
                    <td class="text-center">
                        @if($b->bukti_transaksi)
                            <a href="{{ asset('storage/' . $b->bukti_transaksi) }}" target="_blank">
                                <img src="{{ asset('storage/' . $b->bukti_transaksi) }}" class="img-thumbnail img-bukti" width="70">
                            </a>
                        @else
                            <span class="text-muted">Belum ada</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge-status
                            {{ $b->status === 'pending' ? 'badge-pending' :
                               ($b->status === 'diterima' ? 'badge-diterima' : 'badge-ditolak') }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.pemesanan.updateStatus', $b->id) }}" method="POST" class="d-flex gap-1">
                            @csrf
                            <select name="status" class="form-select form-select-sm">
                                <option value="pending" {{ $b->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diterima" {{ $b->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $b->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="btn btn-update">Update</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data pemesanan 💌</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $bookings->links() }}
</div>

{{-- Info jumlah data --}}
<div class="text-center text-muted small mt-2">
    Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari total {{ $bookings->total() }} pemesanan
</div>
</div>
@endsection 
