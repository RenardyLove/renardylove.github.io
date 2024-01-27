<?php

/* `error_reporting(0)` устанавливает уровень сообщения об ошибках на 0, что означает, что никакие ошибки не будут
отображаться. `ini_set('display_errors', 'Off')` отключает отображение ошибок. Это делается для того, чтобы
предотвратить отображение сообщений об ошибках на экране загрузки, что может отвлекать или
сбить пользователя с толку. */
error_reporting(0);
ini_set('display_errors', 'Off');

/* ` = require(__DIR__ . '/config.php');` включает файл `config.php` и присваивает его
его содержимое переменной ``. Функция `require` используется для включения файла в PHP, а
`__DIR__` - это магическая константа, которая представляет каталог текущего файла. Таким образом, эта
строка кода включает файл `config.php`, который находится в том же каталоге, что и текущий
файлом, и присваивает его содержимое переменной ``. */
$config = require(__DIR__ . '/config.php');

/* `` - это массив, содержащий значения по умолчанию для имени игрока и SteamID. Если
SteamID игрока указан в строке запроса, эти значения по умолчанию будут заменены на
фактическими значениями, полученными из SteamAPI. */
$profile = [
    'name' => 'Неизвестный',
    'steamid' => 'STEAM_X:Y:Z',
];

/* Этот блок кода проверяет, установлен ли параметр `steamid` в строке запроса URL. Если он установлен
установлен, он извлекает информацию об игроке с помощью SteamAPI, делая запрос на URL
`https://steamcommunity.com/profiles/{steamid}/?xml=1`, где `{steamid}` - значение параметра
параметра `steamid`. Затем он извлекает имя игрока из XML-ответа с помощью XPath и
присваивает его переменной `['name']`. */
if (isset($_GET['steamid'])) {

    /* Этот блок кода получает информацию об игроке с помощью SteamAPI, делая запрос по адресу
    URL `https://steamcommunity.com/profiles/{steamid}/?xml=1`, где `{steamid}` - значение параметра
    параметра `steamid` в строке запроса URL. Затем создается новый объект `SimpleXMLElement`
    объект с XML-ответом, извлекает имя игрока из XML с помощью XPath и
    присваивает его переменной `['name']` в массиве `'. */
    $profile = new SimpleXMLElement(sprintf('https://steamcommunity.com/profiles/%s/?xml=1', $_GET['steamid']), null, true);
    $profile['name'] = $profile->xpath('/profile/steamID')[0];

    /* Этот блок кода преобразует 64-битный SteamID, указанный в параметре `steamid` строки запроса URL
    в 32-битный формат, используемый некоторыми старыми играми на движке Source. Это делается путем
    вычитания константы `76561197960265728` из 64-битного SteamID, что дает 32-битное
    представление SteamID. Затем он извлекает компоненты `authserver` и `authid` из
    32-битного SteamID и форматирует их в формат `STEAM_0:X:Y`, используемый старыми играми.
    Наконец, он присваивает отформатированный SteamID переменной `['steamid']` в массиве `'. */
    $authserver = bcsub($_GET['steamid'], '76561197960265728') & 1;
    $authid = (bcsub($_GET['steamid'], '76561197960265728') - $authserver) / 2;
    $profile['steamid'] = "STEAM_0:{$authserver}:{$authid}";
}

/* Код проверяет, содержит ли переменная `['background']` значение цвета в виде
шестнадцатеричного кода (`#`), `rgb(` или `rgba(`. Если она не содержит ни одного из этих значений, то предполагается, что
значение является URL-адресом изображения и форматирует его как значение CSS `url()`. */
if ((stristr($config['background'], '#') || stristr($config['background'], 'rgb(') || stristr($config['background'], 'rgba(')) === false) {
    $config['background'] = sprintf('url(\'%s\')', $config['background']);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Экран загрузки</title>
    <meta name=“robots” content=“noindex,nofollow”>
    <meta name="language" content="en">
    <meta name="charset" content="utf-8">
    <link type="text/css" rel="stylesheet" href="css/animate.min.css" media="screen,projection">
    <link type="text/css" rel="stylesheet" href="css/app.css" media="screen,projection">
</head>

<body style="background: <?php print $config['background']; ?>; color: <?php print (string)$config['fontColor']; ?>"
      lang='en'>
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Logo Wrapper -->
    <div class="logo-wrapper">
        <div class="animated zoomInDown">
            <img src="<?php print (string)$config['logo']; ?>">
        </div>
    </div>
    <!-- Card Wrapper -->
    <div class="card-wrapper">
        <!-- Server and player information -->
        <div class="card-panel animated zoomInLeft"
             style="background-color: <?php print (string)$config['themeColor']; ?>;">
            <table class="table-right">
                <colgroup>
                    <col width="9%">
                    <col width="20%">
                    <col width="71%">
                </colgroup>
                <tbody>
                <tr class="table-title" style="border-color: <?php print (string)$config['fontColor']; ?>;">
                    <td colspan="3">Информация о сервере</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-home icon"></i>
                    </td>
                    <td>Имя:</td>
                    <td id="server_name">Подключение...</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-globe icon"></i>
                    </td>
                    <td>Карта:</td>
                    <td id="server_map">Название карты</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-users icon"></i>
                    </td>
                    <td>Игроков:</td>
                    <td id="server_slots">32</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-code icon"></i>
                    </td>
                    <td>Режим:</td>
                    <td id="server_gamemode">Игровой режим</td>
                </tr>
                <tr class="table-title"
                    style="border-top: 1px solid <?php print (string)$config['fontColor']; ?>; border-color: <?php print (string)$config['fontColor']; ?>;">
                    <td colspan="3">Информация об игроке</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-user icon"></i>
                    </td>
                    <td>Имя:</td>
                    <td><?php print $profile['name']; ?></td>
                </tr>
                <tr>
                    <td>
                        <i class="fab fa-steam-symbol icon"></i>
                    </td>
                    <td>SteamID:</td>
                    <td><?php print $profile['steamid']; ?></td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-download icon"></i>
                    </td>
                    <td>Файл:</td>
                    <td id="downloading_file">Отсутствие загрузки файлов...</td>
                </tr>
                <tr>
                    <td>
                        <i class="fas fa-sync-alt icon"></i>
                    </td>
                    <td>Состояние:</td>
                    <td id="client_status">Получение информации о сервере...</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- Rules and staff information -->
        <div class="card-panel animated zoomInRight"
             style="background-color: <?php print (string)$config['themeColor']; ?>">
            <table class="table-left"
                   <?php if (count($config['rules']) < 6) : ?>style="height: auto; !important;" <?php endif; ?>>
                <colgroup>
                    <col width="9%">
                    <col width="91%">
                </colgroup>
                <tbody>
                <tr class="table-title" style="border-color: <?php print (string)$config['fontColor']; ?>;">
                    <td colspan="2">Правила игры на сервере</td>
                </tr>
                <?php $count = count($config['rules']); ?>
                <?php for ($i = 0; $i < $count; $i++) : ?>
                    <?php if ($i >= 6) break; ?>
                    <tr>
                        <td><?php print sprintf('%02d.', $i + 1); ?></td>
                        <td><?php print $config['rules'][$i]; ?></td>
                    </tr>
                <?php endfor; ?>
                <tr class="table-title" style="border-color: <?php print (string)$config['fontColor']; ?>;">
                    <td colspan="2">Информация о команде сервера</td>
                </tr>
                <?php $count = count($config['stuff-avatars']); ?>
                <?php for ($i = 0; $i < $count; $i++) : ?>
                    <?php if ($i >= 3) break; ?>
                    <tr>
                        <td><img style="height: auto; width: 35px; border-radius: 100px;"
                                 src="<?php print (string)$config['stuff-avatars'][$i]; ?>" class="stuff-wrapper" ;>
                        </td>
                        <td><?php print $config['stuff'][$i]; ?></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Progress Wrapper -->
    <div class="progress-wrapper">
        <div class="progress animated zoomInUp" style="background-color: <?php print (string)$config['themeColor']; ?>">
            <div id="progress_percent" class="determinate"
                 style="width: 0; background-color: <?php print (string)$config['determinateColor']; ?>"></div>
            <div id="progress_percent_text">0%</div>
        </div>
    </div>
</div> <!-- Javascript code -->
<script src="/js/howler.min.js"></script>
<script src="/js/fontawesome.min.js"></script>
<script src="/js/app.js"></script>
<script>
    /**
     *
     */
    const audioPlayer = new AudioPlayer(JSON.parse('<?php print json_encode((array)$config['musicPlaylist']); ?>'));

    audioPlayer.play();

    /**
     *
     */
    const loadingScreen = new LoadingScreen(<?php print json_encode((array)$config['gamemodesNames']); ?>);

    /**
     * @param {String} file
     */
    window.SetStatusChanged = function (status) {
        loadingScreen.onStatusChanged(status);
    }

    /**
     * @param {Number} file
     */
    window.SetFilesNeeded = function (status) {
        loadingScreen.setNeededFiles(status);
    }

    /**
     * @param {Number} file
     */
    window.SetFilesTotal = function (status) {
        loadingScreen.setTotalFiles(status);
    }

    /**
     * @param {String} file
     */
    window.DownloadingFile = function (file) {
        loadingScreen.onFileDownloading(file);
    }

    /**
     * @param {String} serverName
     * @param {String} serverUrl
     * @param {String} mapName
     * @param {Number} maxPlayers
     * @param {String} steamId
     * @param {String} gamemodeName
     */
    window.GameDetails = function (serverName, serverUrl, mapName, maxPlayers, steamId, gamemodeName) {
        loadingScreen.setServerInfo(serverName, mapName, maxPlayers, gamemodeName);
    };
</script>
</body>

</html>