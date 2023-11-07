@extends('layouts.app')

@section('title')
Edit Lokasi: {{ $data->name }}
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    <div class="row">
      <div class="col-lg-12">
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
          <div class="box-header"><h3>Tambah Lokasi</h3></div>
          <div class="box-divider m-0"></div>
          <form class="form-horizontal" action="/peta/lokasi/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="lat" value="{{ old('lat') ?: $data->lat }}" />
            <input type="hidden" name="lng" value="{{ old('lng') ?: $data->lng }}" />
            <div class="box-body">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nama Lokasi</label>
                    <div class="col-lg-9">
                      <input type="text" name="name" class="form-control" value="{{ old('name') ?: $data->name }}" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Kategori</label>
                    <div class="col-lg-9">
                      <select name="tipe_lokasi_id" class="form-control">
                        <option value="">Pilih kategori...</option>
                        @foreach ($types as $type)
                          <option value="{{ $type->id }}"{{ (old('tipe_lokasi_id') ?: $data->tipe_lokasi_id) ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Deskripsi</label>
                    <div class="col-lg-9">
                      <textarea name="description" class="form-control" rows="8">{{ old('description') ?: $data->description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Gambar</label>
                    <div class="col-lg-9">
                      <input type="file" style="display: none" name="photo" accept="image/*" />
                      <p><img src="{{ $data->photo ?: '/images/dummy-landscape.png' }}" width="240" id="photo" /></p>
                      <button class="btn btn-primary" id="btn-browse" type="button"><i class="fa fa-folder-open"></i> Browse...</button>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3" for="enabled">Aktif</label>
                    <div class="col-lg-9">
                      <label class="ui-switch ui-switch-lg">
                        <input type="checkbox" name="enabled" id="enabled" {{ (old('enabled') ?: $data->enabled) == 1 ? 'checked' : '' }} value="1">
                        <i></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="col-form-label pt-0">Lokasi</label>
                    <div id="map" style="width: 100%; height: 400px"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-rounded btn-success"><i class="fa fa-save"></i> Simpan</button>
              <a href="/peta/lokasi" class="btn btn-rounded btn-default">Batal</a>
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
  let $photoInput = $('[name="photo"]'),
    $photo = document.getElementById('photo'),
    mapContainer = document.getElementById('map'),
    reader = new FileReader(),
    lat = {{ old('lat') ?: $data->lat }},
    lng = {{ old('lng') ?: $data->lng }},
    map, marker

  function initMap() {
    // Init map.
    map = new google.maps.Map(mapContainer, {
      center: {lat, lng},
      zoom: 15
    })

    marker = new google.maps.Marker({
      position: {lat, lng},
      map
    })

    google.maps.event.addListener(map, 'center_changed', function () {
      let coordinate = this.getCenter()

      marker.setPosition(coordinate) // set marker position to map center
      $('[name="lat"]').val(coordinate.lat())
      $('[name="lng"]').val(coordinate.lng())
    });
  }


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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=drawing" async defer></script>
@endpush