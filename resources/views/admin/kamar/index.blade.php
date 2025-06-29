@extends('admin.layouts')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">🛏️ Data Kamar</h2>

    <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary mb-3">➕ Tambah Kamar</a>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Nama Kamar</th>
                <th>Kos</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kamar as $k)
                <tr>
                    <td>{{ $k->nama_kamar }}</td>
                    <td>{{ $k->kos->nama_kos ?? '-' }}</td>
                    <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td>
                        @if ($k->status == 'tersedia')
                            <span class="text-green-600 font-semibold">Tersedia</span>
                        @else
                            <span class="text-red-600 font-semibold">Penuh</span>
                        @endif
                    </td>
                    <td class="space-x-1">
                        <a href="{{ route('admin.kamar.edit', $k->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('admin.kamar.destroy', $k->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus kamar ini?')" class="btn btn-danger btn-sm">🗑 Hapus</button>
                        </form>
                        <a href="{{ route('admin.kamar.galeri.index', $k->id) }}" class="btn btn-secondary btn-sm">🖼 Galeri</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
