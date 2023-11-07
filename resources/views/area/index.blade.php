@extends('layouts.app')

@section('title')
Area
@endsection

@section('action')
  <a href="/peta/area/create" class="btn btn-rounded btn-success"><i class="fa fa-plus"></i> Tambah Area</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul style="margin-bottom:0px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <a class="close" data-dismiss="alert">&times;</a>
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
    <div class="table-responsive">
      <table id="datatable" class="table v-middle p-0 m-0 box dataTable no-footer">
        <thead>
          <tr>
            <th width="30"></th>
            <th>Nama Area</th>
            <th>Kategori</th>
            <th width="100">Area</th>
            <th width="30">Aktif</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="line-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Area</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="map" style="width: 100%; height: 480px" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  let polygon,
    dataTable = $("#datatable").DataTable({
      ajax: "/peta/area?type=datatable",
      processing: true,
      serverSide : true,
      lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "Semua baris"]],
      order: [[ 1, "asc" ]],
      columns: [
        { data: "action", name: "action", orderable: false, searchable: false },
        { data: "name", name: "name" },
        { 
          data: (data) => {
            if (data.tipe_area !== null) {
              return data.tipe_area.name
            }
            return '-'
          }, 
          name: "tipe_area_id"
        },
        {
          data: "coordinates",
          name: "coordinates",
          orderable: false,
          searchable: false,
          render: (data, type, row) => {
            return '<button class="btn btn-rounded btn-primary btn-view-map" data-target="#line-modal" data-toggle="modal"><i class="fa fa-map"></i> Lihat Area</button>'
          }
        },
        { 
          data: "enabled",
          name: "enabled",
          class: "text-center",
          orderable: false,
          searchable: false,
          render: (data) => {
            let span = '<i class="text-'
            span += (data ? 'success fa fa-check">' : 'danger fa fa-remove">')
            span += '</i>'

            return span
          }
        },
      ]
    })

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
  }

  $('#line-modal').on('show.bs.modal', function (e) {
    let row = $(e.relatedTarget).closest('tr'),
      bounds = new google.maps.LatLngBounds(),
      data = dataTable.row(row).data(),
      path = data.coordinates.map((v) => {
        return {
          lat: parseFloat(v.lat),
          lng: parseFloat(v.lng)
        };
      })

    // Reset the previous line.
    if (typeof polygon !== 'undefined') {
      polygon.setMap(null)
    }

    polygon = new google.maps.Polygon({
      path,
      strokeColor: `#${data.tipe_area.color}`,
      fillColor: `#${data.tipe_area.color}`,
      strokeWeight: 3,
      fillOpacity: 0.35
    })

    polygon.setMap(map)

    path.forEach((element, i) => {
      bounds.extend(element)
    })

    // The Center of the Bermuda Triangle - (25.3939245, -72.473816)
    map.setCenter(bounds.getCenter())
  })
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endpush