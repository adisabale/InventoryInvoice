@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Product Invoice') }}</div>

                <div class="card-body">
                     <form action="{{ route('save.invoice') }}" method="POST">
                        @csrf
             @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
                    <table class="table table-striped table-hover" id="dynamicTable">
                        <thead>
                          <tr>
                            <th>Select Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Tax</th>
                            <th>Discount</th>
                            <th><button type="button" name="add" id="add" class="btn btn-success">+</button></th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="3" class="text-end">Total Amount</td>
                            <td><input type="text" id="totalamount" name="totalamount" readonly="true"></td>
                        </tr>

                    </table>
                    <input type="text" name="customer_name" placeholder="Customer Name">
                    <input type="submit" class="btn btn-warning float-end fw-bold" value="Save Invoice"/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function () {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      bindProducts();
      
    var i = 0;
    $("#add").click(function(){
        i++;
        $("#dynamicTable tbody").append('<tr><td class="me-2"><select class="form-control product-list" data-iid="'+i+'" name="invoice['+i+'][product_id]"><option value="">Select</option></select> </td><td class="me-2"><input class="form-control itemprice" id="product-price'+i+'" type="text"></td><td class="me-2"><input class="form-control" id="itemqty'+i+'" type="number" name="invoice['+i+'][qty]" placeholder="Quantity"></td><td class="me-2"><input class="form-control tax" id="itemtax'+i+'" type="number" name="invoice['+i+'][tax]" placeholder="Tax"></td><td class="me-2"><input class="form-check-input discountact" data-iid="'+i+'" type="checkbox"></td><td class="me-2"><input class="form-control discount" id="discount'+i+'" type="number" name="invoice['+i+'][discount]" placeholder="Discount" value="0" readonly></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
         bindProducts();
    });
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
    // 
    $(document).on('click', '.discountact', function(){  
        var il_id = $(this).data('iid');
         if($(this).prop('checked')) {
            $('#discount'+il_id).removeAttr("readonly",true);
        }else{
            $('#discount'+il_id).attr("readonly",true);
        }
    });  
    // 
    $(document).on('change','.product-list',function(){
        var id = $(this).val();
        var il_id = $(this).data('iid');
         $.getJSON("{{ url('getProductAmount') }}/"+id, function (data) {
                $('#product-price'+il_id).val(data.product_price);
            });
    });

    function bindProducts(){
      $.getJSON("{{ url('home') }}", function (data) {
                $.each(data, function (index, value) {
                    $('.product-list').append('<option value="' + value.id + '">' + value.product_name + '</option>');
                });
            });
    }
    
    $(document).on('keyup',['.tax','.discount'],function(){
        var sum=0;
        for(itemcount=0;itemcount<i;itemcount++){
             var p_p   = parseInt($('#product-price'+(itemcount+1)).val());
             var p_qt  = parseInt($('#itemqty'+(itemcount+1)).val());
             var p_tax = parseInt($('#itemtax'+(itemcount+1)).val());
             var p_dis = parseInt($('#discount'+(itemcount+1)).val());
             var t_p = p_p*p_qt;
             var disamt = (p_dis>0)?(t_p*(p_dis/100)):0;
            sum+=Number(t_p+(t_p*(p_tax/100))-disamt);
        }
        $('#totalamount').val(sum);
        });
   });
</script>
@endsection
