@extends('layouts.app')

@section('title', 'Rekap Surat Per Kadus')

@section('content')
<div class="content-main" id="content-main">
  <div class="padding">
    <div class="box box-default">
      <div class="box-header">
        <h4 class="box-title">Filter</h4>
      </div>
      <div class="box-divider m-0"></div>
      <div class="box-body">
        <form class="form row" target="_blank" action="/surat/laporan/preview">
          <div class="col-lg-3">
            <label class="control-label">Dusun</label>
            <select name="dusun_id" class="form-control">
              @foreach ($dusun as $d)
              <option value="{{ $d->id }}">{{ $d->dusun }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-lg-3">
            <label class="control-label">Periode</label>
            <div class="input-group">
              <input name="start_date" type="text" class="form-control text-center date-picker" value="{{ date('Y-m-d', mktime(0, 0, 0, date('n'), 1, date('Y'))) }}" />
              <span class="input-group-addon">s/d</span>
              <input name="end_date" type="text" class="form-control text-center date-picker" value="{{ date('Y-m-d', mktime(0, 0, 0, date('n'), date('t'), date('Y'))) }}" />
            </div>
          </div>
          <div class="col-lg-3">
            <button class="btn btn-success" style="margin-top: 28px"><i class="fa fa-search mr-2"></i>Preview</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  let $startDate = $('[name=start_date]');
  let $endDate = $('[name=end_date]');

  $('.date-picker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
  });

  $startDate.on('changeDate', function () {
    $endDate.datepicker('setStartDate', new Date($startDate.val()));
  });

  $startDate.trigger('changeDate');
</script>
@endpush
