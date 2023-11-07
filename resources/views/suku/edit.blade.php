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
                    <h3>Form Suku </h3>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <form method="POST" action="{{ route('suku.update', $data->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
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
                                    <label>Nama Suku</label>
                                    <input name="nama" required type="text" class="form-control m-input" placeholder="Nama Suku" value="{{ $data->nama }}">
                                </div>
                        </div>
                </div>
                <div class="box-footer">
                    <a href="{{ url('suku') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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