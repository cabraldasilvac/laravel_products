# 🚀 Cadastro de Produtos

***Usando PHP Laravel 11***

## Passo a Passo do Projeto

- ✅ Criação do Model e Migration.
- ✅ Criação do Controller com as Funções CRUD.
- ✅ Definição das Rotas.
- ✅ Desenvolvimento das Views com Bootstrap.
- ✅ Configuração da Home Page para listar produtos.

#

***㏈ Configuração do Banco de Dados:***
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

#

***Criação do Model e Migration***
Crie um Model Product com a migration associada:

```bash
php artisan make:model Product -m
```

No arquivo database/migrations/xxxx_xx_xx_xxxxxx_create_products_table.php, adicione os campos necessários:

<details> <summary>**Exemplo:** </summary>

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

</details>

**Rode a migration:**

```bash
php artisan migrate
```

#

***Criação do Controller com as Funções CRUD***
Crie o controller ProductController com os métodos CRUD:

```PHP
php artisan make:controller ProductController --resource
```

Adicione o código do arquivo app/Http/Controllers/ProductController.php:

#

***Definição das Rotas***
No arquivo routes/web.php, adicione as rotas para os produtos:

```PHP
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);

Route::resource('products', ProductController::class);
```

#

<details><summary>Desenvolvimento das Views com Bootstrap* </summary>

No diretorio resources/views crie o diretorio products.

Crie as views em resources/views/products/

- index.blade.php
- create.blade.php
- edit.blade.php
- show.blade.php

***Styles:***

- Layout Base layouts/app.blade.php
Crie o layout base em resources/views/layouts/app.blade.php:

**Exemplo**:

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

</details>

#

***Configuração da Home Page***
A rota raiz (/) já foi configurada para listar os produtos na view index.blade.php.

#

<details><summary>Usando o Seeder</summary>

Passo a Passo
Crie um Seeder:

```php
php artisan make:seeder ProductSeeder
```

Edite o Seeder:

Abra o arquivo database/seeders/ProductSeeder.php e adicione os seguintes dados:

**Exemplo**:

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

**Registre o Seeder em DatabaseSeeder.php:**

Abra o arquivo database/seeders/DatabaseSeeder.php e adicione a chamada ao ProductSeeder:

**Exemplo:**

```php
public function run()
{
    $this->call(ProductSeeder::class);
}
```

**`Execute o Seeder:`**

```PHP
php artisan db:seed
```

**Rode a migration:**

```PHP
php artisan migrate
```

</details>

#

<details><summary> Conclusão:</summary>

*Com essas configurações, você tem um CRUD funcional de produtos em Laravel 11 usando Bootstrap para o layout. Certifique-se de rodar o servidor para testar:*

```PHP
php artisan serve
```

***Resolvendo o Problema:***
Se você tiver problema com chave KEY ao rodar o programa siga os passos abaixo.

*1 - Gerar uma chave KEY*

```PHP
php artisan key:generate
```

A chave gerada será incluida no arquivo .env automaticamente.

*2 - Limpar o cache.*

```PHP
php artisan config:cache
```

*3 - Reiniciar o servidor*

```PHP
php artisan serve
```

***Se for necessário criar  uma database sessions.***

*Crie a migration para sessões:*

Laravel já possui uma migration padrão para a tabela sessions, mas caso ela não esteja presente, você pode criar uma nova com o seguinte comando:

```PHP
php artisan make:migration create_sessions_table
```

Edite a migration (se necessário):

Se a migration padrão estiver ausente ou se precisar editar algo, a estrutura básica deve ser assim:

**Exemplo:**

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

</details>

</hr>

> [!TIP]
> Limpe o cache da aplicação:

```PHP
php artisan config:cache
php artisan cache:clear
php artisan view:clear
```

> [!TIP]
> Reinicie o servidor:

```PHP
php artisan serve
```

</hr>

### 📽️ Para rodar o Projeto

- 💡 Faça o clone do Projeto
[Laravel_products](https://github.com/cabraldasilvac/laravel_products.git)

- ⚙️ Configure o .env com os dados do seu DB.
- ⚙️ Inicie o MySQL ou outro gerenciador de Banco de Dados preferido.

</hr>

### 💡 Sugestões e orientações sempre são bem-vindas
