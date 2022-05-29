@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Laporan Transaksi Jurnal</div>
                    <div class="card-body">
                        <form action="{{ route('laporan.index') }}" target="_blank">
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>Periode Jurnal</label>
                                        <input type="hidden" name="jenis" value="bukubesar"
                                            class="form-control">
                                        <select id="periode" name="periode" class="form-control">
                                            <option value="">--Pilih Periode Laporan--</option>
                                            <option value="all">Semua</option>
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
                                <button type="submit" class="btn btn-success">Cetak</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
