@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('action')
<a href="{{route('notification.create')}}" class="btn btn-rounded btn-success"><i class="fa fa-plus mr-2"></i> Tambah {{$page_title}}</a>
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="table-responsive">
            <table id="datatable" class="table v-middle p-0 m-0 box">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Judul</th>
                        <th>Konten</th>
                    </tr>
                </thead>

			</table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="/js/paging-input.js"></script>
<script type="text/javascript">
   let dataTable = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        ajax:"/notification?type=datatable",
        columns: [
            {data: 'action' ,orderable: false},
            {data: 'title'},
            {data: 'description'}
        ]
    });

    $(document).on('click', '.resend-item', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).data('url');
                var label = $(this).data('label');

                if (confirm('Apakah anda yakin ingin mengirim ulang '+label+' ini?')) {
                    $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: url,
                        data: {
                            "id": id,
                        }
                    }).then((data) => {
                        if (typeof data.message !== 'undefined') {
                            notie.alert({
                                text: data.message,
                                type: 'success'
                            })
                            $("#datatable").DataTable().ajax.reload();

                        }
                        $("#datatable").DataTable().ajax.reload();
                    })
                }
    });
</script>
@endpush
