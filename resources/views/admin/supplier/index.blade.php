@extends('layouts.app')

@section('content')
    @include('admin.supplier.create')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Supplier</h1>
    </div>
    <div class="card">
        <div class="card-header py-3">
            <div class="clearfix">
                <button type="button" class="float-right btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#createModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Tambah
                </button>
            </div>
        </div>
        <div class="align-items-center justify-content-between mb-4">
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $supp)
                            <tr>
                                <td>{{ $supp->kd_supp }}</td>
                                <td>{{ $supp->nm_supp }}</td>
                                <td>{{ $supp->alamat }}</td>
                                <td>{{ $supp->telepon }}</td>
                                <td>
                                    <a href="{{ route('supplier.edit', [$supp->kd_supp]) }}"
                                        class="btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                        Edit
                                    </a>
                                    <form method="post" action="{{ route('supplier.destroy', [$supp->kd_supp]) }}"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
