@extends('layouts.app')

@section('title')
Peta
@endsection

@section('content')
<div class="content-main" id="content-main">
  <div id="citizen-map"></div>
  <div id="search-template" style="display: none">
    <div class="box" style="margin-left: 10px; margin-top: 10px; width: 280px">
      <div class="b-b nav-active-bg box-header" style="padding-bottom: 0">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab-citizen">Cari Penduduk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-filter">Filter</a>
          </li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane active" id="tab-citizen">
          <form class="form" id="search-form">
            <div class="box-body">
              <div class="form-group">
                <label class="control-label">Status Penduduk</label>
                <select name="status" class="form-control">
                  <option value="0">Semua Status</option>
                  @foreach ($statuses as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Jenis Kelamin</label>
                <select name="sex" class="form-control">
                  <option value="0">Semua Jenis Kelamin</option>
                  @foreach ($sexes as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Dusun</label>
                <select name="region" class="form-control">
                  <option value="0">Semua Dusun</option>
                  @foreach ($regions as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->dusun }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Nama Penduduk</label>
                <input type="text" name="name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label">NIK</label>
                <input type="text" name="nik" maxlength="20" class="form-control" />
              </div>
            </div>
            <div class="box-footer text-right">
              <button type="submit" :disabled="searching" class="btn btn-primary"><i :class="['fa', {'fa-search': !searching}, {'fa-spin fa-spinner': searching}]"></i>&nbsp;&nbsp;CARI DATA</button>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="tab-filter">
          <form class="form" id="legend-form">
            <div class="box-body">
              <div class="form-group">
                <label class="ui-check ui-check-md mb-0">
                  <input type="checkbox" name="citizens">
                  <i class="dark-white" style="margin-right: 24px"></i>
                  <span>Penduduk</span>
                </label>
              </div>
              <div class="form-group">
                <label class="ui-check ui-check-md mb-0">
                  <input type="checkbox" name="areas" checked>
                  <i class="dark-white" style="margin-right: 24px"></i>
                  <span>Area</span>
                </label>
              </div>
              <div class="form-group">
                <label class="ui-check ui-check-md mb-0">
                  <input type="checkbox" name="lines" checked>
                  <i class="dark-white" style="margin-right: 24px"></i>
                  <span>Garis</span>
                </label>
              </div>
              <div class="form-group">
                <label class="ui-check ui-check-md mb-0">
                  <input type="checkbox" name="locations" checked>
                  <i class="dark-white" style="margin-right: 24px"></i>
                  <span>Lokasi/Properti Desa</span>
                </label>
              </div>
            </div>
            <div class="box-footer text-right">
              <button type="submit" :disabled="searching" class="btn btn-primary"><i :class="['fa', {'fa-search': !searching}, {'fa-spin fa-spinner': searching}]"></i> FILTER</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<style>
  #content-main,
  #citizen-map {
    width: 100%;
    height: 100%;
  }
</style>
<script type="text/javascript">
  let map = null,
    vm = new Vue({
      data: {
        init: false,
        searching: false,
        search: {
          show: false,
          status: 0,
          sex: 0,
          region: 0,
          name: null,
          nik: null,
        },
        show: {
          citizens: false,
          areas: true,
          lines: true,
          locations: true
        },
        citizens: [],
        areas: [],
        lines: [],
        locations: [],
        citizenMarkers: [],
        infoWindow: null
      },
      methods: {
        citizenInfo(index) {
          let citizen = this.citizens[index],
            marker = this.citizenMarkers[index],
            content = '<table width="480"> \
              <tr> \
                <td width="25%" valign="top" style="padding-right: 15px"> \
                  <img src="' + (citizen.foto == null || citizen.foto == '' ? '/images/Dummy.jpg' : citizen.foto) + '" width="100%" /> \
                </td> \
                <td> \
                  <table class="table table-bordered"> \
                    <tr> \
                      <td style="font-weight: bold">Nama</td> \
                      <td>' + citizen.nama + '</td> \
                    </tr> \
                    <tr> \
                      <td style="font-weight: bold">NIK</td> \
                      <td>' + citizen.nik + '</td> \
                    </tr> \
                    <tr> \
                      <td style="font-weight: bold">Alamat</td> \
                      <td>' + citizen.alamat_sekarang + '</td> \
                    </tr> \
                    <tr> \
                      <td style="font-weight: bold">Dusun</td> \
                      <td>' + citizen.dusun + '</td> \
                    </tr> \
                  </table> \
                  <a target="_blank" href="/penduduk/' + citizen.id + '" class="btn btn-primary">KLIK DETAIL</a> \
                </td> \
              </tr> \
            </table>'

          this.infoWindow.close()
          this.infoWindow.setContent(content)
          this.infoWindow.open(map, marker)
        },
        locationInfo(index) {
          let location = this.locations[index],
            marker = location.object,
            content = '<table width="480"> \
              <tr> \
                <td width="25%" valign="top" style="padding-right: 15px"> \
                  <img src="' + (location.photo == null || location.photo == '' ? '/images/dummy-landscape.png' : location.photo) + '" width="100%" /> \
                </td> \
                <td valign="top"> \
                  <h5>' + location.name + '</h5> \
                  <div>' + (location.description == null ? '-' : location.description) + '</div> \
                </td> \
              </tr> \
            </table>'

          this.infoWindow.close()
          this.infoWindow.setContent(content)
          this.infoWindow.open(map, marker)
        },
        control(controlDiv, icon, callback) {
          // Set CSS for the control border.
          var controlUI = document.createElement('div')
          controlUI.style.backgroundColor = '#fff'
          controlUI.style.border = '2px solid #fff'
          controlUI.style.borderRadius = '3px'
          controlUI.style.boxShadow = '0 2px 4px rgba(0,0,0,.1)'
          controlUI.style.cursor = 'pointer'
          controlUI.style.marginBottom = '10px'
          controlUI.style.textAlign = 'center'
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
        },
        loadCitizens($event) {
          let self = this

          // Set searching flag to true.
          self.searching = true

          $.ajax({
            url: '/peta/filter',
            data: self.search
          })
          .then((response) => {
            self.citizenMarkers.forEach((item, index) => {
              item.setMap(null)
            })
            self.citizenMarkers = []
            self.citizens = response

            response.forEach((item, index) => {
              let marker = new google.maps.Marker({
                position: {lat: parseFloat(item.lat), lng: parseFloat(item.lng)},
                icon: '/images/markers/male-2.png',
                title: item.nama
              })

              if (this.show.citizens) {
                marker.setMap(map)
              }

              marker.addListener('click', () => {
                console.log(self)
                self.citizenInfo(index)
              })

              self.citizenMarkers.push(marker)
            })

            $('#search-modal').modal('hide')
          }, function (xhr) {
            // Show errors if present.
          })
          .always(() => {
            // Set searching flag to false.
            self.searching = false
          })
        },
        loadAreas() {
          $.ajax({
            url: '/peta/area',
            data: { type: 'json' }
          })
          .then((response) => {
            response.forEach((item, index) => {
              let object = new google.maps.Polygon({
                path: item.coordinates,
                strokeColor: item.tipe_area !== null ? '#' + item.tipe_area.color : '#000',
                fillColor: item.tipe_area !== null ? '#' + item.tipe_area.color : '#000',
                fillOpacity: 0.35
              })

              if (this.show.areas) {
                object.setMap(map)
              }

              response[index]['object'] = object
            })

            this.areas = response
          }, (xhr) => {

          })
        },
        loadLines() {
          $.ajax({
            url: '/peta/garis',
            data: { type: 'json' }
          })
          .then((response) => {
            response.forEach((item, index) => {
              let object = new google.maps.Polyline({
                path: item.coordinates,
                strokeColor: item.tipe_garis !== null ? '#' + item.tipe_garis.color : '#000',
              })

              object.setMap(map)

              response[index]['object'] = object
            })

            this.areas = response
          }, (xhr) => {

          })
        },
        loadLocations() {
          $.ajax({
            url: '/peta/lokasi',
            data: { type: 'json' }
          })
          .then((response) => {
            response.forEach((item, index) => {
              let object = new google.maps.Marker({
                position: {lat: item.lat, lng: item.lng},
                animation: google.maps.Animation.DROP,
              })

              if (item.tipe_lokasi.icon !== null) {
                let iconPath = item.tipe_lokasi.icon

                if (!item.tipe_lokasi.icon.includes('https://')) {
                  iconPath = '/images/markers/' + item.tipe_lokasi.icon
                }

                object.setIcon(iconPath)
              }

              object.setMap(map)
              object.addListener('click', () => {
                this.locationInfo(index)
              })

              response[index]['object'] = object
            })

            this.locations = response
          }, (xhr) => {

          })
        },
        filterLegends() {
          this.citizenMarkers.forEach((item, index) => {
            item.setMap(this.show.citizens ? map : null)
          })

          this.lines.forEach((item, index) => {
            item.object.setMap(this.show.lines ? map : null)
          })

          this.areas.forEach((item, index) => {
            item.object.setMap(this.show.areas ? map : null)
          })

          this.locations.forEach((item, index) => {
            item.object.setMap(this.show.locations ? map : null)
          })
        },
        isURL(str) {
          var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name and extension
          '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
          '(\\:\\d+)?'+ // port
          '(\\/[-a-z\\d%@_.~+&:]*)*'+ // path
          '(\\?[;&a-z\\d%@_.,~+&:=-]*)?'+ // query string
          '(\\#[-a-z\\d_]*)?$','i'); // fragment locator

          return pattern.test(str)
        }
      },
      mounted() {
        let self = this,
          $self = $(this.$el)

        map = new google.maps.Map(document.getElementById('citizen-map'), {
          mapTypeControl: false,
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

        // Create the DIV to hold the control and call the rightControl()
        // constructor passing in this DIV.
        let searchTemplate = $(this.$el).find('#search-template').html(),
          searchControl = document.createElement('div')

        searchControl.innerHTML = searchTemplate
        searchControl.style.zIndex = 100000
        $('#search-template').remove()

        // Search villagers.
        $(searchControl).find('#search-form').on('submit', function (e) {
          e.preventDefault()

          let values = $(this).serializeArray()

          values.forEach((item, index) => {
            self.search[item.name] = item.value
          })

          self.loadCitizens()
        })

        // Filter legends.
        $(searchControl).find('#legend-form').on('submit', function (e) {
          e.preventDefault()

          let values = $(this).serializeArray()

          self.show.citizens = (typeof values.find(x => x.name == 'citizens') !== 'undefined')
          self.show.areas = (typeof values.find(x => x.name == 'areas') !== 'undefined')
          self.show.lines = (typeof values.find(x => x.name == 'lines') !== 'undefined')
          self.show.locations = (typeof values.find(x => x.name == 'locations') !== 'undefined')

          self.filterLegends()
        })

        map.controls[google.maps.ControlPosition.LEFT_TOP].push(searchControl)

        if (window.outerWidth <= 414) {
          let mobileControl = document.createElement('div')

          $(searchControl).hide()

          this.control(mobileControl, 'fa-bars', () => {
            self.search.show = !self.search.show
            searchControl.style.display = (self.search.show ? "block" : "none")
          })

          map.controls[google.maps.ControlPosition.RIGHT_TOP].push(mobileControl)
        }

        // Init info window.
        this.infoWindow = new google.maps.InfoWindow({ maxWidth: 480 })

        // Load legends.
        this.loadCitizens()
        this.loadLocations()
        this.loadAreas()
        this.loadLines()
      }
    })

  function initMap() {
    vm.$mount('#content-main')
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endpush
