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
                        <li class="breadcrumb-item active" aria-current="page">Edit Saldo</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <form action="{{ route('saldo.update', $data->id_saldo) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Edit saldo</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $data->tanggal }}" name="tanggal" id="tanggal" placeholder="Masukkan judul">
                                        @error('tanggal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="saldo" class="col-sm-3 col-form-label">Saldo</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id_saldo" value="{{ $data->id_saldo }}">
                                        <input type="text" class="form-control @error('saldo') is-invalid @enderror" value="{{ $data->saldo }}" name="saldo" id="saldo" placeholder="Masukkan judul">
                                        @error('saldo')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="7" cols="50" name="keterangan" id="keterangan" placeholder="Masukkan keterangan">{{ $data->keterangan }}</textarea>
                                        @error('keterangan')
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