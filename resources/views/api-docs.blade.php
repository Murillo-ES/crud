@extends('layout')

@section('title', 'Documentação API')

@section('content')

<div class="container">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-black">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4" style="text-align: center">
                Documentação API
            </h3>

            <div class="row">
                <div>
                    <div id="introduction" class="section scrollspy">
                        <h4>Introdução</h4>
                        <p>
                            Esta página contém a documentação para realizar chamadas para o API deste e-Commerce Project.
                            <br><br>
                            Note que algumas funcionalidades da API requerem um Token API. Você pode criar um para a sua conta clicando 
                            <a href="http://crud.test/profile">aqui</a>, e então clicando no botão "Novo Token". 
                            Certifique-se de copiar o token e colar o mesmo em local seguro, pois o mesmo não poderá ser recuperado em virtude do <em>hashing</em>.
                        </p>
                    </div>

                    <div id="products" class="section scrollspy">
                        <h4>Produtos</h4>

                        <p>Essas rotas referem-se á manipulação dos <strong>produtos</strong> cadastrados no site.</p>

                        <h6><strong>→ GET</strong> <code>/api/products?minPrice=[float]&maxPrice=[float]&sort=[asc || desc]</code></h6>
                        <p>
                            Retorna uma lista de todos os produtos atualmente no banco de dados.
                            <br><br>
                            <em>Query strings</em> são <strong>opcionais</strong> e classificarão o resultado com base nos parâmetros passados.
                            <br><br>
                            <strong>Dados retornados:</strong>
                            <br><br>
                            ⇢ <em>"id"</em> -> ID do produto.<br>
                            ⇢ <em>"user_id"</em> -> ID do usuário criador do produto.<br>
                            ⇢ <em>"name"</em> -> Nome do produto.<br>
                            ⇢ <em>"description"</em> -> Descrição do produto.<br>
                            ⇢ <em>"price"</em> -> Preço do produto.<br>
                            ⇢ <em>"stock"</em> -> Quantidade em estoque.<br>
                            ⇢ <em>"onCart"</em> -> Quantidade em carrinhos de usuários.
                        </p>

                        <h6><strong>→ GET</strong> <code>/api/products/{id}</code></h6>
                        <p>Retorna o produto especificado por ID.</p>

                        <code>
                            {<br>
                                "id": 1,<br>
                                "user_id": 1,<br>
                                "name": "Nome do Produto",<br>
                                "description": "Descrição do Produto",<br>
                                "price": 1.10,<br>
                                "stock": 1,<br>
                                "onCart": 0><br>
                            }
                        </code>

                        <h6><strong>→ PUT</strong> <code>/api/products/create?name=[string]&description=[string]&price=[float]&stock=[int]</code></h6>

                        <p>
                            Cria um novo produto e o salva no banco de dados com seu ID de usuário.
                            <br><br>
                            <strong><em>Query Strings</em></strong>
                            <br><br>
                            ⇢ <em>"name"</em> <strong>(Obrigatório)</strong> -> Nome do produto. Máximo de 255 caracteres.<br>
                            ⇢ <em>"description"</em> -> Descrição do produto. Se nada for passado, <em>"No description."</em> é definido por padrão.<br>
                            ⇢ <em>"price"</em> <strong>(Obrigatório)</strong> -> Preço do produto. Valor mínimo: 0,99.<br>
                            ⇢ <em>"stock"</em> -> Quantidade do produto. Valor mínimo: 1. Valor máximo: 999. Se nada for passado, <em>"1"</em> é definido por padrão.
                            <br><br>
                            <strong>Necessário</strong>
                            <br><br>
                            ⇢ <strong><em>Bearer Token Authentication</em></strong> -> Token API.
                            <br><br>
                            Se <em>"name"</em> já estiver no banco de dados:
                        </p>
                            
                        <code>
                            {<br>
                                "response": "Product already exists",<br>
                                "id": [Product ID]<br>
                                }
                        </code>

                        <br><br>

                        <p>Se <em>"name"</em> não estiver no banco de dados, um novo produto será criado.</p>

                        <code>
                            {<br>
                                "response": "Product created succesfully!",<br>
                                "id": [New Product ID]<br>
                             }
                        </code>

                        <h6><strong>→ PATCH</strong> <code>/api/products/{id}?name=[string]&description=[string]&price=[float]&stock=[int]</code></h6>
                        
                        <p>
                            Atualiza o produto pelo seu ID com os dados passados na ​<em>query string</em>, se o produto estiver registrado com seu ID de usuário.
                            <br><br>
                            <strong><em>Query Strings</em></strong>
                            <br><br>
                            ⇢ <em>"name"</em> -> Nome do produto atualizado. Máximo de 255 caracteres.<br>
                            ⇢ <em>"description"</em> -> Nova descrição do produto.<br>
                            ⇢ <em>"price"</em> -> Preço do produto novo. Valor mínimo: 0,99.<br>
                            ⇢ <em>"stock"</em> -> Nova quantidade de produto. Valor mínimo: 0. Valor máximo: 999.
                            <br><br>
                            <strong>Necessário</strong>
                            <br><br>
                            ⇢ <strong><em>Bearer Token Authentication</em></strong> -> Token API
                            <br><br>
                            Se nenhuma <em>query string</em> for passada:
                        </p>

                        <code>
                            {<br>
                                "response": "No changes made to product ID #[Product ID]."<br>
                             }
                        </code>

                        <br><br>

                        <p>Se as <em>query strings</em> tiverem valores diferentes dos dados originais do produto:</p>

                        <code>
                            {<br>
                                "response": "Product ID #[Product ID] updated succesfully.",<br>
                                "updatedProduct": [Product JSON]<br>
                             }
                        </code>

                        <h6><strong>→ DELETE</strong> <code>/api/products/{id}</code></h6>

                        <p>Exclui um produto pelo ID.</p>

                        <code>
                            {<br>
                                "response": "Product with ID [Product ID] deleted succesfully!",<br>
                             }
                        </code>
                    </div>

                    <div id="users" class="section scrollspy">
                        <h4>Usuários</h4>

                        <p>Essas rotas referem-se á visualização dos <strong>usuários</strong> cadastrados no site.</p>

                        <h6><strong>→ GET</strong> <code>/api/users</code></h6>

                        <p>
                            Retorna uma lista de todos os usuários atualmente no banco de dados.
                            <br><br>
                            <strong>Dados retornados:</strong>
                            <br><br>
                            ⇢ <em>"id"</em> -> ID do usuário.<br>
                            ⇢ <em>"name"</em> -> Nome do usuário.<br>
                            ⇢ <em>"created_at"</em> -> Data que o usuário cadastrou-se.<br>
                            ⇢ <em>"products"</em> -> <em>Array</em> com todos os produtos criados pelo usuário, com base em seu ID.<br>
                        </p>

                        <h6><strong>→ GET</strong> <code>/api/users/{id}</code></h6>

                        <p>Retorna o usuário especificado pelo ID.</p>

                        <code>
                            {<br>
                                "id": 1,<br>
                                "name": "username",<br>
                                "email": "user@email.com",<br>
                                "created_at": "01-01-2025",<br>
                                "products": [List of User's products]<br>
                             }
                        </code>
                    </div>
                </div>

                <!-- Table of Contents -->
                <div class="col hide-on-small-only m3 l2">
                    <div class="table-of-contents-wrapper">
                        <ul class="section table-of-contents">
                            <li><a href="#introduction"><strong>Introdução</strong></a></li>
                            <li><a href="#products"><strong>Produtos</strong></a></li>
                            <li><a href="#users"><strong>Usuários</strong></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.scrollspy');
        M.ScrollSpy.init(elems, {
            scrollOffset: 100,
            throttle: 200,
            getActiveElement()
        });
    });
</script>

<style>
    .table-of-contents-wrapper {
        position: fixed;
        top: 100px;
        right: 10px;
        width: 250px;
    }
</style>

@endsection
