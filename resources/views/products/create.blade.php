@extends('layouts.app')

@section('title', 'Adicionar novo produto')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Novo Produto</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Quantidade:</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Adicionar Produto</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
