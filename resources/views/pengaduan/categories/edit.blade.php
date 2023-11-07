@extends('layouts.app') @section('title') {{$page_title}} @endsection @section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form action="{{route('categories.update',$category->id)}}" method="POST"  enctype="multipart/form-data">
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
                            <h3>Form Edit Kategori Pengaduan</h3>
                        </div>

                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <input name="name" required="" type="text" class="form-control m-input" placeholder="Kategori" value="{{$category->name}}">
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <input type="file" style="display: none" name="photo" accept="image/*">
                                <p class="mb-1"><img src="{{$category->photo != null ? $category->photo : '/images/dummy-landscape.png'}}" class="dark" width="240" id="photo"></p>
                                <button class="btn btn-primary btn-browse" id="btn-browse" type="button"><i class="fa fa-folder-open"></i> Browse...</button>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('categories.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>

                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection @push('scripts')
<script type="text/javascript">
  let $photoInput = $('[name="photo"]'),
    $photo = document.getElementById('photo'),
    reader = new FileReader()

    $(document).ready(function() {
        $('#btn-browse').on('click', function () {
        $photoInput.trigger('click')
        })

        $photoInput.on('change', function (event) {
        reader.onload = function(){
            $photo.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0])
        })
    })
</script>
@endpush
