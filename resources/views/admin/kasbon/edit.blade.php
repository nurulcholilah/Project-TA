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
                        <li class="breadcrumb-item active" aria-current="page">Form Edit Kasbon</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="mx-auto">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <form action="{{ route('kasbon.update', $data->id_kasbon) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Edit Data Kasbon</h5>
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
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id_kasbon" value="{{ $data->id_kasbon }}">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data->nama }}" name="nama" id="nama" placeholder="Masukkan nama" value="{{ $data->nama }}">
                                        @error('nama')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nominal" class="col-sm-3 col-form-label">Nominal</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nominal') is-invalid @enderror" value="{{ $data->nominal }}" name="nominal" id="nominal" placeholder="Masukkan nominal" value="{{ $data->nominal }}">
                                        @error('nominal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="">- Pilih -</option>
                                            <option value="belum_bayar" {{ $data->status == 'belum_bayar' ? 'selected' : '' }}>Belum bayar</option>
                                            <option value="sudah_bayar" {{ $data->status == 'sudah_bayar' ? 'selected' : '' }}>Sudah bayar</option>
                                        </select>
                                        @error('status')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal_pembayaran" class="col-sm-3 col-form-label">Tanggal Bayar</label>
                                    <div class="col-sm-9">
                                    <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" value="{{ $data->tanggal_pembayaran }}" name="tanggal_pembayaran" id="tanggal_pembayaran" value="{{ $data->tanggal_pembayaran }}">
                                        @error('tanggal_pembayaran')
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

<script>
    document.getElementById('status').addEventListener('change', function() {
        var status = this.value;
        if (status === 'sudah_bayar') {
            document.getElementById('tanggal_pembayaran').style.display = 'block';
        } else {
            document.getElementById('tanggal_pembayaran').style.display = 'none';
        }
    });
</script>
@endsection