
   <div class="row">
      <div class="col-lg-1 col-md-1 col-sm-1">
         <div class="list-group">
            <!-- a id="b_generales" href="" class="list-group-item active info" onClick="return false;">
               <i class="fa fa-user"></i>
               &nbsp; {{ l('Customer Orders') }}
            </a -->
         </div>
      </div>

      <div class="col-lg-10 col-md-10 col-sm-10">

<div class="page-header">
    <div class="pull-right hide" xstyle="padding-top: 4px;">

        <a href="{{ URL::to('productionsheets/'.$sheet->id.'/calculate') }}" class="btn btn-success"><i class="fa fa-cog"></i> {{ l('Update Sheet') }}</a>

        <a href="{{ URL::to('productionsheets') }}" class="btn xbtn-sm btn-default"><i class="fa fa-mail-reply"></i> {{ l('Back to Production Sheets') }}</a>
    </div>
@php

  $work_center_id = 1;
  $work_center =\App\WorkCenter::findOrFail($work_center_id);

@endphp
    <h3>
        <a href="#">{{ l('Documentos') }}</a> <span style="color: #cccccc;">::</span> {{ $work_center->name }}

        <a href="{{ route('productionsheet.summary.pdf', [$sheet->id, 'work_center_id' => 
  $work_center_id]) }}" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> {{ l('Resumen') }}</a>

        <a href="{{ route('productionsheet.preassemblies.pdf', [$sheet->id, 'work_center_id' => 
  $work_center_id]) }}" class="btn btn-warning" target="_blank"><i class="fa fa-file-pdf-o"></i> {{ l('Semi-Elaborados') }}</a>

        <a href="{{ route('productionsheet.manufacturing.pdf', [$sheet->id, 'work_center_id' => 
  $work_center_id, 'key' => 'espelta']) }}" class="btn btn-custom" target="_blank"><i class="fa fa-file-pdf-o"></i> {{ l('Espelta') }}</a>

        <a href="{{ route('productionsheet.manufacturing.pdf', [$sheet->id, 'work_center_id' => 
  $work_center_id, 'key' => 'centeno']) }}" class="btn btn-custom" target="_blank"><i class="fa fa-file-pdf-o"></i> {{ l('Centeno') }}</a>

        <a href="{{ route('productionsheet.manufacturing.pdf', [$sheet->id, 'work_center_id' => 
  $work_center_id, 'key' => 'trigo']) }}" class="btn btn-custom" target="_blank"><i class="fa fa-file-pdf-o"></i> {{ l('Trigo') }}</a>

        <a href="{{ route('productionsheet.manufacturing.pdf', [$sheet->id, 'work_center_id' => 
  $work_center_id, 'key' => 'combi']) }}" class="btn btn-custom" target="_blank"><i class="fa fa-file-pdf-o"></i> {{ l('Combi') }}</a>

        @if ( 0 )
              <button type="button" class="btn btn-sm btn-danger" title="{{l('Need Update')}}">
                  <i class="fa fa-hand-stop-o"></i>
              </button>
        @endif
    </h3>        
</div>

      </div>

   </div>



@section('styles')    @parent

<style>
  /* 
  http://twitterbootstrap3buttons.w3masters.nl/?color=%232BA9E1
  https://bootsnipp.com/snippets/M3x9

  */
.btn-custom {
  color: #fff;
  background-color: #ff0084;
  border-color: #ff0084;
}
.btn-custom:hover,
.btn-custom:focus,
.btn-custom:active,
.btn-custom.active {
  background-color: #e60077;
  border-color: #cc006a;
}
.btn-custom.disabled:hover,
.btn-custom.disabled:focus,
.btn-custom.disabled:active,
.btn-custom.disabled.active,
.btn-custom[disabled]:hover,
.btn-custom[disabled]:focus,
.btn-custom[disabled]:active,
.btn-custom[disabled].active,
fieldset[disabled] .btn-custom:hover,
fieldset[disabled] .btn-custom:focus,
fieldset[disabled] .btn-custom:active,
fieldset[disabled] .btn-custom.active {
  background-color: #ff0084;
  border-color: #ff0084;
}


</style>

@endsection