@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Form Barang</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('barang.store') }}">
                            {{ csrf_field() }}
                            <div class="form-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul style="margin-bottom:0px;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input name="name" required type="text" class="form-control m-input" placeholder="Nama Barang" value="{{ old('barang') }}">
                                </div>

                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input name="kode_barang" required type="text" class="form-control m-input" placeholder="Kode Barang" value="{{ old('kode-barang') }}">
                                </div>

                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Kategori Barang </label>
                                    <select name="kategori_barang_id" class="form-control">
                                        <option value="" selected disabled>Pilih ...</option>
                                            @foreach($kategori_barang as $list)
                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('barang.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection