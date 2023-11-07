@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('notification.update', $notif->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="referrer" value="{{ request()->server('HTTP_REFERER') }}" />
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3>Form Edit Pengumuman</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">

                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Judul <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                <input name="title" required="" type="text" class="form-control m-input" placeholder="Judul" value="{{ $notif->title}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Konten <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                <textarea class="form-control" name="description">{{ $notif->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Gambar</label>
                                <div class="col-lg-9">
                                    <input type="file" style="display: none" name="photo" accept="image/*" id="itemPict">
                                    <p class="mb-1"><img src="{{$notif->photo !== null && $notif->photo != ''  ? 'https://s3-ap-southeast-1.amazonaws.com/smartdesa/'.$notif->photo : asset('images/dummy-landscape.png')}}" width="100%" class="dummy-avatar" id="photo"></p>
                                    <button name="browseImg" class="btn btn-primary" id="btn-browse" type="button"><i class="fa fa-folder-open"></i> Browse...</button>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <a href="{{route('notification.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>

                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("button[name=browseImg]").click(function(){
        $("#itemPict").trigger('click')
    });

    $("#itemPict").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('photo');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endpush
