@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Produtos</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Adicionar Produto</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>R$ {{ number_format($product->total_value, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="table-light">
            <tr>
                <th colspan="4" class="text-end">Total Geral:</th>
                <th>{{ $totalAmount }}</th>
                <th>R$ {{ number_format($totalPrice, 2, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
