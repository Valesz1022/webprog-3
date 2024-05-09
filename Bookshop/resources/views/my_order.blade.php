@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">My Orders</div>

                    <div class="card-body">
                        @if($orders->isEmpty())
                            <p>No orders found.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Könyv</th>
                                        <th>Mennyiség</th>
                                        <th>Fizetendő összeg</th>
                                        <th>Állapot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->book->szerzo }} - {{ $order->book->cim }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
