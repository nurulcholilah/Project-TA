@extends("admin.layouts.app")
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
                        <li class="breadcrumb-item active" aria-current="page">Data Saldo</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-header">
                @if ($data->isEmpty())
                <a href="{{ route('saldo.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0 float-end">
                    <i class="bx bxs-plus-square"></i>Input Saldo</a>
                @else
                <a href="{{ route('saldo.edit', $data[0]->id_saldo) }}" class="btn btn-primary radius-30 mt-2 mt-lg-0 float-end">
                    <i class="bx bxs-edit"></i>Edit Saldo</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Saldo</th>
                                <th>Keterangan</th>
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
                                <td>{{ $item->tanggal }} </td>
                                <td>@currency($item->saldo) </td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('saldo.destroy', $item->id_saldo) }}" method="POST">
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
                                <th>Saldo</th>
                                <th>Keterangan</th>
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