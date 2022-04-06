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
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>View</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice as $inv)
                        <tr>
                            <td>{{ $inv->id }}</td>
                            <td>{{ $inv->customer_name }}</td>
                            <td>{{ $inv->total_amount }} ₹</td>
                            <td><a href="{{ url('view-invoice-details/'.$inv->id) }}" class="btn btn-success">+</a></td>
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
