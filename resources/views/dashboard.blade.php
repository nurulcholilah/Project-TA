@extends("layouts.apps")
@section("wrapper")
<div class="page-wrapper">
    <div class="page-content">
        <div class="dash-wrapper bg-dark">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-5">
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Sessions</p>
                            <h3 class="mb-3 text-white">876</h3>
                            <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Total Users</p>
                            <h3 class="mb-3 text-white">4.5M</h3>
                            <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 4.2% </span> last 7 days</p>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Page Views</p>
                            <h3 class="mb-3 text-white">64,835</h3>
                            <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 3.6%</span> vs last 7 days</p>
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
                <div class="col border-end border-light-2">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Bounce Rate</p>
                            <h3 class="mb-3 text-white">42.68%</h3>
                            <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 2.5%</span> vs last 7 days</p>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                            <p class="mb-1 text-white">Avg. Session Duration</p>
                            <h3 class="mb-3 text-white">00:04:60</h3>
                            <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 5.2%</span> vs last 7 days</p>
                            <div id="chart5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
@endsection