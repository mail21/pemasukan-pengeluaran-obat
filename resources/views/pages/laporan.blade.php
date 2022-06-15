
@extends('layouts.layout')


@section('content-app')
<h2 class="mt-2 mb-5">Laporan</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-12">
                @if (\Session::has('error'))
                <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                @endif
                @if (\Session::has('message'))
                @php 
                    $arr = json_decode(\Session::get('message'));
                @endphp
                <div class="alert alert-light-success color-success d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-check mr-2"></i> {{$arr->pesan}}
                    </span>
                </div>
                @endif
            </div>
        </div> 
        <div class="d-flex w-100" style="gap: 4px">
            <div class="mb-3">
                <div class="dropdown">
                    <button class="btn btn-secondary  dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter Order
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <a class="dropdown-item" href="/laporan-{{$tipe}}?order=asc">Terbaru</a>
                        <a class="dropdown-item" href="/laporan-{{$tipe}}?order=desc">Terlama</a>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <form method="get" action="/laporan-{{$tipe}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="nama obat" aria-label="nama obat" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary" type="button">Button</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">ID Transaksi</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($datas) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="m-3">
                                    <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                    <span>Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endif

                        @foreach ($datas as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->id }}</th>
                            <td class="align-middle">{{ $data->kode_inv}}</td>
                            <td class="align-middle">{{ $data->nama}}</td>
                            <td class="align-middle">{{ $data->tgl_transaksi}}</td>
                            <td class="align-middle">{{ $data->jumlah}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $datas->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection