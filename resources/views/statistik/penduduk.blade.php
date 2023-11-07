@extends('layouts.app')

@section('title')
{{$page_title}}
@endsection

@section('content')
<div class="content-main" id="content-main">
    <div class="padding">
        <div class="row">

            <div class="col-md-3">

            @include('statistik.menu')

            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3>Data Kependudukan menurut {{$label}}</h3>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form action="">
                        
                        <div class="row">
                            <div class="col-md-7"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" name="indicator" value="{{$indikator}}">
                                    <select name="dusun" id="" class="form-control">
                                        <option value="ALL" >Semua</option>
                                        @foreach($dusun as $item) 
                                            <option value="{{$item->id}}" {{$dusun_id == $item->id ? 'selected' : ''}}>{{$item->dusun}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="width : 100%"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                        
                        <table class="table datatable table-bordered"> 
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center" colspan="2">Laki-Laki</th>
                                <th class="text-center" colspan="2">Perempuan</th>
                                <th class="text-center" colspan="2">Jumlah</th>
                            </tr>
                            <tbody>
                            @foreach($items['lists'] as $list)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$list['group']}}</td>
                                    <td class="text-right">{{$list['male']['count']}}</td>
                                    <td class="text-right">{{$list['male']['percent']}}%</td>
                                    <td class="text-right">{{$list['female']['count']}}</td>
                                    <td class="text-right">{{$list['female']['percent']}}%</td>
                                    <td class="text-right">{{$list['total']['count']}}</td>
                                    <td class="text-right">{{$list['total']['percent']}}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td></td>
                                    <td>JUMLAH</td>
                                    <td class="text-right">{{$items['subtotal']['male']['count']}}</td>
                                    <td class="text-right">{{$items['subtotal']['male']['percent']}}%</td>
                                    <td class="text-right">{{$items['subtotal']['female']['count']}}</td>
                                    <td class="text-right">{{$items['subtotal']['female']['percent']}}%</td>
                                    <td class="text-right">{{$items['subtotal']['count']}}</td>
                                    <td class="text-right">{{$items['subtotal']['percent']}}%</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>BELUM MENGISI</td>
                                    <td class="text-right">{{$items['empty']['male']['count']}}</td>
                                    <td class="text-right">{{$items['empty']['male']['percent']}}%</td>
                                    <td class="text-right">{{$items['empty']['female']['count']}}</td>
                                    <td class="text-right">{{$items['empty']['female']['percent']}}%</td>
                                    <td class="text-right">{{$items['empty']['count']}}</td>
                                    <td class="text-right">{{$items['empty']['percent']}}%</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>TOTAL</td>
                                    <td class="text-right">{{$items['total']['male']['count']}}</td>
                                    <td class="text-right">{{$items['total']['male']['percent']}}%</td>
                                    <td class="text-right">{{$items['total']['female']['count']}}</td>
                                    <td class="text-right">{{$items['total']['female']['percent']}}%</td>
                                    <td class="text-right">{{$items['total']['count']}}</td>
                                    <td class="text-right">100,0%</td>
                                </tr>

                            </tfoot>
                        </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $("select").select2()
</script>
@endpush