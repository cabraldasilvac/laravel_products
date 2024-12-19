# Cadastro de Produtos

## Passo a Passo do Projeto

- Criação do Model e Migration.
- Criação do Controller com as Funções CRUD.
- Definição das Rotas.
- Desenvolvimento das Views com Bootstrap.
- Configuração da Home Page para listar produtos.
</ hr>

1. Configuração do Banco de Dados
No arquivo .env, configure o acesso ao seu banco de dados MySQL:

```DOTENV
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_products
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

Crie o banco de dados no MySQL:

```SQL
CREATE DATABASE laravel_products;
```

</hr>

2. Criação do Model e Migration
Crie um Model Product com a migration associada:

```bash
php artisan make:model Product -m
```

No arquivo database/migrations/xxxx_xx_xx_xxxxxx_create_products_table.php, adicione os campos necessários:

```PHP
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->integer('amount');
        $table->timestamps();
    });
}
```

Rode a migration:

```bash
php artisan migrate
```

</hr>

3. Criação do Controller com as Funções CRUD
Crie o controller ProductController com os métodos CRUD:

```bash
php artisan make:controller ProductController --resource
```

No arquivo app/Http/Controllers/ProductController.php, adicione o seguinte código:

```PHP
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Mostrar formulário para criar um novo produto
    public function create()
    {
        return view('products.create');
    }

    // Armazenar um novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
    }

    // Mostrar detalhes de um produto
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Mostrar formulário para editar um produto
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Atualizar um produto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    // Deletar um produto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso.');
    }
}
```

</hr>

4. Definição das Rotas
No arquivo routes/web.php, adicione as rotas para os produtos:

```PHP
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);

Route::resource('products', ProductController::class);
```

</hr>

5. Desenvolvimento das Views com Bootstrap
Crie as views em resources/views/products/:

5.1. index.blade.php

```HTML
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Produtos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Adicionar Produto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade</th>
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
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Visualizar</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
```

5.2. Layout Base layouts/app.blade.php
Crie o layout base em resources/views/layouts/app.blade.php:

```HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        @yield('content')
    </div>
</body>
</html>
```

</hr>

6. Configuração da Home Page
A rota raiz (/) já foi configurada para listar os produtos na view index.blade.php.

</hr>

Conclusão
Com essas configurações, você tem um CRUD funcional de produtos em Laravel 11 usando Bootstrap para o layout. Certifique-se de rodar o servidor para testar:

```PHP
php artisan serve
```

Resolvendo o Problema:

1 - Gerar uma chave KEY

```PHP
php artisan key:generate
```

A chave gerada será incluida no arquivo .env automaticamente.

2 - Limpar o cache.

```PHP
php artisan config:cache
```

3 - Reiniciar o servidor

```PHP
php artisan serve
```

***Se for necessário criar  uma database sessions.***

Crie a migration para sessões:

Laravel já possui uma migration padrão para a tabela sessions, mas caso ela não esteja presente, você pode criar uma nova com o seguinte comando:

bash
Copiar código
php artisan make:migration create_sessions_table
Edite a migration (se necessário):

Se a migration padrão estiver ausente ou se precisar editar algo, a estrutura básica deve ser assim:

```PHP

public function up()
{
    Schema::create('sessions', function (Blueprint $table) {
        $table->string('id')->unique();
        $table->foreignId('user_id')->nullable()->index();
        $table->string('ip_address', 45)->nullable();
        $table->text('user_agent')->nullable();
        $table->longText('payload');
        $table->integer('last_activity')->index();
    });
}
```

Rode a migration:

```PHP
php artisan migrate
```

Limpe o cache da aplicação:

```PHP
php artisan config:cache
php artisan cache:clear
php artisan view:clear
```

Reinicie o servidor:

```PHP
php artisan serve
```

***Usando o Seeder***

Passo a Passo
Crie um Seeder:

bash
Copiar código
php artisan make:seeder ProductSeeder
Edite o Seeder:

Abra o arquivo database/seeders/ProductSeeder.php e adicione os seguintes dados:

```php

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Smartphone', 'description' => 'Um smartphone de última geração.', 'price' => 2500.00, 'amount' => 10],
            ['name' => 'Notebook', 'description' => 'Um notebook para uso profissional.', 'price' => 4500.00, 'amount' => 5],
            ['name' => 'Headset', 'description' => 'Fone de ouvido com microfone.', 'price' => 150.00, 'amount' => 25],
            ['name' => 'Mouse', 'description' => 'Mouse sem fio.', 'price' => 80.00, 'amount' => 50],
            ['name' => 'Teclado', 'description' => 'Teclado mecânico.', 'price' => 200.00, 'amount' => 30],
            ['name' => 'Monitor', 'description' => 'Monitor Full HD.', 'price' => 900.00, 'amount' => 15],
            ['name' => 'Impressora', 'description' => 'Impressora multifuncional.', 'price' => 1200.00, 'amount' => 8],
            ['name' => 'Caixa de Som', 'description' => 'Caixa de som Bluetooth.', 'price' => 300.00, 'amount' => 20],
            ['name' => 'HD Externo', 'description' => 'HD externo de 1TB.', 'price' => 400.00, 'amount' => 12],
            ['name' => 'Webcam', 'description' => 'Webcam Full HD.', 'price' => 250.00, 'amount' => 18],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
```

Registre o Seeder em DatabaseSeeder.php:

Abra o arquivo database/seeders/DatabaseSeeder.php e adicione a chamada ao ProductSeeder:

```php
public function run()
{
    $this->call(ProductSeeder::class);
}
```

Execute o Seeder:

```PHP
php artisan db:seed
```
