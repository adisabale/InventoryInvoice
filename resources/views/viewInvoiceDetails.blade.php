@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Invoice') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="dynamicTable">
                        <thead>
                          <tr>
                            <th>Invoice No.</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php ($id=1)
                        @foreach($invoice as $inv)
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $inv->product_name }}</td>
                            <td>{{ $inv->product_price }}₹</td>
                            <td>{{ $inv->discount }} %</td>
                            <td>{{ $inv->tax }} %</td>
                            <td>{{ $inv->qty }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
