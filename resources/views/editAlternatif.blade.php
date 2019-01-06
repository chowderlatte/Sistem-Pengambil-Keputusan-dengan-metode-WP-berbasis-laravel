@extends('layouts.master')

@section('navbar')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="/addalter" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('post') }}
          <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                <label>Nama Alternatif</label>
                <input type="text" name="namaAlternatif" class="form-control" value= '$data->id_alternatif'>
            </div>
            <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                <label>Bahan</label>
                <input type="text" name="bahan" class="form-control" value='$data->k1'>
            </div>
            <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                <label>Jenis</label>
                <input type="text" name="jenis" class="form-control" value='$data->k2'>
            </div>
            <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                <label>Bentuk</label>
                <input type="text" name="bentuk" class="form-control" value='$data->k3'>
            </div>
            <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                <label>Berat</label>
                <input type="text" name="berat" class="form-control" value='$data->k4'>
            </div>
            <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value='$data->k5'>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Tambah Alternatif Baru</button>
                <a href="/alternatif" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>
</div>
@stop
