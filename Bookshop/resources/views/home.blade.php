@extends('layouts.app')

@if(auth()->check())
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Home</div>

                        <div class="card-body">
                            <p>Kérlek válassz könyveink széles kínálatából, majd ha megtetszik valami vásárolja meg akár még ma!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location = "{{ route('login') }}";
    </script>
@endif
