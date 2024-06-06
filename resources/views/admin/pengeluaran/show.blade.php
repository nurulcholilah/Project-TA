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
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Tanggal</span>
                                <span class="list-content">: {{ \Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') }}</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Kode Akun</span>
                                <span class="list-content">: {{ $data->kode_akun }}</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Alokasi Dana</span>
                                <span class="list-content">: {{ $data->kategori ? $data->kategori->keterangan : 'Tidak ditemukan' }}</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Uraian</span>
                                <span class="list-content">: {{ $data->uraian }}</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Penerima</span>
                                <span class="list-content">: {{ $data->penerima }}</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Jumlah</span>
                                <span class="list-content">: @currency($data->jumlah)</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">SPJ</span>
                                <span class="list-content">: @currency($data->spj)</span>
                            </li>
                            <li class="list-group-item align-items-start">
                                <span class="list-label">Tidak SPJ</span>
                                <span class="list-content">: @currency($data->tdspj)</span>
                            </li>
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
