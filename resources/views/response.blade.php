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
    <link href="{{ asset('css/starter-template.css') }}" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="{{ url('/') }}">Proba pera</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto"></ul>
        <form action="{{ action('WebController@form') }}" method="post" class="form-inline my-2 my-lg-0">
            {{ csrf_field() }}

            <input name="site" type="text" class="form-control mr-sm-2" placeholder="адрес сайта" aria-label="Search" required autofocus>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Проверить</button>
        </form>
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template">
        <form action="{{ action('WebController@form') }}" method="post" class="form-signin">
            {{ csrf_field() }}

            <h1 class="h3 mb-3 font-weight-normal">Укажите адрес сайта</h1>
            <label for="site" class="sr-only">Адрес сайта</label>
            <input name="site" type="text" id="site" class="form-control" placeholder="адрес сайта" required autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Проверить</button>

            @if(session()->has('message'))
                <div class="alert alert-warning">
                    {{ session()->get('message') }}
                </div>
            @endif
        </form>


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
                        <td class="@if($result['robots_isset'])green @else red @endif">@if($result['robots_isset'])Ок@elseОшибка@endif</td>
                        <td>{{ $result['robots_status'] }}</td>
                        <td>{{ $result['robots_recomendation'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Проверка указания директивы Host</td>
                        <td class="@if($result['host_isset'])green @else red @endif">@if($result['host_isset'])Ок@elseОшибка@endif</td>
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
                        <td class="@if($result['sitemap_isset'])green @else red @endif">@if($result['sitemap_isset'])Ок@elseОшибка@endif</td>
                        <td>{{ $result['sitemap_isset_status'] }}</td>
                        <td>{{ $result['sitemap_isset_recomendation'] }}</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Проверка кода ответа сервера для файла robots.txt</td>
                        <td class="@if($result['robots_responce'])green @else red @endif">@if($result['robots_responce'])Ок@elseОшибка@endif</td>
                        <td>{{ $result['robots_responce_status'] }}</td>
                        <td>{{ $result['robots_responce_recomendation'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
