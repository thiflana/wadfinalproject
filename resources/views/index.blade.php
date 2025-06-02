@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Keranjang Belanja</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($cart->items->isEmpty())
            <p>Keranjang kosong.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.update', $item) }}">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('cart.checkout') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        @endif
    </div>
@endsection
