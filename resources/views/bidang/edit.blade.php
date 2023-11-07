@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('bidang.index')}}" class="btn btn-rounded btn-secondary"><i class="fa fa-chevron-left mr-2"></i> Kembali </a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">
            <div class="col-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Form Bidang</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('bidang.update', $data->id)}}" method="POST">
                            {{ csrf_field() }}
                            @method('PUT')

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

                            <div class="form-body">
                                @if ($data->parent_id == null)
                                    <div class="form-group">
                                        <label>Kode Bidang</label>
                                        <input type="text"  class="form-control"  name="kode_bidang" id="" value="{{$data->kode_bidang}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Bidang</label>
                                        <input type="text"  class="form-control"  name="nama_bidang" id="" value="{{$data->nama_bidang}}">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label>Induk Bidang</label>
                                        <select class="form-control" name="nama_induk_bidang">
                                            <option value=""></option>
                                            @foreach($listBidang as $list)
                                                <option value="{{$list->id}}" {{($list->id == $data->parent_id) ? 'selected' : '' }}>{{$list->nama_bidang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Sub Bidang</label>
                                        <input type="text"  class="form-control"  name="nama_bidang" id="" value="{{$data->nama_bidang}}">
                                    </div>
                                @endif
                                <div class="box-footer">
                                    <a href="{{route('bidang.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

    $("select").select2({
        placeholder : "Pilih...",
        width : '100%'
    }).trigger('')
</script>
@endpush
