<div class="content-wrapper p-2">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex">
                                <h3 class="card-title">Thống kê đơn hàng doanh số</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{ number_format($total, 0) }} VNĐ</span>
                                    <span>Tổng doanh thu</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    {{-- <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 33.1%
                                    </span>
                                    <span class="text-muted">Since last month</span> --}}
                                <div class="form-group pr-2">
                                    <div class="input-group date">
                                        <input wire:model="filterStart" type="datetime-local"
                                            class="form-control datetimepicker-input">
                                    </div>
                                </div>
                                <div class="form-group pr-2">
                                    <div class="input-group date">
                                        <input wire:model="filterEnd" type="datetime-local"
                                            class="form-control datetimepicker-input">
                                    </div>
                                </div>
                                <div class="form-group mr-3">
                                    <button type="button" class="btn btn-block btn-primary"
                                        wire:click.prevent="filterResults">Lọc kết quả</button>
                                </div>
                                <div class="form-group pr-2">
                                    <select class="form-control" wire:model="by_date">
                                        <option value="0">Sắp xếp theo</option>
                                        <option value="7">7 ngày qua</option>
                                        <option value="30">Tháng này</option>
                                        <option value="90">Tháng trước</option>
                                        <option value="365">365 ngày qua</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" wire:model="categoryId">
                                        <option value="0">Tất cả danh mục</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            {{-- chart  --}}
                            <div class="position-relative mb-4">
                                {{-- @livewire('admin.chart-component') --}}
                                <canvas id="orderRevenueChart"
                                    style="height: 450px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$quantity_order}}</h3>

                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($growth_rate , 2)}}<sup style="font-size: 20px">%</sup></h3>

                            <p>Tỷ lệ tăng trưởng so với tháng trước</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$quantity_user}}</h3>

                            <p>Khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$quantity_product}}</h3>

                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

{{-- <script>
    document.addEventListener('livewire:load', function() {
        var chartData = @json($data);
        // console.log(chartData);
        var ctx = document.getElementById('orderRevenueChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(data => data.date),
                datasets: [{
                    label: 'Doanh thu',
                    data: chartData.map(data => data.revenue),
                    backgroundColor: 'rgba(23, 162, 184, 0.6)',
                    borderColor: 'rgba(23, 162, 184, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        window.addEventListener('reload-script', function(event) {
            if (chart) {
                chart.destroy();
            }
            var dataChart = event.detail;
            // console.log(dataChart);
            var ctx = document.getElementById('orderRevenueChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dataChart.map(data => data.date),
                    datasets: [{
                        label: 'Doanh thu',
                        data: dataChart.map(data => data.revenue),
                        backgroundColor: 'rgba(23, 162, 184, 0.6)',
                        borderColor: 'rgba(23, 162, 184, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    });
</script> --}}

<script>
    document.addEventListener('livewire:load', function() {
        let chartData = @json($data);
        let chart = null;
        let ctx = document.getElementById('orderRevenueChart').getContext('2d');

        function createChart(data) {
            if (chart) {
                chart.destroy();
            }
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(data => data.date),
                    datasets: [{
                        label: 'Doanh thu',
                        data: data.map(data => data.revenue),
                        backgroundColor: 'rgba(23, 162, 184, 0.6)',
                        borderColor: 'rgba(23, 162, 184, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        createChart(chartData);

        window.addEventListener('reload-script', function(event) {
            let dataChart = event.detail;
            createChart(dataChart);
        });
    });
</script>
