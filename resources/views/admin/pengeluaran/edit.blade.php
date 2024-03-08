@extends("admin.layouts.app")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Form</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Form Edit Pengeluaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <form action="{{ route('pengeluaran.update', $data->id_pengeluaran) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Edit Data Pengeluaran</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $data->tanggal }}">
                                        @error('tanggal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="uraian" class="col-sm-3 col-form-label">Uraian</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="uraian" id="uraian" value="{{ $data->uraian }}">
                                        @error('uraian')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kode" class="col-sm-3 col-form-label">Kode</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror" value="{{ $data->kode }}" name="kode" id="kode" placeholder="Masukkan kode">
                                        @error('kode')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <select name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                                            <option value="">Pilih Keterangan</option>
                                            <option value="SPJ" {{ $data->keterangan == 'SPJ' ? 'selected' : '' }}>SPJ</option>
                                            <option value="Tidak SPJ" {{ $data->keterangan == 'Tidak SPJ' ? 'selected' : '' }}>Tidak SPJ</option>
                                        </select>
                                        @error('keterangan')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jum_spj" class="col-sm-3 col-form-label">Jumlah SPJ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jum_spj" id="jum_spj" value="0">
                                        @error('jum_spj')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jum_tspj" class="col-sm-3 col-form-label">Jumlah Tidak SPJ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="jum_tspj" id="jum_tspj" value="0">
                                        @error('jum_tspj')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection