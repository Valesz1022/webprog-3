@extends('layouts.app')

@if(auth()->check())
    @section('content')
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">Add Book</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('upload.book') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="cim" class="form-label">Cím:</label>
                            <input type="text" id="cim" name="cim" required maxlength="50" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="szerzo" class="form-label">Szerző:</label>
                            <input type="text" id="szerzo" name="szerzo" required maxlength="40" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="kiado" class="form-label">Kiadó:</label>
                            <input type="text" id="kiado" name="kiado" required maxlength="30" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="kiadas_eve" class="form-label">Kiadás éve:</label>
                            <input type="number" id="kiadas_eve" name="kiadas_eve" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="ar" class="form-label">Ár:</label>
                            <input type="number" id="ar" name="ar" min="0" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="kep" class="form-label">Kép:</label>
                            <input type="file" id="kep" name="kep" required class="form-control">
                        </div>

                        <button type="submit" name="feltolt" class="btn btn-primary">Feltöltés</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location = "{{ route('login') }}";
    </script>
@endif
