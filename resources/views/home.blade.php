@extends('layouts.app')
@section('title')
Dashboard
@endsection
    @section('content')
        <div class="content-header bg-dashboard-content-header box-shadow-2" id="content-header">
            <div class="navbar navbar-expand-lg">
                <div class="navbar-text nav-title flex page-title-dashboard">Dashboard</div>
            </div>
            <div class="container">
                <div class="content-desc">
                    <div class="row">
                        <div class="col-md-3 border-content-desc">
                            <div class="content-desc-dashboard">
                                <span class="content-desc-title">Jumlah Penduduk</span>
                                <h1 class="content-desc-count">{{number_format($jml_penduduk, 0, ',', '.')}}</h1>
                            </div>
                            
                        </div>
                        <div class="col-md-3 border-content-desc">
                            <div class="content-desc-dashboard">
                                <span class="content-desc-title">Jumlah Keluarga</span>
                                <h1 class="content-desc-count">{{number_format($jml_keluarga, 0, ',', '.')}}</h1>
                            </div>
                            
                        </div>
                        <div class="col-md-3 border-content-desc">
                            <div class="content-desc-dashboard">
                                <span class="content-desc-title">Jumlah Penduduk Pendatang</span>
                                <h1 class="content-desc-count">{{number_format($jml_duktang, 0, ',', '.')}}</h1>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="content-desc-dashboard">
                                <span class="content-desc-title">Jumlah Surat Tercetak</span>
                                <h1 class="content-desc-count">{{number_format($jml_surat, 0, ',', '.')}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="content-main" id="content-main">
                <div>

                <div class="padding">

                        <div class="row">


                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header">
                                        <h3><i class="fa fa-line-chart"></i> Grafik Jumlah Penduduk Per Dusun</h3>
                                    </div>
                                    <div class="box-body">
                                        <canvas id="chart-dusun" data-plugin="chart" height="150">
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header">
                                        <h3><i class="fa fa-line-chart"></i> Grafik Jumlah Penduduk Menurut Pekerjaan</h3>
                                    </div>
                                    <div class="box-body">
                                        <canvas id="chart-pekerjaan" data-plugin="chart" height="150">
                                        </canvas>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="row">


                           <div class="col-md-6">
                               <div class="box">
                                   <div class="box-header">
                                       <h3><i class="fa fa-line-chart"></i> Grafik Rasio Jenis Kelamin Penduduk Per Dusun</h3>
                                   </div>
                                   <div class="box-body">
                                       <canvas id="chart-rasio-dusun" data-plugin="chart" height="150">
                                       </canvas>
                                   </div>
                               </div>
                           </div>

                           <div class="col-md-6">
                               <div class="box">
                                   <div class="box-header">
                                       <h3><i class="fa fa-line-chart"></i> Grafik Jumlah Penduduk Menurut Status Kawin</h3>
                                   </div>
                                   <div class="box-body">
                                       <canvas id="chart-kawin" data-plugin="chart" height="150">
                                       </canvas>
                                   </div>
                               </div>
                           </div>



                       </div>

                       <div class="row">


                           <div class="col-md-6">
                               <div class="box">
                                   <div class="box-header">
                                       <h3><i class="fa fa-line-chart"></i> Grafik Jumlah Penduduk Menurut Agama</h3>
                                   </div>
                                   <div class="box-body">
                                       <canvas id="chart-agama" data-plugin="chart" height="150">
                                       </canvas>
                                   </div>
                               </div>
                           </div>

                           <div class="col-md-6">
                               <div class="box">
                                   <div class="box-header">
                                       <h3><i class="fa fa-line-chart"></i> Grafik Jumlah Penduduk Menurut Kewarganegaraan</h3>
                                   </div>
                                   <div class="box-body">
                                       <canvas id="chart-warganegara" data-plugin="chart" height="150">
                                       </canvas>
                                   </div>
                               </div>
                           </div>



                       </div>


                    </div>
                </div>
            </div>

            @endsection

@push('scripts')
<script type="text/javascript">


var callbacks = {
        label: function(tooltipItem, data) {

            var label = data.labels[tooltipItem.index];


        	var dataset = data.datasets[tooltipItem.datasetIndex];
          var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
            return parseInt(previousValue) + parseInt(currentValue);
          });
          var currentValue = dataset.data[tooltipItem.index];
          var percentage = Math.floor(((currentValue/total) * 100)+0.5);
          return label+": "+currentValue+" ("+percentage + "%)";
        }
    };

 @if(isset($chart_dusun['labels']))
                    $('#chart-dusun').chart(
                            {
                                type: 'bar',
                                data: {
                                    labels: [<?php echo '"'.implode('","', $chart_dusun['labels']).'"' ?>],
            datasets: [
                {
                    label: 'Jumlah Penduduk',
                    data: [<?php echo '"'.implode('","', $chart_dusun['values']).'"' ?>],
                    fill: true,
                    backgroundColor: hexToRGB("#00bcd4", 0.8),
                    borderColor: "#00bcd4",
                    borderWidth: 2
                }
            ]
                                },
                                options: {
                                    tooltips: { callbacks: callbacks },
                                    stacked: true
                                }
                            }
                            );
@endif


 @if(isset($chart_pekerjaan['labels']))
                    $('#chart-pekerjaan').chart(
                            {
                                type: 'doughnut',
                                data: {
                                    labels: [<?php echo '"'.implode('","', $chart_pekerjaan['labels']).'"' ?>],
            datasets: [
                {
                    label: 'Jumlah Penduduk',
                    data: [<?php echo '"'.implode('","', $chart_pekerjaan['values']).'"' ?>],
                    borderColor: 'transparent',
                    backgroundColor: ["#ffeb3b","#2196f3", "#8bc34a", "#673ab7", "#e91e63"],
                }
            ]
                                },
                                options: {

                                tooltips: { callbacks: callbacks },
                                legend: {
                                    labels:{
                                    boxWidth: 12
                                    }
                                }
                                },
                            }
                            );
@endif



@if(isset($chart_kawin['labels']))
                    $('#chart-kawin').chart(
                            {
                                type: 'doughnut',
                                data: {
                                    labels: [<?php echo '"'.implode('","', $chart_kawin['labels']).'"' ?>],
            datasets: [
                {
                    label: 'Jumlah Penduduk',
                    data: [<?php echo '"'.implode('","', $chart_kawin['values']).'"' ?>],
                    borderColor: 'transparent',
                    backgroundColor: ["#ffeb3b","#2196f3", "#8bc34a", "#673ab7", "#e91e63"],
                }
            ]
                                },
                                options: {

                                tooltips: { callbacks: callbacks },
                                legend: {
                                    position: "right",
                                    labels:{
                                    boxWidth: 12
                                    }
                                }
                                },
                            }
                            );
@endif


 @if(isset($chart_rasio_dusun['labels']))
                    $('#chart-rasio-dusun').chart(
                            {
                                type: 'bar',
                                data: {
                                    labels: [<?php echo '"'.implode('","', $chart_rasio_dusun['labels']).'"' ?>],
            datasets: [
                {
                    label: 'Laki-Laki',
                    data: [<?php echo '"'.implode('","', $chart_rasio_dusun['values_laki']).'"' ?>],
                    fill: true,
                    backgroundColor: hexToRGB("#cddc39", 0.8),
                    borderColor: "#cddc39",
                    borderWidth: 2
                },
                {
                    label: 'Perempuan',
                    data: [<?php echo '"'.implode('","', $chart_rasio_dusun['values_perempuan']).'"' ?>],
                    fill: true,
                    backgroundColor: hexToRGB("#e91e63", 0.8),
                    borderColor: "#e91e63",
                    borderWidth: 2,
                }
            ]
                                },
                                options: {
                                    stacked: true
                                },

                            }
                            );
@endif


@if(isset($chart_agama['labels']))
                    $('#chart-agama').chart(
                            {
                                type: 'doughnut',
                                data: {
                                    labels: [<?php echo '"'.implode('","', $chart_agama['labels']).'"' ?>],
            datasets: [
                {
                    label: 'Jumlah Penduduk',
                    data: [<?php echo '"'.implode('","', $chart_agama['values']).'"' ?>],
                    borderColor: 'transparent',
                    backgroundColor: ["#e91e63","#009688","#ffeb3b", "#2196f3", "#8bc34a",  "#ff5722", "#673ab7"],
                }
            ]
                                },
                                options: {

                                tooltips: { callbacks: callbacks },
                                legend: {
                                    position: "right",
                                    labels:{
                                    boxWidth: 12
                                    }
                                }
                                },
                            }
                            );
@endif


@if(isset($chart_warganegara['labels']))
                    $('#chart-warganegara').chart(
                            {
                                type: 'doughnut',
                                data: {
                                    labels: [<?php echo '"'.implode('","', $chart_warganegara['labels']).'"' ?>],
            datasets: [
                {
                    label: 'Jumlah Penduduk',
                    data: [<?php echo '"'.implode('","', $chart_warganegara['values']).'"' ?>],
                    borderColor: 'transparent',
                    backgroundColor: ["#009688","#ffeb3b", "#e91e63","#2196f3", "#8bc34a",  "#ff5722", "#673ab7"],
                }
            ]
                                },
                                options: {

                                tooltips: { callbacks: callbacks },
                                legend: {
                                    position: "right",
                                    labels:{
                                    boxWidth: 12
                                    }
                                }
                                },
                            }
                            );
@endif

</script>
@endpush
