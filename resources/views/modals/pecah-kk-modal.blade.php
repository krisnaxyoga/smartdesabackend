<div class="modal fade" id="pecah-kk-modal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel"><i class="fa fa-warning"></i> Konfirmasi </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frmEdit">
        <div class="modal-body">
                <p>Apakah anda yakin ingin memecah data keluarga ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Pecah</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')

<script>

    let $kkFrm = $("#frmEdit")

    let $id;
   
   let $data



    $('#pecah-kk-modal').on('show.bs.modal', function (event) {
        $el = $(event.relatedTarget);
        $id = $el.data('id')
        console.log($id);
    });

 
    $kkFrm.on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();
        
        let self = $(this)
        $.ajax({
            url : "{{url('/')}}/penduduk/"+$id+"/pecah-kk",
            method : 'POST',
            data : {
                _token : "{{csrf_token()}}"
            }
        }).then(function(res){
            if(res.error === false) {
                window.location.reload();
            }
        });
    });
</script>

@endpush