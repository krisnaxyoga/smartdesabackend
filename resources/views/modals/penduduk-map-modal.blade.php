<div class="modal fade" id="pendudukMapModal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Pilih Lokasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">

                <label for="check">
    
                    <input type="checkbox" name="apply_coordinate" id="check" > Tambahkan Koordinat
                </label>
            </div>
            <div class="penduduk-map-container">
                <div id="pendudukMap" style="width : 100%;height : 300px"></div>
             
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="getLocation()">Simpan Koordinat</button>
        </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
    let map,marker;
    
        $("#check").on('change',function(){
            if($(this).is(':checked')) {
                $("#use_map").val("1")
            } else {
                $("#use_map").val("0")
            }
        });

    function initMap() {
        let latitude = {{isset($penduduk) ? ((count($penduduk->penduduk_map) != 0 ? $penduduk->penduduk_map[0]->lat : false) ? : -8.644609): -8.644609}}
        let longitude = {{isset($penduduk) ? ((count($penduduk->penduduk_map) != 0 ? $penduduk->penduduk_map[0]->lng : false) ? : 115.2046587): 115.2046587}}
        center = {lat: latitude, lng: longitude};

        map = new google.maps.Map(document.getElementById('pendudukMap'), {
          center: center,
          zoom: 15
        });

        marker = new google.maps.Marker({
                    map:map,
                    draggable:true,
                    position: center
                });
    }

    function getLocation(){
        let lat = marker.getPosition().lat();
        let lng = marker.getPosition().lng();

        $(".address-coordinate[name=lat]").val(lat)
        $(".address-coordinate[name=lng]").val(lng)

        $("#pendudukMapModal").modal('hide')
    }

    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
        </script>
@endpush