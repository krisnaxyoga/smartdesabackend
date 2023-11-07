@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <form method="POST" action="{{ url('slider') }}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3>Slider</h3>
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
                                    <label>Title</label>
                                    <input name="title" required type="text" class="form-control m-input" placeholder="Title" value="{{ old('title') }}">
                                </div>
                                <div class="box">
                                    <div class="col-md-3">
                                        <div class="box-header">
                                            <h3>Featured Image</h3>
                                        </div>
                                        <div class="box-divider m-0"></div>
                                        <div class="box-body">
                                            <div class="preview-img">
                                                <img src="{{asset('images/sample_image.png')}}" alt="" class="dummy-avatar" id="dummy">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <input type="file" style="display : none" name="profile" id="featureImage">
                                            <button name="browseImg"  type="button" class="btn btn-primary" style="display : block;width : 100%;"><i class="fa fa-camera"></i> Browse</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                    
                </div>
                <a href="{{ url('slider') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button name="save" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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