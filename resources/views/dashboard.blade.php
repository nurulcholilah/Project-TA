@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <div class="dash-wrapper bg-dark">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">SALDO AWAL</p>
                            <h3 class="mb-3 text-white">@currency($saldoAwal)</h3>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">SALDO SAAT INI</p>
                            <h3 class="mb-3 text-white">@currency($saldoSaatIni)</h3>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">TOTAL PENGELUARAN</p>
                            <h3 class="mb-3 text-white">@currency($pengeluaran)</h3>
                            <!-- <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 4.2% </span> last 7 days</p> -->
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">TOTAL PEMASUKAN</p>
                            <h3 class="mb-3 text-white">@currency($pemasukan)</h3>
                            <!-- <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 3.6%</span> vs last 7 days</p> -->
                            <div id="chart3"></div>
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
                    <div class="" id="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#ff0000" fill-opacity="1" d="M0,192L17.1,213.3C34.3,235,69,277,103,256C137.1,235,171,149,206,117.3C240,85,274,107,309,112C342.9,117,377,107,411,90.7C445.7,75,480,53,514,69.3C548.6,85,583,139,617,149.3C651.4,160,686,128,720,144C754.3,160,789,224,823,213.3C857.1,203,891,117,926,69.3C960,21,994,11,1029,48C1062.9,85,1097,171,1131,176C1165.7,181,1200,107,1234,90.7C1268.6,75,1303,117,1337,154.7C1371.4,192,1406,224,1423,240L1440,256L1440,320L1422.9,320C1405.7,320,1371,320,1337,320C1302.9,320,1269,320,1234,320C1200,320,1166,320,1131,320C1097.1,320,1063,320,1029,320C994.3,320,960,320,926,320C891.4,320,857,320,823,320C788.6,320,754,320,720,320C685.7,320,651,320,617,320C582.9,320,549,320,514,320C480,320,446,320,411,320C377.1,320,343,320,309,320C274.3,320,240,320,206,320C171.4,320,137,320,103,320C68.6,320,34,320,17,320L0,320Z"></path>
                        </svg>
                    </div>
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
                    <div class="" id="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#0099ff" fill-opacity="1" d="M0,192L17.1,213.3C34.3,235,69,277,103,256C137.1,235,171,149,206,117.3C240,85,274,107,309,112C342.9,117,377,107,411,90.7C445.7,75,480,53,514,69.3C548.6,85,583,139,617,149.3C651.4,160,686,128,720,144C754.3,160,789,224,823,213.3C857.1,203,891,117,926,69.3C960,21,994,11,1029,48C1062.9,85,1097,171,1131,176C1165.7,181,1200,107,1234,90.7C1268.6,75,1303,117,1337,154.7C1371.4,192,1406,224,1423,240L1440,256L1440,320L1422.9,320C1405.7,320,1371,320,1337,320C1302.9,320,1269,320,1234,320C1200,320,1166,320,1131,320C1097.1,320,1063,320,1029,320C994.3,320,960,320,926,320C891.4,320,857,320,823,320C788.6,320,754,320,720,320C685.7,320,651,320,617,320C582.9,320,549,320,514,320C480,320,446,320,411,320C377.1,320,343,320,309,320C274.3,320,240,320,206,320C171.4,320,137,320,103,320C68.6,320,34,320,17,320L0,320Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pengeluaran Tahun ini</p>
                                <h5 class="mb-0">@currency($pengeluaranTahunIni)</h5>
                            </div>
                            <div class="ms-auto"> <i class='bx bx-bulb font-30'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#ffd700" fill-opacity="1" d="M0,192L17.1,213.3C34.3,235,69,277,103,256C137.1,235,171,149,206,117.3C240,85,274,107,309,112C342.9,117,377,107,411,90.7C445.7,75,480,53,514,69.3C548.6,85,583,139,617,149.3C651.4,160,686,128,720,144C754.3,160,789,224,823,213.3C857.1,203,891,117,926,69.3C960,21,994,11,1029,48C1062.9,85,1097,171,1131,176C1165.7,181,1200,107,1234,90.7C1268.6,75,1303,117,1337,154.7C1371.4,192,1406,224,1423,240L1440,256L1440,320L1422.9,320C1405.7,320,1371,320,1337,320C1302.9,320,1269,320,1234,320C1200,320,1166,320,1131,320C1097.1,320,1063,320,1029,320C994.3,320,960,320,926,320C891.4,320,857,320,823,320C788.6,320,754,320,720,320C685.7,320,651,320,617,320C582.9,320,549,320,514,320C480,320,446,320,411,320C377.1,320,343,320,309,320C274.3,320,240,320,206,320C171.4,320,137,320,103,320C68.6,320,34,320,17,320L0,320Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Pemasukan Tahun ini</p>
                                <h5 class="mb-0">@currency($pemasukanTahunIni)</h5>
                            </div>
                            <div class="ms-auto"> <i class='bx bx-bulb font-30'></i>
                            </div>
                        </div>
                    </div>
                    <div class="" id="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#75a47f" fill-opacity="1" d="M0,192L17.1,213.3C34.3,235,69,277,103,256C137.1,235,171,149,206,117.3C240,85,274,107,309,112C342.9,117,377,107,411,90.7C445.7,75,480,53,514,69.3C548.6,85,583,139,617,149.3C651.4,160,686,128,720,144C754.3,160,789,224,823,213.3C857.1,203,891,117,926,69.3C960,21,994,11,1029,48C1062.9,85,1097,171,1131,176C1165.7,181,1200,107,1234,90.7C1268.6,75,1303,117,1337,154.7C1371.4,192,1406,224,1423,240L1440,256L1440,320L1422.9,320C1405.7,320,1371,320,1337,320C1302.9,320,1269,320,1234,320C1200,320,1166,320,1131,320C1097.1,320,1063,320,1029,320C994.3,320,960,320,926,320C891.4,320,857,320,823,320C788.6,320,754,320,720,320C685.7,320,651,320,617,320C582.9,320,549,320,514,320C480,320,446,320,411,320C377.1,320,343,320,309,320C274.3,320,240,320,206,320C171.4,320,137,320,103,320C68.6,320,34,320,17,320L0,320Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection