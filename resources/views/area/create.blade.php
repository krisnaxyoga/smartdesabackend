@extends('layouts.app')

@section('title')
Tambah Area
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
          <div class="box-header"><h3>Form Area</h3></div>
          <div class="box-divider m-0"></div>
          <form id="line-form" class="form-horizontal" action="/peta/area" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Nama Area</label>
                    <div class="col-lg-9">
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Kategori</label>
                    <div class="col-lg-9">
                      <select name="tipe_area_id" class="form-control">
                        <option value="">Pilih kategori...</option>
                        @foreach ($types as $type)
                          <option value="{{ $type->id }}" {{ old('tipe_area_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Deskripsi</label>
                    <div class="col-lg-9">
                      <textarea name="description" class="form-control" rows="8">{{ old('description') }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3">Gambar</label>
                    <div class="col-lg-9">
                      <input type="file" style="display: none" name="photo" accept="image/*" />
                      <p class="mb-1"><img src="/images/dummy-landscape.png" width="240" id="photo" /></p>
                      <button class="btn btn-primary" id="btn-browse" type="button"><i class="fa fa-folder-open"></i> Browse...</button>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3" for="enabled">Aktif</label>
                    <div class="col-lg-9">
                      <label class="ui-switch ui-switch-lg">
                        <input type="checkbox" name="enabled" id="enabled" {{ old('enabled') == 1 ? 'checked' : 'checked' }} value="1">
                        <i></i>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="col-form-label pt-0">Lokasi</label>
                    <input type="hidden" name="coordinates" value="{{ old('coordinates') }}" />
                    <div id="map" style="width: 100%; height: 480px"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-rounded btn-success"><i class="fa fa-save"></i> Simpan</button>
              <a href="/peta/area" class="btn btn-rounded btn-default">Batal</a>
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
    reader = new FileReader(),
    coordinates = {!! old('coordinates') ?: '[]' !!},
    polygonOptions = {
      strokeColor: "#FF0000",
      strokeWeight: 5,
      editable: true,
      fillColor: '#FF0000',
      fillOpacity: 0.35
    },
    map, drawingManager, selectedShape

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -8.644609, lng: 115.2046587},
      zoom: 15,
      styles: [
        {
          featureType: "poi",
          stylers: [
            { visibility: "off" }
          ]   
        }
      ]
    })

    if (coordinates.length > 0) {
      selectedShape = new google.maps.Polygon(polygonOptions)
      selectedShape.setPath(coordinates)
      selectedShape.setMap(map)
    }

    drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: false,
      polygonOptions
    })
    
    drawingManager.setMap(map)

    google.maps.event.addListener(drawingManager, 'polygoncomplete', function(e) {
      // Switch back to non-drawing mode after drawing a shape.
      drawingManager.setDrawingMode(null)

      let jsonCoordinates = JSON.stringify(e.getPath().getArray())
      $('input[name="coordinates"]').val(jsonCoordinates)

      google.maps.event.addListener(e, 'click', function() {
        selectedShape = e
      })
      selectedShape = e
    })

    let deleteShapeControl = document.createElement('div')

    createControl(deleteShapeControl, 'fa-trash', function () {
      selectedShape.setMap(null)
      drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON)
      $('input[name="coordinates"]').val('')
    })

    deleteShapeControl.index = 1
    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(deleteShapeControl)
  }
  
  function createControl(controlDiv, icon, callback) {
    // Set CSS for the control border.
    var controlUI = document.createElement('div')
    controlUI.style.backgroundColor = '#fff'
    controlUI.style.border = '2px solid #fff'
    controlUI.style.borderRadius = '3px'
    controlUI.style.boxShadow = '0 2px 4px rgba(0,0,0,.1)'
    controlUI.style.cursor = 'pointer'
    controlUI.style.marginBottom = '10px'
    controlUI.style.textAlign = 'center'
    controlUI.style.paddingLeft = '10px'
    controlUI.style.paddingRight = '10px'
    controlUI.style.marginRight = '10px'
    controlUI.style.width = '40px'
    controlDiv.appendChild(controlUI)

    // Set CSS for the control interior.
    var controlText = document.createElement('i')
    controlText.className = "fa " + icon
    controlText.style.fontSize = "18px"
    controlText.style.lineHeight = '36px'
    controlText.style.color = '#666666'
    controlUI.appendChild(controlText)

    // Setup the click event listeners: simply set the map to Chicago.
    if (typeof callback === 'function') {
      controlUI.addEventListener('click', callback)
    }
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