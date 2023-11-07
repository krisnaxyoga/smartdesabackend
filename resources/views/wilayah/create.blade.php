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
                        <h3>Form Wilayah</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form method="POST" action="{{ url('wilayah') }}">
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
                                    <label>Nama Dusun</label>
                                    <input name="dusun" required type="text" class="form-control m-input" placeholder="Nama Dusun" value="{{ old('dusun') }}">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Lokasi</label>
                                    <input type="hidden" name="coordinates" value="{{ old('coordinates') }}" />
                                    <div id="map" style="width: 100%; height: 480px"></div>
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url('wilayah') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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