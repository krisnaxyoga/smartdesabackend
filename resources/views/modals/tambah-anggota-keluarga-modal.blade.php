<div class="modal fade" id="tambah-anggota-keluarga-modal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Tambah Anggota Keluarga </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" id="frmTambahAnggotaKeluarga">
        <div class="modal-body">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>NIK</td>
                            <td>Nama</td>
                            <td>Hubungan</td>
                        </tr>
                    </thead>
                    <tbody id="bodyTable">
                        @foreach($keluarga->penduduk as $key => $list)
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td>{{$list->nik}}</td>
                                <td>{{$list->nama}}</td>
                                <td>{{$list->hubungan->nama}}</td>
                            </tr>
                        @endforeach
                    </tbody>
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
                <label for="">Penduduk</label>
                <div class="form-group">
                    <select name="penduduk_id" required id="" class="form-control">
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')

<script>

    let $tambahAnggotaKeluargaFrm = $("#frmTambahAnggotaKeluarga")

    let $idKK;
   
   let $dataKK


    function fillForm() {
        let res = $dataKK
    }

    $('#tambah-anggota-keluarga-modal').on('show.bs.modal', function (event) {
        $el = $(event.relatedTarget);
        $idKK = $el.data('id')
        console.log($idKK);
        $.ajax({
            url : "{{url('/')}}/penduduk-tanpa-kk",
            method : "GET"
        }).then(function(res){
            $("select[name=penduduk_id]").empty();
            $("select[name=penduduk_id]").append("<option></option>");
            
            $.each(res,function(a,b){
                $("select[name=penduduk_id]").append("<option value="+b.id+">"+b.nama+"</option>");
            });

            $("select[name=penduduk_id]").select2({
                width : '100%',
                placeholder : 'Pilih Penduduk...'
            });
            
        })
    });

 
    $tambahAnggotaKeluargaFrm.on('submit',function(e){
        e.preventDefault();
        e.stopPropagation();
        
        let self = $(this)
        $.ajax({
            url : "{{url('/')}}/keluarga/"+{{$keluarga->id}}+"/tambah-penduduk",
            method : 'POST',
            data : {
                _token : "{{csrf_token()}}",
                penduduk : self.find("[name=penduduk_id]").val(),
                kk_level : self.find("[name=kk_level]").val()
            }
        }).then(function(res){
            if(res.error === false) 
                window.location.reload()
        });
    });

    $("select[name=kk_level]").select2({
        placeholder : "Pilih Kelas Sosial...",
        minimumResultsForSearch : -1,
        width : '100%',
        allowClear: true 
    })
</script>

@endpush