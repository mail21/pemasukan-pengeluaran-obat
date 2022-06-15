
@extends('layouts.layout')

@section('content-app')

    <div class="pagetitle">
    <h1>Dashboard</h1>
    
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    </li>
                </ul>
                </div>

                <div class="card-body">
                <h5 class="card-title">Pemasukan</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                    <h6>{{$totalPemasukan}}</h6>

                    </div>
                </div>
                </div>

            </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    </li>
                </ul>
                </div>

                <div class="card-body">
                <h5 class="card-title">Revenue</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                    <h6>RP. {{$revenue}}</h6>

                    </div>
                </div>
                </div>

            </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    </li>

                </ul>
                </div>

                <div class="card-body">
                <h5 class="card-title">Pengeluaran</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <h6>{{$totalPengeluaran}}</h6>
                    </div>
                </div>

                </div>
            </div>

            </div><!-- End Customers Card -->

            <!-- Recent Sales -->
            <div class="col-12">
            <div class="card recent-sales overflow-auto">

                

                <div class="card-body">
                <h5 class="card-title">Recent Sales </h5>

                <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Tipe</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($recentSales as $item)
                        <tr>
                            <th scope="row"><a href="#">{{$item->kode_inv}}</a></th>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->harga}}</td>
                            <td><span class="badge bg-success">{{$item->tipe}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                </div>

            </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
            <div class="card top-selling overflow-auto">


                <div class="card-body pb-0">
                <h5 class="card-title">Top Selling </h5>

                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topSelling as $item)
                    <tr>
                        <th scope="row"><a href="#">{{$item->nama}}</a></th>
                        <td>{{$item->harga}}</td>
                        <td>{{$item->jumlah}}</td>
                    </tr>
                    @endforeach
                   
                    </tbody>
                </table>

                </div>

            </div>
            </div><!-- End Top Selling -->

        </div>
        </div><!-- End Left side columns -->

    </div>
    </section>

@endsection