@extends('admin.layouts')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">🏘️ Data Kos</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kos.create') }}" class="btn btn-primary mb-3">➕ Tambah Kos</a>

    <table class="table table-bordered table-striped bg-white rounded-xl overflow-hidden">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kos as $k)
                <tr>
                    <td>{{ $k->nama_kos }}</td>
                    <td>{{ $k->alamat }}</td>
                    <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td>
                        @if ($k->gambar_utama)
                            <img src="{{ asset('storage/' . $k->gambar_utama) }}" alt="Gambar Kos" width="60"
                                data-bs-toggle="modal" data-bs-target="#gambarModal{{ $k->id }}" style="cursor:pointer;">
                            
                            <!-- Modal -->
                            <div class="modal fade" id="gambarModal{{ $k->id }}" tabindex="-1" aria-labelledby="gambarModalLabel{{ $k->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/' . $k->gambar_utama) }}" alt="Gambar Kos" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="space-x-1">
                        <a href="{{ route('admin.kos.edit', $k->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.kos.destroy', $k->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kos ini?')">🗑 Hapus</button>
                        </form>
                        <a href="{{ route('admin.gallery.index', $k->id) }}" class="btn btn-secondary btn-sm">🖼 Galeri</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
