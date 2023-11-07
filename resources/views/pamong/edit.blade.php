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
                    <h3>Form Staff Pemerintahan Desa </h3>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <form method="POST" action="{{ route('pamong.update', $data->id) }}" enctype="multipart/form-data">
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

                                <div class="row">
                                    <div class="col-md-9">
                                            <div class="form-group">
                                                    <label>Nama Staff Desa</label>
                                                    <input name="pamong_nama" required type="text" class="form-control m-input" placeholder="Nama Staff Desa" value="{{ $data->pamong_nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan Staff Desa</label>
                                                    <input name="jabatan" required type="text" class="form-control m-input" placeholder="Jabatan" value="{{ $data->jabatan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Induk Pegawai (NIP)</label>
                                                    <input name="pamong_nip" type="text" class="form-control m-input" placeholder="NIP" value="{{ $data->pamong_nip }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Induk Kependudukan (NIK)</label>
                                                    <input name="pamong_nik" type="text" class="form-control m-input" placeholder="NIK" value="{{ $data->pamong_nik }}">
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label>Username</label>
                                                    <input name="username" type="text" class="form-control m-input" placeholder="Username" value="{{ $data->username }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input name="password" type="password" class="form-control m-input" placeholder="Password">
                                                    <small>Biarkan kosong bila tidak ingin mengganti</small>
                                                </div> --}}
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                                <label for="">Foto</label>
                                                <div class="preview-img">
                                                        <img src="{{$data->foto !== null ? $data->foto : asset('images/Dummy.jpg')}}" alt="" class="dummy-avatar" id="dummy">
                                                    </div>
                                                    <input type="file" style="display : none" name="profile" id="profilePict">
                                                    <button name="browseImg"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>

                                        </div>
                                    </div>
                                </div>


                        </div>
                </div>
                <div class="box-footer">
                    <a href="{{ url('pamong') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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

    $("button[name=browseImg]").click(function(){
        $("#profilePict").trigger('click')
    })

    $("#profilePict").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('dummy');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    })
</script>
@endpush
