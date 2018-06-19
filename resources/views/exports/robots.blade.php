<table>
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
        <td style="background-color: @if($result['robots_isset'])green @else red @endif">@if($result['robots_isset'])Ок@elseОшибка@endif</td>
        <td>{{ $result['robots_status'] }}</td>
        <td>{{ $result['robots_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Проверка указания директивы Host</td>
        <td style="background-color: @if($result['host_isset'])green @else red @endif">@if($result['host_isset'])Ок@elseОшибка@endif</td>
        <td>{{ $result['host_status'] }}</td>
        <td>{{ $result['host_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Проверка количества директив Host, прописанных в файле</td>
        <td style="background-color: @if($result['host_count'])green @else red @endif">@if($result['host_count'])Ок@elseОшибка@endif</td>
        <td>{{ $result['host_count_status'] }}</td>
        <td>{{ $result['host_count_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">4</th>
        <td>Проверка размера файла robots.txt</td>
        <td style="background-color: @if($result['robots_size'])green @else red @endif">@if($result['robots_size'])Ок@elseОшибка@endif</td>
        <td>{{ $result['robots_size_status'] }}</td>
        <td>{{ $result['robots_size_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">5</th>
        <td>Проверка указания директивы Sitemap</td>
        <td style="background-color: @if($result['sitemap_isset'])green @else red @endif">@if($result['sitemap_isset'])Ок@elseОшибка@endif</td>
        <td>{{ $result['sitemap_isset_status'] }}</td>
        <td>{{ $result['sitemap_isset_recomendation'] }}</td>
    </tr>
    <tr>
        <th scope="row">6</th>
        <td>Проверка кода ответа сервера для файла robots.txt</td>
        <td style="background-color: @if($result['robots_responce'])green @else red @endif">@if($result['robots_responce'])Ок@elseОшибка@endif</td>
        <td>{{ $result['robots_responce_status'] }}</td>
        <td>{{ $result['robots_responce_recomendation'] }}</td>
    </tr>
    </tbody>
</table>