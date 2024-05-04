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
                                    <label for="file" class="col-sm-3 col-form-label">Nota</label>
                                    <div class="col-sm-9">
                                        <img src="{{ url('assets/images/file/' . $data->file) }}" alt="{{ $data->file }}" height="150" class="mb-3">
                                        <input type="file" class="form-control" name="file" id="file" value="{{ $data->file }}">
                                        @error('file')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="result form-control" name="tanggal" id="date" value="{{ $data->tanggal }}" placeholder="Masukkan tanggal">
                                        @error('tanggal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kode_akun" class="col-sm-3 col-form-label">Kode Akun</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kode_akun" id="kode_akun" value="{{ $data->kode_akun }}">
                                        @error('kode_akun')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kategori_id" class="col-sm-3 col-form-label">Kategori</label>
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
                                    <label for="penerima" class="col-sm-3 col-form-label">Penerima</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('penerima') is-invalid @enderror" name="penerima" id="penerima" value="{{ $data->penerima }}">
                                        @error('penerima')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror" value="{{ $data->jumlah }}" name="jumlah" id="jumlah">
                                        @error('jumlah')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="spj" class="col-sm-3 col-form-label">Jumlah SPJ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('spj') is-invalid @enderror" name="spj" id="spj" value="{{ $data->spj }}">
                                        @error('spj')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tdspj" class="col-sm-3 col-form-label">Jumlah Tidak SPJ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('tdspj') is-invalid @enderror" name="tdspj" id="tdspj" value="{{ $data->tdspj }}">
                                        @error('tdspj')
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