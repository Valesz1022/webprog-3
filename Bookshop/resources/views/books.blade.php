@extends('layouts.app')

@if(auth()->check())
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Books</div>

                        <div class="card-body">
                            <div class="row">
                                @php $count = 0; @endphp

                                @foreach($books as $book)
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center border p-3">
                                            <img src="{{ asset('images/' . $book->kep) }}" alt="{{ $book->cim }}" class="kep" style="max-width: 100%; margin-bottom: 15px;">
                                            <h6 class="mt-4">{{ $book->szerzo }}</h6>
                                            <h4>{{ $book->cim }}</h4>
                                            <h6 class="mb-2">{{ $book->ar }} Ft</h6>
                                        </div>
                                    </div>

                                    @php
                                        $count++;
                                        if ($count % 3 == 0) {
                                            echo '</div><div class="row">';
                                        }
                                    @endphp
                                @endforeach
                            </div>
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
