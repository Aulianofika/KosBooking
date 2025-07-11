@extends('admin.layouts')

@section('page-title', 'Manajemen Data Kos')

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.kos.create') }}" class="btn btn-purple">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kos
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-purple align-middle">
            <thead>
                <tr>
                    <th><i class="bi bi-house-door-fill me-1"></i> Nama</th>
                    <th><i class="bi bi-geo-alt-fill me-1"></i> Alamat</th>
                    <th><i class="bi bi-cash me-1"></i> Harga</th>
                    <th><i class="bi bi-image me-1"></i> Gambar</th>
                    <th class="text-center"><i class="bi bi-gear-fill me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kos as $k)
                <tr>
                    <td>{{ $k->nama_kos }}</td>
                    <td>{{ $k->alamat }}</td>
                    <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if ($k->gambar_utama)
                            <img src="{{ asset('storage/' . $k->gambar_utama) }}"
                                 alt="Gambar Kos"
                                 width="60"
                                 class="img-thumbnail img-bukti"
                                 style="cursor:pointer;"
                                 data-bs-toggle="modal"
                                 data-bs-target="#gambarModal{{ $k->id }}">

                            <!-- Modal Preview -->
                            <div class="modal fade" id="gambarModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0">
                                        <img src="{{ asset('storage/' . $k->gambar_utama) }}"
                                             class="img-fluid rounded"
                                             alt="Preview Gambar Kos">
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('admin.kos.edit', $k->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.kos.destroy', $k->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kos ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.gallery.index', $k->id) }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-images"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data kos 💜</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
