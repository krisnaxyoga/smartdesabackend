<div class="modal fade" id="edit-kk-modal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Edit KK </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frmEditPdk">
        <div class="modal-body">

                <table class="table">
                        <tr>
                            <td>NIK</td>
                            <td>: <span id="nik"></span></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <span id="nama"></span></td>
                        </tr>
                </table>
                <hr>
                <label for="">Hubungan</label>
                <div class="form-group">
                    <select name="kk_level" required id="" class="form-control">
                        <option></option>
                        @foreach($hubungan as $list)
                            <option value="{{$list->id}}">{{$list->nama}}</option>
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

  $("select[name=kk_level]").select2({
        placeholder : "Pilih Kelas Sosial...",
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

    $('#edit-kk-modal').on('show.bs.modal', function (event) {
        $el = $(event.relatedTarget);
        $idPenduduk = $el.data('id')
        $.ajax({
            url : "{{url('/')}}/penduduk/"+$idPenduduk+"/json",
            method : 'GET',

        }).then(function(res){
            $dataPenduduk = res;
            $("#nama").text(res.nama);
            $("#nik").text(res.nik)
            $("[name=kk_level]").val(res.kk_level).trigger('change')
        });
    });

 
    $pendudukHubunganFrm.on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();
        
        let self = $(this)
        $.ajax({
            url : "{{url('/')}}/penduduk/"+$idPenduduk+"/updateJson",
            method : 'POST',
            data : {
                _token : "{{csrf_token()}}",
                kk_level : self.find('[name=kk_level]').val(),
            }
        }).then(function(res){
            if(res.error === false) {
                window.location.reload();
            }
        });
    });
</script>

@endpush