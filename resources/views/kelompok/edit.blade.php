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
                        <h3>Form Kelompok</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('kelompok.update',[$data->id]) }}">
                            {{ csrf_field() }}
                            {!! method_field('PUT') !!}
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
                                    <label>Nama Kelompok</label>
                                    <input name="nama" required type="text" class="form-control m-input" placeholder="Nama Kelompok" value="{{ $data->nama }}">
                                </div>

                                <div class="form-group">
                                    <label>Kode Kelompok</label>
                                    <input name="kode" required type="text" class="form-control m-input" placeholder="Kode" value="{{ $data->kode }}">
                                </div>

                                <div class="form-group">
                                    <label>Ketua</label>
                                    <select required  class="form-control" name="ketua_id">
                                        <option value=""></option>
                                    @foreach($listPenduduk as $list)
                                        <option value="{{$list->id}}" {{$data->ketua_id == $list->id ? 'selected' : ''}} >[{{$list->nik}}] {{$list->nama}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select required  class="form-control" name="kelompok_master_id">
                                        <option value=""></option>
                                        @foreach($listKelompok as $list)
                                        <option value="{{$list->id}}" {{$data->kelompok_master_id == $list->id ? 'selected' : ''}} >{{$list->kelompok}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                    

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan">{{$data->keterangan}}</textarea>
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
    
    $("select").select2({
        width : '100%',
        placeholder : 'Pilih...'
    })

</script>
@endpush