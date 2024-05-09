@extends('layouts.app')

@if(auth()->check())
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Shopping</div>

                        <div class="card-body">
                            <div class="row">
                                @foreach($books as $book)
                                    <div class="col-md-4 mb-3">
                                        <div class="text-center border p-3">
                                            <img src="{{ asset('images/' . $book->kep) }}" alt="{{ $book->cim }}" class="kep" style="max-width: 100%; margin-bottom: 15px;">
                                            <h6 class="mt-4">{{ $book->szerzo }}</h6>
                                            <h4>{{ $book->cim }}</h4>
                                            <h6 class="mb-2">{{ $book->ar }} Ft</h6>
                                            <button class="btn btn-primary" onclick="orderBook('{{ $book->id }}', '{{ $book->szerzo }}', '{{ $book->cim }}', '{{ $book->ar }}')">Vásárlás</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="orderModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rendelés</h5>
                    </div>
                    <div class="modal-body">
                        <form id="orderForm" action="{{ route('place.order') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="quantity">Mennyiség (1-5):</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="5" required autocomplete="off">
                            </div>
                            <div id="orderDetails"></div>
                            <input type="hidden" id="bookId" name="book_id">
                            <div class="form-group">
                                <label for="postal_code">Irányítószám:</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control" required autocomplete="postal-code">
                            </div>
                            <div class="form-group">
                                <label for="city">Város:</label>
                                <input type="text" id="city" name="city" class="form-control" required autocomplete="address-level2">
                            </div>
                            <div class="form-group">
                                <label for="street">Utcanév:</label>
                                <input type="text" id="street" name="street" class="form-control" required autocomplete="address-line1">
                            </div>
                            <div class="form-group">
                                <label for="house_number">Házszám:</label>
                                <input type="text" id="house_number" name="house_number" class="form-control" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeOrderModalButton">Mégse</button>
                        <button type="submit" class="btn btn-primary" form="orderForm">Rendelés</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            function orderBook(id, szerzo, cim, ar) {
                $('#orderModal').modal('show');
                $('#orderDetails').html(`Ezt a könyvet szeretné megvenni: ${szerzo}, ${cim}<br>Ennyit rendelt belőle: <span id="selectedQuantity"></span> darab<br>Fizetendő: <span id="totalPrice"></span> Ft`);
                $('#bookId').val(id);

                $('#quantity').on('input', function() {
                    const quantity = $(this).val();
                    $('#selectedQuantity').text(quantity);
                    const totalPrice = quantity * ar;
                    $('#totalPrice').text(totalPrice);
                });

                $('#closeOrderModalButton').on('click', function() {
                    $('#orderForm')[0].reset();
                    $('#orderModal').modal('hide');
                });
            }
        </script>
    @endpush

@else
    <script>
        window.location = "{{ route('login') }}";
    </script>
@endif
