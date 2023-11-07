<div class="modal fade" id="export-penduduk-modal" tabindex="-1" role="dialog" aria-labelledby="pendudukMapModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="pendudukMapModalLabel">Export Penduduk </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('penduduk/export') }}" method="POST" id="exportPenduduk" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Pilih Dusun</label>
                    <select name="dusun_id" id="" class="form-control">
                        <option value="ALL">- Semua Dusun -</option>
                        @foreach($listWilayah as $item)
                            <option value="{{$item->id}}">{{$item->dusun}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-spinner fa-spin" style="display: none"></i>
                    <span>Export</span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$('#exportPenduduk').on('submit', function () {
    $(this).find('[type="submit"]')
        .prop('disabled', true)
        .find('.fa')
        .show();
});

$(window).on('blur', function () {
    console.log('blur');

    $('#exportPenduduk').find('[type="submit"]')
        .prop('disabled', false)
        .find('.fa')
        .hide();
})
</script>
@endpush