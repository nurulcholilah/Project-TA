@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Data Pengeluaran</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Detail Pengeluaran</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Informasi Pengeluaran</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') }}</li>
                            <li class="list-group-item"><strong>Kode Akun:</strong> {{ $data->kode_akun }}</li>
                            <li class="list-group-item"><strong>Kategori:</strong> {{ $data->kategori ? $data->kategori->keterangan : 'Tidak ditemukan' }}</li>
                            <li class="list-group-item"><strong>Uraian:</strong> {{ $data->uraian }}</li>
                            <li class="list-group-item"><strong>Penerima:</strong> {{ $data->penerima }}</li>
                            <li class="list-group-item"><strong>Jumlah:</strong> @currency($data->jumlah)</li>
                            <li class="list-group-item"><strong>SPJ:</strong> @currency($data->spj)</li>
                            <li class="list-group-item"><strong>Tidak SPJ:</strong> @currency($data->tdspj)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Nota Pengeluaran</h5>
                        <img src="{{ url('assets/images/file/' . $data->file) }}" alt="{{ $data->file }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection