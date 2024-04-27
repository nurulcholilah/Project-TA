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
                        <li class="breadcrumb-item active" aria-current="page">Input Saldo</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <form action="{{ route('saldo.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Masukkan Saldo</h5>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="result form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="date" placeholder="Masukkan tanggal">
                                        @error('tanggal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="saldo_awal" class="col-sm-3 col-form-label">Saldo Awal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('saldo_awal') is-invalid @enderror" name="saldo_awal" id="saldo_awal" placeholder="Masukkan saldo awal">
                                        @error('saldo_awal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="saldo" class="col-sm-3 col-form-label">Saldo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('saldo') is-invalid @enderror" name="saldo" id="saldo" placeholder="Masukkan saldo">
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
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" cols="20" name="keterangan" id="keterangan" placeholder="Masukkan keterangan"></textarea>
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