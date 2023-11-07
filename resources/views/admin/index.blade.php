
@extends('layouts.app')           
@section('content')




<div class="content-main" id="content-main" >
   <div class="padding">

        <div class="row">
         <div class="col-md-9">
            <h4 class="mb-4">Dashboard</h4>
        </div>

        <div class="col-md-3">
      
        </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h1>Ini Home Admin</h1>                
            </div>
        </div>
   
   </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

var stat_revenues;
var chart = null, chartCountry=null, chartCustomer=null, chartProduct;

$(document).ready(function() {
var m = new Date().getMonth();
$('#month option')[m].selected = true;
$('#month').trigger('change')
})

$('#month').on('change', function(e) {
var element = $(this).find('option:selected'); 
var month = element.attr("data-month"); 
var year = element.attr("data-year"); 

console.log(element)

loadData(month, year);
loadCountry(month, year);
loadCustomer(month, year);
loadProduct(month, year);
})

function loadData(month, year) {
$.ajax({
url: '{{url("stat/revenue")}}?year='+year+'&month='+month,
cache: true,
success: function (res) {
    console.log(res)
    if(chart==null) {
        setupChart(res);
    } else {
        //removeData(chart);
        chart.data.labels = res.labels;
        chart.data.datasets[0].data = res.values;
        /*
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(res.values);
        });
        */
        chart.update();

        console.log(chart.data.datasets[0])
    }
    
}
});
}

function loadCountry(month, year) {
$.ajax({
url: '{{url("stat/country")}}?limit=5&year='+year+'&month='+month,
cache: true,
success: function (result) {
    console.log(result)
    if(chartCountry==null) {
        setupChartCountry(result);
    } else {
        chartCountry.data.labels = result.labels;
        chartCountry.data.datasets[0].data = result.values;
        chartCountry.update();
    }
    
}
});
}

function loadCustomer(month, year) {
$.ajax({
url: '{{url("stat/customer")}}?limit=3&year='+year+'&month='+month,
cache: true,
success: function (result) {
    console.log(result)
    if(chartCustomer==null) {
        setupChartCustomer(result);
    } else {
        chartCustomer.data.labels = result.labels;
        chartCustomer.data.datasets[0].data = result.values;
        chartCustomer.update();
    }
    
}
});
}

function loadProduct(month, year) {
$.ajax({
url: '{{url("stat/product")}}?limit=3&year='+year+'&month='+month,
cache: true,
success: function (result) {
    console.log(result)
    if(chartProduct==null) {
        setupChartProduct(result);
    } else {
        chartProduct.data.labels = result.labels;
        chartProduct.data.datasets[0].data = result.values;
        chartProduct.update();
    }
    
}
});
}

function setupChart(data) {
chart = new Chart($('#chart-revenue'),
{
type: 'line',
data: {
labels: data.labels,
datasets: [
    {
        label: 'Sales',
        data: data.values,
        fill: true,
        lineTension: 0.4,
        backgroundColor: hexToRGB(app.color.primary, 0.2),
        borderColor: app.color.primary,
        borderWidth: 2,
        borderCapStyle: 'butt',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'miter',
        pointBorderColor: app.color.primary,
        pointBackgroundColor: '#fff',
        pointBorderWidth: 2,
        pointHoverRadius: 4,
        pointHoverBackgroundColor: app.color.primary,
        pointHoverBorderColor: '#fff',
        pointHoverBorderWidth: 2,
        pointRadius: 4,
        pointHitRadius: 10,
        spanGaps: false
    }
]
},
options: {
}
}
);

}

function setupChartCountry(data) {


chartCountry = new Chart($('#chart-country'),
{
type: 'doughnut',
data: {
labels: data.labels,
datasets: [
  {
      data: data.values,
      borderColor: 'transparent',
      backgroundColor: ['#AEEA00', '#FFAB00', '#00B8D4','#AD1457'],
      label: 'Trafic'
  }
]
},
options: {
legend: {
position: 'left',
labels:{
  boxWidth: 12
}
},
cutoutPercentage: 75
}
}
);

}

function setupChartCustomer(data) {

var color = "#33691E";
chartCustomer = new Chart($('#chart-customer'),
{
type: 'doughnut',
data: {
labels: data.labels,
datasets: [
{
    data: data.values,
    borderColor: 'transparent',
    backgroundColor: [color, hexToRGB(color, 0.6),hexToRGB(color, 0.4),hexToRGB(color, 0.4)],
    label: 'Trafic'
}
]
},
options: {
legend: {
position: 'left',
labels:{
boxWidth: 12
}
},
cutoutPercentage: 75
}
}
);

}

function setupChartProduct(data) {

var color = "#01579B";
chartProduct = new Chart($('#chart-product'),
{
type: 'doughnut',
data: {
labels: data.labels,
datasets: [
{
  data: data.values,
  borderColor: 'transparent',
  backgroundColor: [color, hexToRGB(color, 0.6),hexToRGB(color, 0.4),hexToRGB(color, 0.4)],
  label: 'Trafic'
}
]
},
options: {
legend: {
position: 'left',
labels:{
boxWidth: 12
}
},
cutoutPercentage: 75
}
}
);

}

</script> 
@endsection