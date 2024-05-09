@extends('layouts.app')

@if(auth()->check())
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Delete Book</div>

                        <div class="card-body">
                            <div class="row">
                                @php $count = 0; @endphp

                                @foreach($books as $book)
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center border p-3">
                                            <img src="{{ asset('images/' . $book->kep) }}" alt="{{ $book->cim }}" class="kep" style="max-width: 100%; margin-bottom: 15px;">
                                            <h5 class="mt-4">{{ $book->szerzo }}</h5>
                                            <h3>{{ $book->cim }}</h3>

                                            <form action="{{ route('delete_book', ['book' => $book->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Delete Book') }}</button>
                                            </form>
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
