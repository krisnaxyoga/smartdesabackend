@extends('layouts.app')

@section('title')
Edit CCTV: {{ $data->nama_cctv }}
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
          <div class="box-header"><h3>Data CCTV</h3></div>
          <div class="box-divider m-0"></div>
          <form class="form-horizontal" action="/cctv/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="lat" value="{{ old('lat') ?: $data->lat }}" />
            <input type="hidden" name="lng" value="{{ old('lng') ?: $data->lng }}" />
            <div class="box-body">
              <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                      <label class="col-form-label col-lg-3">Nama CCTV</label>
                      <div class="col-lg-9">
                        <input type="text" name="nama_cctv" class="form-control" value="{{ $data->nama_cctv }}" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-3">Link CCTV</label>
                      <div class="col-lg-9">
                        <input type="text" name="link" class="form-control" value="{{ $data->link }}" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-3">Keterangan</label>
                      <div class="col-lg-9">
                        <textarea name="description" class="form-control" rows="8">{{ $data->keterangan }}</textarea>
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
              <a href="/cctv" class="btn btn-rounded btn-default">Batal</a>
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
