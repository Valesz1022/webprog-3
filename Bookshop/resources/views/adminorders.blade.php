@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Admin Orders</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Felhasználó</th>
                                    <th>Könyv</th>
                                    <th>Mennyiség</th>
                                    <th>Szállítási cím</th>
                                    <th>Állapot</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->book->szerzo }} - {{ $order->book->cim }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->shipping_address }}</td>
                                        <td>
                                            <form action="{{ route('admin.orders.update_status') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <select name="status" onchange="this.form.submit()" class="form-control">
                                                    <option value="Feldolgozás alatt" {{ $order->status === 'Feldolgozás alatt' ? 'selected' : '' }}>Feldolgozás alatt</option>
                                                    <option value="Összekészítés" {{ $order->status === 'Összekészítés' ? 'selected' : '' }}>Összekészítés</option>
                                                    <option value="Szállítás" {{ $order->status === 'Szállítás' ? 'selected' : '' }}>Szállítás</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.orders.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <button type="submit" class="btn btn-danger">Kiszállítva</button>
                                            </form>
                                        </td>
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

@if(!auth()->check())
    <script>
        window.location = "{{ route('login') }}";
    </script>
@endif
