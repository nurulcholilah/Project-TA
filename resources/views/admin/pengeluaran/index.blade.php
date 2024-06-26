@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pengeluaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0 float-end">
                    <i class="bx bxs-plus-square"></i>Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Seksi</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }} </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $item->kategori ? $item->kategori->keterangan : 'Kategori tidak ditemukan' }}</td>
                                <td>@currency($item->jumlah)</td>
                                <td class="text-center">
                                    <form class="form-delete" action="{{ route('pengeluaran.destroy', $item->id_pengeluaran) }}" method="POST">
                                        <a href="{{ route('pengeluaran.show', $item->id_pengeluaran) }}" class="btn btn-sm" style="background-color: #7E8EF1; border-color: #7E8EF1;"><i class="bx bx-show" style="color: white;"></i></a>
                                        <a href="{{ route('pengeluaran.edit', $item->id_pengeluaran) }}" class="btn btn-sm btn-primary"><i class="bx bxs-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bx bxs-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Seksi</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection