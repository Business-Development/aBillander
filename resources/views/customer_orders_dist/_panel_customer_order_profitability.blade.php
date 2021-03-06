



               <!-- br><h4  class="text-info" xclass="panel-title">
                   {{l('Profitability Analysis')}}
               </h4><br -->
              <div xclass="page-header">
                  <h3>
                      <span style="color: #dd4814;">{{l('Cost-benefit per line')}}</span> <!-- span style="color: #cccccc;">/</span>  -->
                       
                  </h3><br>        
              </div>


    <div id="div_customer_order_profit_details">
       <div class="table-responsive">

    <table id="order_lines_profit" class="table table-hover">
        <thead>
            <tr>
               <th class="text-left">{{l('Line #')}}</th>
                        <th class="text-center">{{l('Quantity')}}</th>
                        <th class="text-left">{{l('Reference')}}</th>
               <th class="text-left">{{l('Description')}}</th>
                        <th class="text-left">{{l('Price')}}</th>
                        <!-- th class="text-left">{{l('Disc. %')}}</th>
                        <th class="text-left">{{l('Net')}}</th -->
                        <th class="text-right">{{l('Cost')}}</th>
                        <th class="text-right">{{l('Margin 1 (%)')}}</th>
                        <th class="text-right">{{l('Margin Amount')}}</th>
@if ($order->salesrep)
                        <th class="text-right">{{l('Commission (%)')}}</th>
                        <th class="text-right">{{l('Margin 2 (%)')}}</th>
@endif
                      </tr>
                    </thead>

        <tbody>

    @if ($order->customerorderlines->count())
            <!-- tr style="color: #3a87ad; background-color: #d9edf7;" -->
            

            @foreach ($order->customerorderlines as $line)
            <tr>
                <td>{{$line->line_sort_order }}</td>
                <td class="text-center">{{ $line->as_quantity('quantity') }}</td>
                <td>
                @if($line->line_type == 'shipping')
                  <i class="fa fa-truck abi-help" title="{{l('Shipping Cost')}}"></i> 
                @endif
                <a href="{{ URL::to('products/' . $line->product_id . '/edit') }}" title="{{l('View Product')}}" target="_blank">{{ $line->reference }}</a></td>
                <td>
                {{ $line->name }}</td>
                <td class="text-right">{{ $line->as_price('unit_final_price') }}</td>
                <td class="text-right">{{ $line->as_price('cost_price') }}</td>
                <td class="text-right">{{ $line->as_percentable( \App\Calculator::margin( $line->cost_price, $line->unit_final_price, $order->currency ) ) }}</td>
                <td class="text-right">{{ $line->as_priceable( ( $line->unit_final_price - $line->cost_price )*$line->quantity ) }}</td>



@if ($order->salesrep)
                        <th class="text-right"> </th>
                        <th class="text-right"></th>
@endif
            </tr>
            
            @endforeach

    @else
    <tr><td colspan="9">
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{l('No records found', [], 'layouts')}}
    </div>
    </td></tr>
    @endif

        </tbody>
    </table>

       </div>
    </div>



               
              <div xclass="page-header">
                  <h3>
                      <span style="color: #dd4814;">{{l('Order Cost-Benefit Analysis')}}</span> 

                    @if ( \App\Configuration::get('INCLUDE_SHIPPING_COST_IN_PROFIT') > 0 )
                      <span class="label label-danger" style="font-size: 55%;">{{ l('Shipping Cost included', [], 'layouts') }}</span>
                    @else
                      <span class="label label-warning" style="font-size: 55%;">{{ l('Shipping Cost excluded', [], 'layouts') }}</span>
                    @endif
                       
                  </h3><br>        
              </div>





    <div id="div_customer_order_profit">
       <div class="table-responsive">

    <table id="order_profit" class="table table-hover">
        <thead>
            <tr>
                          <th class="text-left">{{l('Total')}}</th>
                          <th class="text-left">{{l('Disc. %')}}</th>
                          <th class="text-left">{{l('Net')}}</th>
                          <th class="text-right">{{l('Cost')}}</th>
                          <th class="text-right">{{l('Margin 1 (%)')}}</th>
                          <th class="text-right">{{l('Margin Amount')}}</th>
@if ($order->salesrep)
                        <th class="text-right">{{l('Commission (%)')}}</th>
                        <th class="text-right">{{l('Margin 2 (%)')}}</th>
@endif
                      </tr>
                    </thead>

        <tbody>

            <tr>
                <td>{{ $order->as_priceable($order->total_revenue) }}</td>
                <td>{{ $order->as_percent('document_discount_percent') }}</td>
                <td>{{ $order->as_priceable($order->total_revenue_with_discount) }}</td>
                <td class="text-right">{{ $order->as_priceable($order->total_cost_price) }}</td>
                <td class="text-right">{{ $order->as_percentable( \App\Calculator::margin( $order->total_cost_price, $order->total_revenue_with_discount, $order->currency ) ) }}</td>
                <td class="text-right">{{ $order->as_priceable( $order->total_revenue_with_discount - $order->total_cost_price ) }}</td>



@if ($order->salesrep)
                        <th class="text-right"> </th>
                        <th class="text-right"></th>
@endif
            </tr>

        </tbody>
    </table>

       </div>
    </div>




               <br>
               <br>

               <b>{{l('Margin')}}</b>: 
                    {{ \App\Configuration::get('MARGIN_METHOD') == 'CST' ?
                          l('Margin calculation is based on Cost Price', [], 'layouts') :
                          l('Margin calculation is based on Sales Price', [], 'layouts') }}
               <br>





{{--
    <!-- div class="page-header">
        <h3>
            <span style="color: #dd4814;">{{ l('Lines') }}</span> <!-- span style="color: #cccccc;">/</span> {{ $order->name }} - - >
        </h3>        
    </div -->

    <div id="div_customer_order_lines">
       <div class="table-responsive">

    <table id="order_lines" class="table table-hover">
        <thead>
            <tr>
               <th class="text-left" style="width: 60px"></th>
               <th class="text-left">{{l('Reference')}}
                           <a href="javascript:void(0);" data-toggle="popover" data-placement="top" 
                                      data-content="{{ l('Arrastre para reordenar.') }}">
                                  <i class="fa fa-question-circle abi-help"></i>
                           </a></th>
               <th class="text-left">{{l('Description')}}</th>
               <th class="text-right" xxwidth="90">{{l('Quantity')}}</th>

               <th class="text-right">{{l('Price')}}</th>
               <th class="text-right" width="90">{{l('Disc. %')}}</th>

               <th class="text-right" xwidth="90">{{l('Total')}}</th> 
               <th class="text-right" xwidth="90">{{l('With Tax')}}</th> 
               {{-- quantity * (price - discount) Con tax o no depende de la configuración de meter precios con impuesto incluido --}}
               <!-- th class="text-right" xwidth="115">{{l('Tax')}}</th -->

               <!-- th class="text-right">{{l('Line Total')}}</th --> {{-- amount * tax -- } }

               <th class="text-left" style="width:1px; white-space: nowrap;"></th>
               <th class="text-left" xwidth="115">{{l('Notes', 'layouts')}}</th>
                <th class="text-right button-pad"> 

                  <a class="btn btn-sm btn-magick btn-pressure btn-sensitive create-order-product" title="{{l('Add Product')}}"><i class="fa fa-plus"></i> <i class="fa fa-superpowers"></i> </a>

                  <a class="btn btn-sm btn-success create-order-product" title="{{l('Add Product')}}"><i class="fa fa-plus"></i> <i class="fa fa-shopping-basket"></i> </a>

                  <a class="btn btn-sm btn-success create-order-service" title="{{l('Add Service')}}" style="background-color: #2bbbad;"><i class="fa fa-plus"></i> <i class="fa fa-handshake-o"></i> </a>

{{--
<div class="btn-group" xstyle="width:98%">
  <a href="#" class="btn btn-sm btn-success create-order-product"><i class="fa fa-plus"></i> {{l('Add New', [], 'layouts')}}</a>
  <a href="#" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
  <ul class="dropdown-menu  pull-right">
    <li><a class="create-order-product"       href="#">{{l('Product')}}</a></li>
    <li><a class="create-order-service"       href="#">{{l('Service')}}</a></li>
    <li><a class="create-order-discount-line" href="#">{{l('Discount Line')}}</a></li>
    <!-- li><a class="create-order-text-line"     href="#">{{l('Text Line')}}</a></li -->

    <!-- li class="divider"></li>
    <li><a href="#">Separated link</a></li -->
  </ul>
</div>
-- } }

                </th>
            </tr>
        </thead>
        <tbody class="sortable">

    @if ($order->customerorderlines->count())
            <!-- tr style="color: #3a87ad; background-color: #d9edf7;" -->
            

            @foreach ($order->customerorderlines as $line)
            <tr data-id="{{ $line->id }}" data-sort-order="{{ $line->line_sort_order }}">
                <td>[{{ $line->id }}] {{$line->line_sort_order }}</td>
                <td>{{ $line->reference }}</td>
                <td>
                @if($line->line_type == 'shipping')
                  <i class="fa fa-truck abi-help" title="{{l('Shipping Cost')}}"></i> 
                @endif
                {{ $line->name }}</td>
                <td class="text-right">{{ $line->as_quantity('quantity') }}</td>
                <td class="text-right">{{ $line->as_price('unit_customer_final_price') }}</td>
                <td class="text-right">{{ $line->as_percent('discount_percent') }}</td>
                <td class="text-right">{{ $line->as_price('total_tax_excl') }}</td>
                <td class="text-right">{{ $line->as_price('total_tax_incl') }}</td>
                <!-- td class="text-right">{{ $line->as_priceable($line->total_tax_incl - $line->total_tax_excl) }}</td -->
                <td class="text-center">
                @if($line->sales_equalization)
                  <i class="fa fa-tag" style="color: #38b44a" title="{{l('Equalization Tax')}}"></i> 
                @endif
                </td>
                <td class="text-center">
                @if ($line->notes)
                 <a href="javascript:void(0);">
                    <button type="button" xclass="btn btn-xs btn-success" data-toggle="popover" data-placement="top" 
                            data-content="{{ $line->notes }}">
                        <i class="fa fa-paperclip"></i> {{l('View', [], 'layouts')}}
                    </button>
                 </a>
                @endif</td>
                <td class="text-right">
                    <!-- a class="btn btn-sm btn-info" title="{{l('XXXXXS', [], 'layouts')}}" onClick="loadcustomerorderlines();"><i class="fa fa-pencil"></i></a -->
                    
                    <a class="btn btn-sm btn-warning edit-order-line" data-id="{{$line->id}}" data-type="{{$line->line_type}}" title="{{l('Edit', [], 'layouts')}}" onClick="return false;"><i class="fa fa-pencil"></i></a>
                    
                    <a class="btn btn-sm btn-danger delete-order-line" data-id="{{$line->id}}" title="{{l('Delete', [], 'layouts')}}" 
                        data-content="{{l('You are going to delete a record. Are you sure?', [], 'layouts')}}" 
                        data-title="{{ '('.$line->id.') ['.$line->reference.'] '.$line->name }}" 
                        onClick="return false;"><i class="fa fa-trash-o"></i></a>

                </td>
            </tr>
            
            @endforeach

            @php
                $max_line_sort_order = $line->line_sort_order;
            @endphp

    @else
    <tr><td colspan="9">
    <div class="alert alert-warning alert-block">
        <i class="fa fa-warning"></i>
        {{l('No records found', [], 'layouts')}}
    </div>
    </td></tr>
    @endif

        </tbody>
    </table>

    <input type="hidden" name="next_line_sort_order" id="next_line_sort_order" value="{{ ($line->line_sort_order ?? 0) + 10 }}">

       </div>
    </div>


{{-- ******************************************************************************* -- } }


<div id="panel_customer_order_total" class="">
  
    @include('customer_orders._panel_customer_order_total')

</div>

--}}