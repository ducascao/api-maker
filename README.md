# ApiMaker

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

Cria endpoints de API de maneira rápida com services e repository.

## Instalação

Via Composer

``` bash
$ composer require ducascao/api-maker
```

* Publicar os stubs para a criação dos arquivos:

``` bash
$ php artisan api-maker:stub-publish
```

## Configuração

* Abra o arquivo de rotas e registre as rotas do projeto:

``` php
ApiMaker::routes();
```
* Adicione o seguinte marcador `/** API Maker: Routes */` para que o ApiMaker implemente automaticamente as rotas criadas:

``` php
Route::group(['middleware' => 'auth:api'], function () {
    /** API Maker: Routes */
});
```

## Uso

* Para utilizá-lo, basta consumir o seguinte endpoint de acordo com o registro feito na configuração:

```
POST /build/project
```

* Exemplo de request:

``` json
{
  "tables": [
    {
      "name": "Template",
      "fields": [
        {
          "name": "description",
          "type": "string"
        },
        {
          "name": "path",
          "type": "string"
        }
      ]
    },
    {
      "name": "Customer",
      "fields": [
        {
          "name": "name",
          "type": "string"
        },
        {
          "name": "phone_number",
          "type": "string",
          "required": false
        },
        {
          "name": "email",
          "type": "string",
          "required": false
        },
        {
          "name": "template_id",
          "type": "unsignedInteger",
          "required": false,
          "relationship": {
            "table": "templates"
          }
        }
      ]
    }
  ]
}
```

* Registre os seguintes providers no seu arquivo config/app.php:

``` php
/*
* Application Service Providers...
*/
App\Providers\DomainServiceProvider::class,
App\Providers\RepositoryServiceProvider::class,
```

**Atenção**

>Ao montar o json, respeite o relacionamento das tabelas. A ordem do array também será a ordem das migrations.

## Corpo da Request (JSON)

| Atributo      | Tipo          | Descrição     |
| :------------ | :-----------: | :-----------: |
| tables        | [Table object](#table-object)  | Array de objeto contendo todas as tabelas do projeto  |

### Table object

| Atributo      | Tipo          | Descrição     |
| :------------ | :-----------: | :-----------: |
| name          | string        | Nome da tabela em pascal case no singular |
| fields        | [Field object](#field-object)  | Array de objeto contendo o campos da tabela |

### Field object

| Atributo      | Tipo          | Descrição     |
| :------------ | :-----------: | :-----------: |
| name          | string  | Nome do campo |
| type          | string  | Tipo do campo de acordo com a doc do [Laravel](https://laravel.com/docs/7.x/migrations) |
| required      | boolean | Identifica se o campo é obrigatório |
| relationship  | string  | Tabela relacionada ao campo criado em plural snake case |

## Creditos

- [Eduardo de Assis Leite][link-author]
- [Caique Benassi Bertolozzi](https://github.com/caiquebb)

## Licença

MIT. Por favor, consulte o [arquivo de licença](license.md) pra mais informações.

[ico-version]: https://img.shields.io/packagist/v/ducascao/api-maker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ducascao/api-maker.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ducascao/api-maker/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/ducascao/api-maker
[link-downloads]: https://packagist.org/packages/ducascao/api-maker
[link-travis]: https://travis-ci.org/ducascao/api-maker
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/ducascao
[link-contributors]: ../../contributors
