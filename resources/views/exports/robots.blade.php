<style>
    .top-title {
        background-color: #006f9c;
    }

    thead tr{
        background-color: #00A1DA;
        border: 1px solid grey;
    }

    .top-title strong{
        font-weight: bold;
        color: black;
    }

    td.td{
        text-align: center;
    }
</style>

<table>
    <thead>
    <tr>
        <th scope="col" class="top-title" style="background-color: #00A1DA;"><strong>#</strong></th>
        <th scope="col" class="top-title" style="background-color: #00A1DA;"><strong>Название проверки</strong></th>
        <th scope="col" class="top-title" style="background-color: #00A1DA;"><strong>Статус</strong></th>
        <th scope="col" class="top-title" style="background-color: #00A1DA;"><strong>Текущее состояние</strong></th>
        <th scope="col" class="top-title" style="background-color: #00A1DA;"><strong>Рекомендации</strong></th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <th scope="row">1</th>
        <td> Проверка наличия файла robots.txt</td>
        <td class="td"
            @if($result['robots_isset'])
                style="background-color: #369C0E; text-align:center;"
            @else
                style="background-color: #e11308; text-align:center;"
            @endif>
            @if($result['robots_isset'])
                Ок
            @else
                Ошибка
            @endif
        </td>
        <td>{{ $result['robots_status'] }}</td>
        <td>{{ $result['robots_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Проверка указания директивы Host</td>
        <td class="td"
        @if($result['host_isset'])
            style="background-color: #369C0E; text-align:center;"
        @else
            style="background-color: #e11308; text-align:center;"
        @endif>
        @if($result['host_isset'])
            Ок
        @else
            Ошибка
        @endif
        </td>

        <td>{{ $result['host_status'] }}</td>
        <td>{{ $result['host_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Проверка количества директив Host, прописанных в файле</td>
        <td class="td"
            @if($result['host_count'])
                style="background-color: #369C0E; text-align:center;"
            @else
                style="background-color: #e11308; text-align:center;"
            @endif>
            @if($result['host_count'])
                Ок
            @else
                Ошибка
            @endif
        </td>

        <td>{{ $result['host_count_status'] }}</td>
        <td>{{ $result['host_count_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">4</th>
        <td>Проверка размера файла robots.txt</td>
        <td class="td"
            @if($result['robots_size'])
                style="background-color: #369C0E; text-align:center;"
            @else
                style="background-color: #e11308; text-align:center;"
            @endif>
            @if($result['robots_size'])
                Ок
            @else
                Ошибка
            @endif
        </td>


        <td>{{ $result['robots_size_status'] }}</td>
        <td>{{ $result['robots_size_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">5</th>
        <td>Проверка указания директивы Sitemap</td>
        <td class="td"
            @if($result['sitemap_isset'])
                style="background-color: #369C0E; text-align:center;"
            @else
                style="background-color: #e11308; text-align:center;"
            @endif>
            @if($result['sitemap_isset'])
                Ок
            @else
                Ошибка
            @endif
        </td>

        <td>{{ $result['sitemap_isset_status'] }}</td>
        <td>{{ $result['sitemap_isset_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">6</th>
        <td>Проверка кода ответа сервера для файла robots.txt</td>
        <td class="td"
            @if($result['robots_responce'])
                style="background-color: #369C0E; text-align:center;"
            @else
                style="background-color: #e11308; text-align:center;"
            @endif>
            @if($result['robots_responce'])
                Ок
            @else
                Ошибка
            @endif
        </td>

        <td>{{ $result['robots_responce_status'] }}</td>
        <td>{{ $result['robots_responce_recomendation'] }}</td>
    </tr>
    </tbody>
</table>