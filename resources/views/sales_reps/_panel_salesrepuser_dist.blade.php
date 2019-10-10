
<div id="panel_salesrepuser">     

<div class="panel panel-info">

   <div class="panel-heading">
      <h3 class="panel-title">{{ l('Sales Representative Center Access') }}

@if ( \App\Configuration::isTrue('DEVELOPER_MODE') && $salesrep->user )
      <a href="{{ route('salesrep.impersonate', [$salesrep->user->id]) }}" class="btn-success btn-link pull-right" target="_blank"><p class="text-success"><i class="fa fa-clock-o"></i> {{ l('Impersonate') }}</p></a>

@endif

      </h3>
   </div>

{!! Form::open(array('url' => "route('salesrepusers.store')".'#salesrepuser', 'id' => 'create_salesrepuser', 'name' => 'create_salesrepuser', 'class' => 'form')) !!}
<input type="hidden" value="{{$salesrep->id}}" name="salesrep_id" id="salesrep_id">
<input type="hidden" value="salesrepuser" name="tab_name" id="tab_name">

   <div class="panel-body">

        <div class="row">

                   <div class="form-group col-lg-4 col-md-4 col-sm-4" id="div-allow_absrc_access">
                     {!! Form::label('allow_absrc_access', l('Allow Sales Representative Center access?'), ['class' => 'control-label']) !!}
                     <div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('allow_absrc_access', '1', false, ['id' => 'allow_absrc_access_on']) !!}
                           {!! l('Yes', [], 'layouts') !!}
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('allow_absrc_access', '0', true, ['id' => 'allow_absrc_access_off']) !!}
                           {!! l('No', [], 'layouts') !!}
                         </label>
                       </div>
                     </div>
                   </div>

                   <div class="form-group col-lg-4 col-md-4 col-sm-4" id="div-notify_salesrep">
                     {!! Form::label('notify_salesrep', l('Notify Sales Representative? (by email)'), ['class' => 'control-label']) !!}
                     <div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('notify_salesrep', '1', true, ['id' => 'notify_salesrepb_on']) !!}
                           {!! l('Yes', [], 'layouts') !!}
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('notify_salesrep', '0', false, ['id' => 'notify_salesrep_off']) !!}
                           {!! l('No', [], 'layouts') !!}
                         </label>
                       </div>
                     </div>
                   </div>
        </div>

   </div>

   <div class="panel-footer text-right">
      <button class="btn btn-sm btn-info" type="submit" onclick="this.disabled=true;this.form.submit();">
         <i class="fa fa-hdd-o"></i>
         &nbsp; {{l('Save', [], 'layouts')}}
      </button>
   </div>

{!! Form::close() !!}


{{--
@if( optional($salesrep->user)->active )


        {!! Form::model($salesrep->user, array('method' => 'PATCH', 'url' => route('salesrepusers.update', [$salesrep->user->id]).'#salesrepuser' )) !!}
        <input type="hidden" value="{{$salesrep->id}}" name="salesrep_id" id="salesrep_id">

          @include('sales_reps._form_salesrep_user')

        {!! Form::close() !!}
        

@else

    @if ( !optional($salesrep->address)->email )
          <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-top: 10px;margin-bottom: 10px">
                <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                  {{l('Can not create a User for this Customer:')}}
                  <ul><li class="error">{{l('This Customer has not a valid email address.')}}</li></ul>
                </div>
            </div>
          </div>
    @else

{!! Form::open(array('url' => route('salesrepusers.store').'#salesrepuser', 'id' => 'create_salesrepuser', 'name' => 'create_salesrepuser', 'class' => 'form')) !!}
<input type="hidden" value="{{$salesrep->id}}" name="salesrep_id" id="salesrep_id">
<input type="hidden" value="salesrepuser" name="tab_name" id="tab_name">

   <div class="panel-body">

        <div class="row">

                   <div class="form-group col-lg-4 col-md-4 col-sm-4" id="div-allow_abcc_access">
                     {!! Form::label('allow_abcc_access', l('Allow Customer Center access?'), ['class' => 'control-label']) !!}
                     <div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('allow_abcc_access', '1', false, ['id' => 'allow_abcc_access_on']) !!}
                           {!! l('Yes', [], 'layouts') !!}
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('allow_abcc_access', '0', true, ['id' => 'allow_abcc_access_off']) !!}
                           {!! l('No', [], 'layouts') !!}
                         </label>
                       </div>
                     </div>
                   </div>

                   <div class="form-group col-lg-4 col-md-4 col-sm-4" id="div-notify_salesrep">
                     {!! Form::label('notify_salesrep', l('Notify Customer? (by email)'), ['class' => 'control-label']) !!}
                     <div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('notify_salesrep', '1', true, ['id' => 'notify_salesrepb_on']) !!}
                           {!! l('Yes', [], 'layouts') !!}
                         </label>
                       </div>
                       <div class="radio-inline">
                         <label>
                           {!! Form::radio('notify_salesrep', '0', false, ['id' => 'notify_salesrep_off']) !!}
                           {!! l('No', [], 'layouts') !!}
                         </label>
                       </div>
                     </div>
                   </div>
        </div>
{ {--
        <hr />

        <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 {{ $errors->has('description_short') ? 'has-error' : '' }}">
                     {{ l('Short Description') }}
                     {!! Form::textarea('description_short', null, array('class' => 'form-control', 'id' => 'description_short', 'rows' => '3')) !!}
                     {!! $errors->first('description_short', '<span class="help-block">:message</span>') !!}
                  </div>
        </div>

        <div class="row">
        </div>

        <div class="row">
        </div>
--} }
   </div>

   <div class="panel-footer text-right">
      <button class="btn btn-sm btn-info" type="submit" onclick="this.disabled=true;this.form.submit();">
         <i class="fa fa-hdd-o"></i>
         &nbsp; {{l('Save', [], 'layouts')}}
      </button>
   </div>

{!! Form::close() !!}

    @endif

@endif
--}}

</div><!-- div class="panel panel-info" -->

      
</div>
