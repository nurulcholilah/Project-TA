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
                        <li class="breadcrumb-item active" aria-current="page">Data Kategori</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            @if(auth()->user()->hasRole('admin'))
            <div class="card-header">
                <a href="{{ route('kategori.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0 float-end">
                    <i class="bx bxs-plus-square"></i>Tambah</a>
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                @if(auth()->user()->hasRole('admin'))
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }} </td>
                                <td>{{ $item->kode }} </td>
                                <td>{{ $item->keterangan }}</td>
                                <td>@currency($item->jumlah)</td>
                                @if(auth()->user()->hasRole('admin'))
                                <td class="text-center">
                                    <form class="form-delete" action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST">
                                        <a href="{{ route('kategori.edit', $item->id_kategori) }}" class="btn btn-sm btn-primary"><i class="bx bxs-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bx bxs-trash"></i></button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                @if(auth()->user()->hasRole('admin'))
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection