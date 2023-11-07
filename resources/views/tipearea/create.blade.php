@extends('layouts.app')

@section('title')
Tambah Tipe Area
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    <div class="row">
      <div class="col-lg-6">
        @if ($errors->any())
          <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">&times;</a>
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
            <a class="close" data-dismiss="alert">&times;</a>
          </div>
        @endif
        @if (session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('error') }}
            <a class="close" data-dismiss="alert">&times;</a>
          </div>
        @endif
        <div class="box">
          <div class="box-header"><h3>Tambah Tipe Area</h3></div>
          <div class="box-divider m-0"></div>
          <form class="form-horizontal" action="/peta/tipearea" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <div class="form-group row">
                <label class="col-form-label col-lg-3">Nama Tipe Area</label>
                <div class="col-lg-9">
                  <input type="text" name="name" required class="form-control" value="{{ old('name') }}" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-lg-3">Warna</label>
                <div class="col-lg-9">
                  <input type="text" name="color" required class="jscolor" value="{{ old('color') }}" />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-lg-3" for="enabled">Aktif</label>
                <div class="col-lg-9">
                  <label class="ui-switch ui-switch-lg">
                    <input type="checkbox" name="enabled" id="enabled" {{ old('enabled') ? 'checked' : '' }} value="1">
                    <i></i>
                  </label>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-rounded btn-success"><i class="fa fa-save"></i> Simpan</button>
              <a href="/peta/tipearea" class="btn btn-rounded btn-default">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/theme/libs/jscolor/jscolor.js"></script>
<script type="text/javascript">
  let $photoInput = $('[name="simbol"]'),
    $photo = document.getElementById('simbol'),
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