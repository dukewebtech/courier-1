@extends('layouts.header')

@section('title', '| Orders')

@section('content')

<div id="main">
                 
                <div class="margin-container">
                    <!-- Project Contribution -->
                     
                    <div class="clearfix"></div>

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Orders List</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Pickup</th>
                    <th>Dropoff</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Weight</th>
                    <th>Payment Status</th>
                    <th>Assigned Status</th>
                    <th>Customer's Name</th>
                    <th>tracking_number</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($orders as $order)
                    <tr>

                        <td>{{ $order->pickup_address }}</td>
                        <td>{{ $order->drop_off_address }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->weight }}</td>
                        <td>
                            @if ($order->payment_status == 1)
                                Paid
                            @else
                                Not Paid
                            @endif
                        </td>
                        <td>
                            @if (is_null($order->rider_id))
                                No
                            @else
                                Yes
                            @endif
                        </td>
                        <td>{{ $order->recipient_name }}</td> 
                        <td>{{ $order->tracking_number }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        {{$orders->links()}}
     <!--   <a href="" class="btn btn-success">Assign</a>  -->


    </div>
</div>
</div>
@endsection
