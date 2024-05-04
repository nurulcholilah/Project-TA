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
                        <li class="breadcrumb-item active" aria-current="page">Data Pengajuan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            @role('pegawai')
            <div class="card-header">
                <a href="{{ route('pengajuan.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0 float-end">
                    <i class="bx bxs-plus-square"></i>Tambah</a>
            </div>
            @endrole
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Uraian</th>
                                <th>Jumlah</th>
                                @role('pegawai')
                                <th>Aksi</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }} </td>
                                @role('pegawai')
                                <td>
                                    @if($item->status == 'pending')
                                    <span class="badge bg-light-warning text-warning w-100">Menunggu</span>
                                    @elseif($item->status == 'approved')
                                    <span class="badge bg-light-success text-success w-100">Diterima</span>
                                    @elseif($item->status == 'rejected')
                                    <span class="badge bg-light-danger text-danger w-100">Ditolak</span>
                                    @endif
                                </td>
                                @endrole
                                @role('admin')
                                <td class="text-center">
                                    @if($item->status == 'pending')
                                    <form id="approve-form-{{ $item->id_pengajuan }}" action="{{ route('pengajuan.approve', $item->id_pengajuan) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda yakin untuk menerima pengajuan ini?')">Terima</button>
                                    </form>
                                    <form id="reject-form-{{ $item->id_pengajuan }}" action="{{ route('pengajuan.reject', $item->id_pengajuan) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin untuk menolak pengajuan ini?')">Tolak</button>
                                    </form>
                                    @else
                                    @if($item->status == 'approved')
                                    <span class="badge bg-light-success text-success w-100">Diterima</span>
                                    @elseif($item->status == 'rejected')
                                    <span class="badge bg-light-danger text-danger w-100">Ditolak</span>
                                    @endif
                                    @endif
                                </td>
                                @endrole
                                <td>{{ $item->kategori ? $item->kategori->keterangan : 'Kategori tidak ditemukan' }}</td>
                                <td>{{ $item->uraian }}</td>
                                <td>@currency($item->jumlah_biaya)</td>
                                @role('pegawai')
                                <td class="text-center">
                                    @if($item->status == 'pending')
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pengajuan.destroy', $item->id_pengajuan) }}" method="POST">
                                        <a href="{{ route('pengajuan.edit', $item->id_pengajuan) }}" class="btn btn-sm btn-primary"><i class="bx bxs-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bx bxs-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Uraian</th>
                                <th>Jumlah</th>
                                @role('pegawai')
                                <th>Aksi</th>
                                @endrole
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection