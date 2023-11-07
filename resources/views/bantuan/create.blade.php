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
                        <h3>Form Bantuan</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form method="POST" action="{{ url('bantuan') }}">
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
                                    <label>Sasaran</label>
                                    <select required  class="form-control" name="sasaran">
                                    @foreach($sasaran as $s)
                                        <option value="{{$s->id}}">{{$s->subjek}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Program</label>
                                    <input name="nama" required type="text" class="form-control m-input" placeholder="Nama Program" value="{{ old('nama') }}">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="ndesc">{{old('ndesc')}}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                     <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="text" class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="sdate">
                                    </div>

                                    </div>

                                    <div class="col-md-6">

                                     <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="text" class="form-control datepicker-input" id="datepicker" data-toggle="datepicker" data-target="#datepicker" autocomplete="off" name="edate">
                                    </div>

                                    </div>
                                </div>

                               


                                
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url('bantuan') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                        {{-- <button name="savenew" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Sa÷ve &amp; New</button> --}}
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(".datepicker-input").datepicker({
        autoclose : true,
        format: 'yyyy-mm-dd'
    });


</script>
@endpush