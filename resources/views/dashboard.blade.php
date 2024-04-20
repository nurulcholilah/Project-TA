@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <div class="dash-wrapper bg-dark">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Saldo Awal</p>
                            <h3 class="mb-3 text-white">@currency($totalSaldo)</h3>
                            <!-- <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p> -->
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total Pengeluaran</p>
                            <h3 class="mb-3 text-white">@currency($pengeluaran)</h3>
                            <!-- <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 4.2% </span> last 7 days</p> -->
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total Pemasukan</p>
                            <h3 class="mb-3 text-white">@currency($pemasukan)</h3>
                            <!-- <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 3.6%</span> vs last 7 days</p> -->
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total Users</p>
                            <h3 class="mb-3 text-white">{{$jumlahUser}}</h3>
                            <!-- <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 2.5%</span> vs last 7 days</p> -->
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pengeluaran Bulan ini</p>
                                <h5 class="mb-0">@currency($pengeluaranBulanIni)</h5>
                            </div>
                            <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="w-chart5"></div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pemasukan Bulan ini</p>
                                <h5 class="mb-0">@currency($pemasukanBulanIni)</h5>
                            </div>
                            <div class="ms-auto"> <i class='bx bx-wallet font-30'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="w-chart6"></div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pengeluaran Tahun ini</p>
                                <h5 class="mb-0">@currency($pemasukanTahunIni)</h5>
                            </div>
                            <div class="ms-auto"> <i class='bx bx-bulb font-30'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="w-chart7"></div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pemasukan Tahun ini</p>
                                <h5 class="mb-0">@currency($pengeluaranTahunIni)</h5>
                            </div>
                            <div class="ms-auto"> <i class='bx bx-bulb font-30'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="w-chart8"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection