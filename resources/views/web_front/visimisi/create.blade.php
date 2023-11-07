@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form method="POST" action="{{ url('visimisi') }}" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3>Visi Misi</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
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
                                    <label>Judul</label>
                                    <input name="judul" value="{{$data == null || $data->judul == null ? 'Visi Misi' : $data->judul}}" required type="text" class="form-control m-input" placeholder="Judul">
                                </div>
                                <div class="form-group">
                                    <label>Isi</label>
                                    <textarea name="konten" id="konten" class="form-control" cols="30" rows="10">
                                            {{$data == null || $data->konten == null ? '' : $data->konten}}
                                    </textarea>
                                </div>
                               
                            </div>
                    </div>
                  
                    
                </div>
                <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <div class="col-md-3">
                    
                    <div class="box">
                        <div class="box-header">
                            <h3>Featured Image</h3>
                        </div>
                        <div class="box-divider m-0"></div>
                        <div class="box-body">
                            <div class="preview-img">
                                <img src="{{ $data == null || $data->gambar == null ? asset('images/sample_image.png') : $data->gambar}}" alt="" class="dummy-avatar" id="dummy">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="file" style="display : none" name="profile" id="featureImage">
                            <button name="browseImg"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                            @if($data == null || $data->gambar != null)
                              <a href="{{route('remove-img',['VISIMISI'])}}"  class="btn btn-danger" style="display : block;width : 100%;margin-top : 10px"><i class="fa fa-trash"></i> Remove Featured Image</a>
                            @endif
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
    ClassicEditor
    .create( document.querySelector( '#konten' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.log( error );
    } );

    $("button[name=browseImg]").click(function(){
        $("#featureImage").trigger('click')
    })

    $("#featureImage").change(function(e){
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById('dummy');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
    })
    $("select").select2({
        placeholder : "Pilih..."
    })
</script>

@endpush