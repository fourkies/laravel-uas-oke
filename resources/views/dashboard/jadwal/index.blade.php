@extends('dashboard.layout')

@section('konten')
    <p class="card-title">Jadwal</p>
    <div class="pb-3"><a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a></div>
    <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th class="col-1">No</th>
                    <th>Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    {{-- <th>Jam Akhir</th> --}}
                    <th>Tanggal Mulai</th>
                    <th class="col-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->info1 }}</td>
                        <td>{{ $item->info2 }}</td>
                        <td>{{ $item->info3 }}</td>
                        <td>{{ $item->tgl_mulai_indo }}</td>
                        {{-- <td>{{ $item->tgl_akhir_indo }}</td> --}}
                        <td>
                            <a href='{{ route('jadwal.edit', $item->id) }}' class="btn btn-sm btn-warning">Edit</a>
                            <form onsubmit="return confirm('Yakin mau hapus data ini?')
                            "
                                action="{{ route('jadwal.destroy', $item->id) }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" name='submit'>Delete</button>
                            </form>
                        </td>
                        <?php $i++; ?>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection
