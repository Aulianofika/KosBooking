@extends('admin.layouts')

@section('page-title', 'Manajemen Pemesanan')

@section('content')
<div class="container">
    <h2 class="section-title"></h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-purple align-middle">
            <thead>
                <tr>
                    <th><i class="bi bi-person-fill me-1"></i> User</th>
                    <th><i class="bi bi-house-fill me-1"></i> Kos / Kamar</th>
                    <th><i class="bi bi-calendar-event me-1"></i> Tanggal</th>
                    <th><i class="bi bi-receipt me-1"></i> Bukti</th>
                    <th><i class="bi bi-patch-check me-1"></i> Status</th>
                    <th class="text-center"><i class="bi bi-sliders me-1"></i> Aksi</th>
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
                                <img src="{{ asset('storage/' . $b->bukti_transaksi) }}"
                                     class="img-thumbnail img-bukti"
                                     width="70"
                                     alt="Bukti">
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
