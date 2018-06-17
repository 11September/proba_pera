<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Proba pera</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .wrapper-form{
            width:100%;
            height:500px;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="wrapper-form">
                <form action="{{ action('WebController@form') }}" method="post" class="form-signin">
                    {{ csrf_field() }}

                    <h1 class="h3 mb-3 font-weight-normal">Укажите адрес сайта</h1>
                    <label for="site" class="sr-only">Адрес сайта</label>
                    <input name="site" type="text" id="site" class="form-control" placeholder="адрес сайта" required
                           autofocus>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Проверить</button>

                    @if(session()->has('message'))
                        <div class="alert alert-warning">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название проверки</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Текущее состояние</th>
                    <th scope="col">Рекомендации</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Проверка наличия файла robots.txt</td>
                    <td>Ок</td>
                    <td>{{ $result['robots_status'] }}</td>
                    <td>{{ $result['robots_recomendation'] }}</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Проверка указания директивы Host</td>
                    <td>Ок</td>
                    <td>{{ $result['host_status'] }}</td>
                    <td>{{ $result['host_recomendation'] }}</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Проверка количества директив Host, прописанных в файле</td>
                    <td>Ок</td>
                    <td>{{ $result['host_count_status'] }}</td>
                    <td>{{ $result['host_count_recomendation'] }}</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Проверка размера файла robots.txt</td>
                    <td>Ок</td>
                    <td>{{ $result['robots_size_status'] }}</td>
                    <td>{{ $result['robots_size_recomendation'] }}</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Проверка указания директивы Sitemap</td>
                    <td>Ок</td>
                    <td>{{ $result['sitemap_isset_status'] }}</td>
                    <td>{{ $result['sitemap_isset_recomendation'] }}</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Проверка кода ответа сервера для файла robots.txt</td>
                    <td>Ок</td>
                    <td>{{ $result['robots_responce_status'] }}</td>
                    <td>{{ $result['robots_responce_recomendation'] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>