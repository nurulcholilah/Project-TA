@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Laporan</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('laporan.pemasukan') }}" method="GET" class="row align-items-center">
                    @csrf
                    <div class="col-md-3 mb-3">
                        <h7>Berdasarkan Tahun</h7>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class='bx bx-calendar'></i></span>
                            <select class="form-select form-select-sm" id="year" name="year">
                                <option value="" selected>Pilih Tahun</option>
                                @for ($i = date('Y') +1; $i >= 2020; $i--)
                                <option value="{{ $i }}" @if(request()->input('year') == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h7>Berdasarkan Tanggal</h7>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class='bx bx-calendar'></i></span>
                            <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="{{ request()->input('start_date') }}" placeholder="Dari Tanggal">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h7>&nbsp;</h7>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent"><i class='bx bx-calendar'></i></span>
                            <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="{{ request()->input('end_date') }}" placeholder="Sampai Tanggal">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('laporan.pemasukan') }}" class="btn btn-secondary me-2">Reset</a>
                        <a href="{{ route('laporan.pemasukan.pdf', request()->input()) }}" class="btn btn-danger">PDF</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(request()->filled('year') || request()->filled('start_date') || request()->filled('end_date'))
                @if(count($data) > 0)
                <h5>Data Pemasukan</h5>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; $totalPemasukan = 0; @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }} </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }} </td>
                                <td>{{ $item->uraian }}</td>
                                <td>@currency($item->jumlah)</td>
                                @php $totalPemasukan += $item->jumlah; @endphp
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tfoot>
                                <tr>
                                    <th colspan="3"><strong>Total Pemasukan</strong></th>
                                    <td><strong>@currency($totalPemasukan)</strong></td>
                                </tr>
                            </tfoot>
                        </tfoot>
                    </table>
                </div>
                @else
                <p style="text-align: center;">Tidak ada data yang ditemukan untuk filter yang Anda pilih.</p>
                @endif
                @else
                <p style="text-align: center;">Silakan gunakan form filter di atas untuk memfilter laporan pemasukan.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection