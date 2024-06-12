@extends("layouts.apps")
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
                        <li class="breadcrumb-item active" aria-current="page">Form Edit Pengajuan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <form action="{{ route('pengajuan.update', $data->id_pengajuan) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <a href="{{ route('pengajuan.index') }}" class="btn btn-sm"><i class="bx bx-arrow-back"></i>Kembali</a><br><br>
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Edit Data Pengajuan</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="kategori_id" class="col-sm-3 col-form-label">Seksi</label>
                                    <div class="col-sm-9">
                                        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                            <option value="">- Pilih -</option>
                                            @forelse($kategori as $item)
                                            <option value="{{ $item->id_kategori }}" {{ $data->kategori_id == $item->id_kategori ? 'selected' : '' }}>{{ $item->keterangan }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('kategori_id')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="uraian" class="col-sm-3 col-form-label">Uraian</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('uraian') is-invalid @enderror" name="uraian" id="uraian" value="{{ $data->uraian }}">
                                        @error('uraian')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah_biaya" class="col-sm-3 col-form-label">Jumlah biaya</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('jumlah_biaya') is-invalid @enderror" value="{{ $data->jumlah_biaya }}" name="jumlah_biaya" id="jumlah_biaya">
                                        @error('jumlah_biaya')
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