@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Produto</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $product->amount }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
