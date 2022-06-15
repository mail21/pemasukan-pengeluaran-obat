
@extends('layouts.layout')


@section('content-app')
<h2 class="mt-2 mb-5">Master Obat</h2>
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
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTambahAngsuran">Tambah Obat</button>

            <div class="modal fade" id="modalTambahAngsuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menambah Obat</h5>
                            <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/obat/add') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Obat</label>
                                    <input type="text" name="kode_inv" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Kode">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Obat</label>
                                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter harga">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok</label>
                                    <input type="text" name="stok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter stok">
                                </div>
                                <div class="form-group">
                                    <label for="tgl_expired">Tgl Expired</label>
                                     <input type="date" class="form-control" id="tgl_expired" name="tgl_expired"  >    
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
                            <th scope="row">Kode</th>
                            <th>Nama Obat</th>
                            <th>Tgl Expire</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($obats) == 0)
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="m-3">
                                    <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                    <span>Data Tidak Ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endif

                        @foreach ($obats as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->kode_inv }}</th>
                            <td class="align-middle">{{ $data->nama}}</td>
                            <td class="align-middle">{{ $data->tgl_expired}}</td>
                            <td class="align-middle">{{ $data->stok}}</td>
                            <td class="align-middle">{{ $data->harga}}</td>
                            <td class="align-middle">
                                <div>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#modaledit{{ $data->kode_inv }}">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalhapus{{ $data->kode_inv }}">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalhapus{{ $data->kode_inv }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Obat</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/obat/hapus') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="kode_inv" value="{{ $data->kode_inv }}">
                                            
                                        <p>Anda Yakin ingin menghapus obat {{$data->nama}}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modaledit{{ $data->kode_inv }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                                        <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/obat/edit') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kode Obat</label>
                                                <input type="text" value="{{ $data->kode_inv }}" name="kode_inv" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Kode">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Obat</label>
                                                <input type="text" value="{{ $data->nama }}" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Harga</label>
                                                <input type="text" value="{{ $data->harga }}" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter harga">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Stok</label>
                                                <input type="text" value="{{ $data->stok }}" name="stok" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter stok">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_expired">Tgl Expired</label>
                                                 <input type="date" value="{{ substr($data->tgl_expired,0,10) }}" class="form-control" id="tgl_expired" name="tgl_expired"  >    
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
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $obats->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection