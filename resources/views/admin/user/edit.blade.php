@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <a class="btn btn-primary mr-2" href="{{ route('user.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h5 class="my-auto">Edit User</h5>
</div>

<form action="{{ route('user.update', [$user->id]) }}" method="post" class="card">
    @csrf
    @method('PUT')
    
    <div class="card-body">
        <div class="form-group form-row">
            <div class="col-md-2">
                <label>ID User</label>
                <input class="form-control" type="text" name="id" value="{{ $user->id }}" readonly>
            </div>
            <div class="col-md-5">
                <label>Nama User</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" readonly>
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col-md-5">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <div class="col-md-2">
                @foreach ($user->roles as $role)
                    <label>Akses</label>
                    <input type="text" name="akses" class="form-control" value="{{ $role->name }}" readonly>
                @endforeach
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col-md-2">
                <label>Ubah Akses</label>
                <select name="role" class="form-control" required>
                    <option value="">--Pilih Akses--</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-fw fa-save"></i>
            Simpan
        </button>
    </div>
</form>
@endsection