<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public $url = null;
    public $result = array();

    public $status_recomendation_default = "Доработки не требуются";

    public $robots_isset = false;
    public $robots_status = "Файл robots.txt отсутствует";
    public $robots_recomendation = "Программист: Создать файл robots.txt и разместить его на сайте.";

    public $robots_responce = false;
    public $robots_responce_status = "При обращении к файлу robots.txt сервер возвращает код ответа (указать код)";
    public $robots_responce_recomendation = "Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200";

    public $host_isset = false;
    public $host_status = "В файле robots.txt не указана директива Host";
    public $host_recomendation = "Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.";

    public $host_count = false;
    public $host_count_status = "В файле прописано несколько директив Host";
    public $host_count_recomendation = "Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта";

    public $robots_size = false;
    public $robots_size_status = "Размера файла robots.txt составляет __, что превышает допустимую норму";
    public $robots_size_recomendation = "Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб";

    public $sitemap_isset = false;
    public $sitemap_isset_status = "В файле robots.txt не указана директива Sitemap";
    public $sitemap_isset_recomendation = "Программист: Добавить в файл robots.txt директиву Sitemap";

    public $valid = null;
    public $success = false;


    public function form(Request $request)
    {
        $request->validate([
            'site' => 'required',
        ]);

        $requestUrl = $this->parse_url_if_valid($request->site, "https");

        if (!$requestUrl) {
            return redirect()->back()->with('message', "адрес $this->url некоректный");
        } else {

            $this->url = $requestUrl;

            $fileRobots = $this->robots($requestUrl);

            if (!$fileRobots) {
                $url = $this->changeTypeHttp();

                $this->robots($url);

                if ($this->success) {

                    $this->recomendations();
                    $this->saveData();

                    $result = $this->result;

                    return view('response', compact('result'));
                } else {

                    dd("52");

                    return redirect()->back()->with('message', "адрес $this->url некоректный");
                }
            }
        }
    }

    function parse_url_if_valid($url, $type = null)
    {
        $this->url = $url;

        // Массив с компонентами URL, сгенерированный функцией parse_url()
        $arUrl = parse_url($url);
        // Возвращаемое значение. По умолчанию будет считать наш URL некорректным.
        $ret = null;

        // Если не был указан протокол, или
        // указанный протокол некорректен для url
        if (!array_key_exists("scheme", $arUrl) || !in_array($arUrl["scheme"], array("http", "https"))) {
            // Задаем протокол по умолчанию - https
            $arUrl["scheme"] = $type;
        }


        // Если функция parse_url смогла определить host
        if (array_key_exists("host", $arUrl) && !empty($arUrl["host"])) {
            // Собираем конечное значение url
            $ret = sprintf("%s://%s%s", $arUrl["scheme"],
                $arUrl["host"], $arUrl["path"]);

            // Если значение хоста не определено
            // (обычно так бывает, если не указан протокол),
            // Проверяем $arUrl["path"] на соответствие шаблона URL.
        } else if (preg_match("/^\w+\.[\w\.]+(\/.*)?$/", $arUrl["path"]))
            // Собираем URL
            $ret = sprintf("%s://%s", $arUrl["scheme"], $arUrl["path"]);

        // Если url валидный и передана строка параметров запроса
        if ($ret && empty($ret["query"]))

            $this->valid = "true";
        return $ret;
    }

    public
    function changeTypeHttp()
    {
        $url = str_replace('https://', 'http://', $this->url);

        return $url;
    }

    public
    function changeTypeHttps()
    {
        $url = str_replace('http://', 'https://', $this->url);

        return $url;
    }

    public
    function robots($url = null)
    {
        $current_url = $url . '/robots.txt'; // пример URL
        $file_headers = @get_headers($current_url);

        if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {

            $this->robots_responce = "Возникла ошибка, при получении файлов - $current_url";

        } else if ($file_headers[0] == 'HTTP/1.1 200 OK') {

            $this->robots_responce = "$current_url - HTTP/1.1 200 OK";

            // открываем файл для записи, поехали!
            $file = fopen('robots.txt', 'w');

            // инициализация cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $current_url);
            curl_setopt($ch, CURLOPT_FILE, $file);
            curl_exec($ch);
            fclose($file);
            curl_close($ch);

            global $resultfile; // описываем как глобальную переменную
            $resultfile = 'robots.txt'; // файл, который получили

            if (!file_exists($resultfile)) {

                echo "Ошибка обработки файла";
                $this->robots_responce = "Ошибка обработки файла - " . $resultfile . ". Возможно файл отсутсвует!";

            } else {

                $this->robots_isset = true;

                // Начинаем обрабатывать файл, если все прошло успешно
                $file_arr = file("robots.txt");
                $textget = file_get_contents($resultfile);
                htmlspecialchars($textget); // при желании, можно вывести на экран через echo

                if (preg_match("/Host/", $textget, $matches)) {

                    echo "Деректива Host есть";

//                     :todo кол-во директив Host

                } else {
                    echo "Дерективы Host нет";
                }

                if (preg_match("/Sitemap/", $textget, $matches)) {
                    echo "Деректива Sitemap есть";

//                      :todo кол-во директив Sitemap

                } else {
                    echo "Дерективы Sitemap нет";
                }

                echo 'Размер файла ' . $resultfile . ': ' . filesize($resultfile) . ' байт';

                $this->success = true;
            }
        }
    }

    public function recomendations()
    {
        if ($this->robots_isset){
            $this->robots_status = "Файл robots.txt присутствует";
            $this->robots_recomendation = $this->status_recomendation_default;
        }

        if ($this->host_isset){
            $this->host_status = "Директива Host указана";
            $this->host_recomendation = $this->status_recomendation_default;
        }

        if ($this->host_count){
            //            todo: count
            $this->host_count_status = "В файле прописана 1 директива Host";
            $this->host_count_recomendation = $this->status_recomendation_default;
        }

        if ($this->robots_size){
            //            todo: size
            $this->robots_size_status = "Размер файла robots.txt составляет __, что находится в пределах допустимой нормы";
            $this->robots_size_recomendation = $this->status_recomendation_default;
        }

        if ($this->sitemap_isset){
            $this->robots_size_status = "Директива Sitemap указана";
            $this->sitemap_isset_recomendation = $this->status_recomendation_default;
        }
    }

    public function saveData()
    {
        $this->result = array_add($this->result, 'robots_isset', $this->robots_isset);
        $this->result = array_add($this->result, 'robots_status', $this->robots_status);
        $this->result = array_add($this->result, 'robots_recomendation', $this->robots_recomendation);

        $this->result = array_add($this->result, 'host_isset', $this->host_isset);
        $this->result = array_add($this->result, 'host_status', $this->host_status);
        $this->result = array_add($this->result, 'host_recomendation', $this->host_recomendation);

        $this->result = array_add($this->result, 'host_count', $this->host_count);
        $this->result = array_add($this->result, 'host_count_status', $this->host_count_status);
        $this->result = array_add($this->result, 'host_count_recomendation', $this->host_count_recomendation);

        $this->result = array_add($this->result, 'robots_size', $this->robots_size);
        $this->result = array_add($this->result, 'robots_size_status', $this->robots_size_status);
        $this->result = array_add($this->result, 'robots_size_recomendation', $this->robots_size_recomendation);

        $this->result = array_add($this->result, 'sitemap_isset', $this->sitemap_isset);
        $this->result = array_add($this->result, 'sitemap_isset_status', $this->sitemap_isset_status);
        $this->result = array_add($this->result, 'sitemap_isset_recomendation', $this->sitemap_isset_recomendation);

        $this->result = array_add($this->result, 'robots_responce', $this->robots_responce);
        $this->result = array_add($this->result, 'robots_responce_status', $this->robots_responce_status);
        $this->result = array_add($this->result, 'robots_responce_recomendation', $this->robots_responce_recomendation);
    }
}
