@extends('layouts.app')

@if(auth()->check())
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Update Books</div>

                        <div class="card-body">
                            <form action="{{ route('update_books') }}" method="POST">
                                @csrf
                                <div class="row">
                                    @foreach($books as $book)
                                        <div class="col-md-4 mb-3">
                                            <div class="text-center border p-3">
                                                <img src="{{ asset('images/' . $book->kep) }}" alt="{{ $book->cim }}" class="kep" style="max-width: 100%; margin-bottom: 15px;">
                                                <p class="mt-4">{{ $book->szerzo }}</p>
                                                <p>{{ $book->cim }}</p>
                                                <div class="form-group">
                                                    <label for="title">Title:</label>
                                                    <input type="text" class="form-control" id="title" name="books[{{ $book->id }}][title]" value="{{ $book->title }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="author">Author:</label>
                                                    <input type="text" class="form-control" id="author" name="books[{{ $book->id }}][author]" value="{{ $book->author }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price:</label>
                                                    <input type="text" class="form-control" id="price" name="books[{{ $book->id }}][price]" value="{{ $book->price }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="publisher">Publisher:</label>
                                                    <input type="text" class="form-control" id="publisher" name="books[{{ $book->id }}][publisher]" value="{{ $book->publisher }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="publishing_year">Publishing Year:</label>
                                                    <input type="text" class="form-control" id="publishing_year" name="books[{{ $book->id }}][publishing_year]" value="{{ $book->publishing_year }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image:</label>
                                                    <input type="text" class="form-control" id="image" name="books[{{ $book->id }}][image]" value="{{ $book->image }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="books[]" value="{{ $book }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
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
