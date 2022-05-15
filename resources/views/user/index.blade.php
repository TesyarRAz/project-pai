@extends('layouts.app')

@section('content')
    @include('user.create')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
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
                            <th width="5%">ID</th>
                            <th width="25%">Nama</th>
                            <th width="20%">Email</th>
                            <th width="15%">Roles/Akses</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    @foreach ($row->roles as $r)
                                        {{ $r->id }}
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('user.edit', [$row->id]) }}"
                                        class="btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                        Edit
                                    </a>
                                    <form method="post" action="{{ route('user.destroy', [$row->id]) }}"
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
