
@extends('layouts.layout')


@section('content-app')
<h2 class="mt-2 mb-5">Transaksi</h2>
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
        <div class="row mb-3">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTambahAngsuran">Tambah Transaksi</button>

            <div class="modal fade" id="modalTambahAngsuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menambah Transaksi</h5>
                            <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/transaksi/add') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Obat</label>
                                    <select class="form-select" name="kode_inv" required>
                                        @foreach ($obats as $item)
                                            <option value="{{$item->kode_inv}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipe</label>
                                    <select class="form-select" name="tipe" required>
                                        <option value="pemasukan">Pemasukan</option>
                                        <option value="pengeluaran">Pengeluaran</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Jumlah">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">ID</th>
                            <th>Nama Obat</th>
                            <th>Tgl Transaksi</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($transaksi_list) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="m-3">
                                    <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                    <span>Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endif 

                        @foreach ($transaksi_list as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->id }}</th>
                            <td class="align-middle">{{ $data->nama}}</td>
                            <td class="align-middle">{{ $data->tgl_transaksi}}</td>
                            <td class="align-middle">{{ $data->jumlah}}</td>
                            <td class="align-middle">
                                <div>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalhapus{{ $data->id }}">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalhapus{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/transaksi/hapus') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id_transaksi" value="{{ $data->id }}">
                                            
                                        <p>Anda Yakin ingin menghapus transaksi ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $transaksi_list->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection