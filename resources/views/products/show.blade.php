@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Produto</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            <p class="card-text"><strong>Quantidade:</strong> {{ $product->amount }}</p>
        </div>
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Voltar</a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary mt-3">Editar</a>

    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
    </form>
</div>
@endsection
