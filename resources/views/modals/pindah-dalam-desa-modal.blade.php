<div class="modal fade" id="pindah-dalam-desa-modal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Ubah/Pindah Alamat Penduduk Lepas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frmEditPdk">

        <div class="modal-body error" style="display : block">
            <p class="text-danger">
                    Penduduk ini anggota keluarga, bukan penduduk lepas, dan tidak bisa dipindahkan perorangan. Keluarga penduduk ini dapat dipindahkan pada modul Keluarga.
            </p>
        </div>
        <div class="modal-body bio" style="display : none">

                <table class="table">
                        <tr>
                            <td>Nama / NIK</td>
                            <td>: <span id="nik"></span></td>
                        </tr>
                        <tr>
                            <td>Tempat/Tanggal Lahir</td>
                            <td>: <span id="ttl"></span></td>
                        </tr>
                        <tr>
                            <td>Alamat Sekarang</td>
                            <td>: <span id="alamat"></span></td>
                        </tr>
                </table>
                <hr>
                <div class="form-group">
                    <label for="">Alamat Baru</label>
                    <input type="text" class="form-control" name="alamat_sekarang">
                </div>
                <div class="form-group">
                    <label for="">Dusun</label>
                    <select name="dusun_id" id="" class="form-control">
                        <option></option>
                        @foreach($listWilayah as $item)
                            <option value="{{$item->id}}">{{$item->dusun}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')

<script>

    let $pendudukHubunganFrm = $("#frmEditPdk")

    let $idPenduduk;
   
   let $dataPenduduk

  $("select[name=dusun_id]").select2({
        placeholder : "Pilih Dusun...",
        minimumResultsForSearch : -1,
        width : '100%',
        allowClear: true 
    })
    function fillForm(res) {        
        console.log(res)
        $("#nama").text(res.nama);
        $("#nik").text(res.nik)
        $("[name=kk_level]").val(res.kk_level).trigger('change')
    }

    $('#pindah-dalam-desa-modal').on('show.bs.modal', function (event) {
        $el = $(event.relatedTarget);
        $idPenduduk = $el.data('id')
        $.ajax({
            url : "{{url('/')}}/api/penduduk/"+$idPenduduk+"/checkPendudukKK",
            method : 'GET',

        }).then(function(res){
            // console.log(res);
            if(res.error) {
                $(".error").show();
                $(".bio").hide();
            } else {
                $(".error").hide();
                $(".bio").show();
                
                $("#nik").text(res.data.nama + " / " + res.data.nik)
                $("#ttl").text(res.data.tempatlahir + " / " + res.data.tanggallahir)
                $("#alamat").text(res.data.alamat_sekarang)
            }
            // $dataPenduduk = res;
            // $("#nama").text(res.nama);
            // $("#nik").text(res.nik)
            // $("[name=kk_level]").val(res.kk_level).trigger('change')
        });
    });

 
    $pendudukHubunganFrm.on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();
        
        let self = $(this)
        $.ajax({
            url : "{{url('/')}}/api/penduduk/"+$idPenduduk+"/update-pindah-dalam-desa",
            method : 'POST',
            data : {
                _token : "{{csrf_token()}}",
                dusun_id : self.find('[name=dusun_id]').val(),
                alamat_sekarang : self.find('[name=alamat_sekarang]').val(),
            }
        }).then(function(res){
            if(res.error === false) {
                window.location.reload();
            }
        });
    });
</script>

@endpush