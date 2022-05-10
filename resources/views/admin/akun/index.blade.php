@extends('layouts.app')

@section('content')
    @include('admin.akun.create')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Akun</h1>
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
                            <th width="20%">Kode Akun</th>
                            <th>Nama Akun</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($akun as $akn)
                            <tr>
                                <td>{{ $akn->no_akun }}</td>
                                <td>{{ $akn->nm_akun }}</td>
                                <td>
                                    <a href="{{ route('akun.edit', [$akn->no_akun]) }}"
                                        class="btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                        Edit
                                    </a>
                                    <form method="post" action="{{ route('akun.destroy', [$akn->no_akun]) }}"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                            Hapus
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
