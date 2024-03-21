@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buy Product</h2>
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('transactions.buy') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Select Product</label>
            <select class="form-control" id="product_id" name="product_id">
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
        </div>
        <button type="submit" class="btn btn-primary">Buy</button>
    </form>
</div>
@endsection
