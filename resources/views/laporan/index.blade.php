@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="cardheader">Laporan Transaksi Jurnal</div>
                    <div class="card-body">
                        <form action="{{ route('laporan.index') }}" target="_blank">
                            @csrf
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>Periode Jurnal</label>
                                        <input type="hidden" name="jenis" value="bukubesar"
                                            class="form-control">
                                        <select id="periode" name="periode" class="form-control">
                                            <option value="">--Pilih Periode Laporan--</option>
                                            <option value="All">Semua</option>
                                            <option value="periode">Per Periode</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tanggal Awal</label>
                                        <input type="date" name="tglawal" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tanggal Akhir</label>
                                        <input type="date" name="tglakhir" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-success">Cetak</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
