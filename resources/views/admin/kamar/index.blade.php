@extends('admin.layouts')

@section('page-title', 'Manajemen Data Kamar')

@section('content')
<div class="container">

  <div class="mb-3 text-end">
    <a href="{{ route('admin.kamar.create') }}" class="btn btn-purple">
      <i class="bi bi-plus-circle me-1"></i> Tambah Kamar
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-purple align-middle">
      <thead>
        <tr>
          <th><i class="bi bi-door-open-fill me-1"></i> Nama Kamar</th>
          <th><i class="bi bi-house-heart-fill me-1"></i> Kos</th>
          <th><i class="bi bi-cash-stack me-1"></i> Harga</th>
          <th><i class="bi bi-info-circle-fill me-1"></i> Status</th>
          <th class="text-center"><i class="bi bi-gear-fill me-1"></i> Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($kamar as $k)
        <tr>
          <td>{{ $k->nama_kamar }}</td>
          <td>{{ $k->kos->nama_kos ?? '-' }}</td>
          <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
          <td class="text-center">
            <span class="badge-status {{ $k->status === 'tersedia' ? 'badge-tersedia' : 'badge-penuh' }}">
              <i class="bi {{ $k->status === 'tersedia' ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
              {{ ucfirst($k->status) }}
            </span>
          </td>
          <td class="text-center">
            <a href="{{ route('admin.kamar.edit', $k->id) }}" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil-square"></i>
            </a>
            <form action="{{ route('admin.kamar.destroy', $k->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Yakin hapus kamar ini?')" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
              </button>
            </form>
            <a href="{{ route('admin.kamar.galeri.index', $k->id) }}" class="btn btn-secondary btn-sm">
              <i class="bi bi-images"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
