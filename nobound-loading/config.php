<?php

return [
    /**
     * Цвет шрифта.
     * Более подробная информация о цветах HTML здесь: https://en.wikipedia.org/wiki/Web_colors.
     *
     * @var string
     */
    'fontColor' => 'rgb(250, 250, 250)',

    /**
     * Цвет панелей и индикатора выполнения.
     * Более подробная информация о цветах HTML здесь: https://en.wikipedia.org/wiki/Web_colors.
     *
     * @var string
     */
    'themeColor' => 'rgba(0, 0, 0, 0.5)',

    /**
     * Цвет определителя индикатора выполнения.
     * Более подробная информация о цветах HTML здесь: https://en.wikipedia.org/wiki/Web_colors.
     *
     * @var string
     */
    'determinateColor' => 'rgb(250, 250, 250)',

    /**
     * Цвет, путь URL или полный URL-адрес фона экрана загрузки.
     * Более подробная информация о цветах HTML здесь: https://en.wikipedia.org/wiki/Web_colors.
     *
     * @var string
     */
    'background' => 'https://i.imgur.com/WFnnBHT.jpg',

    /**
     * Путь URL или полный URL-адрес к логотипу экрана загрузки.
     * Tрекомендуемый размер логотипа - 800x156 пикселей.
     *
     * @var string
     */
    'logo' => 'https://i.imgur.com/oOB0Mle.png',

    /**
     * Плейлист с музыкой.
     * Музыка должна быть в формате OGG.
     *
     * @var array
     */
    'musicPlaylist' => [
        /**
         * Чтобы добавить музыкальный файл в плейлист, нужно создать переменные согласно шаблону.
         * [
         * 'src' => ''
         * 'volume' => ''
         * ]
         */
        [
            'src' => '/music/4everfreebrony-The_Perfect_Chair_The_Perfect_Book.ogg',

            'volume' => 0.2,
        ],
        [
            'src' => '/music/4everfreebrony-Sight-for-Sore-Eyes.ogg',

            'volume' => 0.2,
        ],
        [
            'src' => '/music/4everfreebrony-Chant_of_Mirth.ogg',

            'volume' => 0.2,
        ],
        [
            /**
             * Путь к файлу OGG.
             */
            'src' => '/music/4everfreebrony-Ambience.ogg',

            /**
             * Громкость музыки. (мин=0.0, макс=1.0).
             */
            'volume' => 0.2,
        ],
    ],

    /**
     * Правила сервера. (По одному правилу на строку.)
     * Если вы вставите более 6 правил, они будут проигнорированы.
     *
     * @var array
     */
    'rules' => [
        'Уважайте команду сервера и других игроков!',
        'Не спамьте в микрофон и не спамьте в чате!',
        'Не злоупотребляйте убийством/толканием игроков пропами!',
        'Не совершайте убийство игроков на спавне!',
        'Запрещено троллить, унижать, мешать и т.п.',
        'А так-же: https://EXAMPLE.COM/page/rules/',
    ],

    /**
     * Информация о команде сервера. (По одному участнику в строке.)
     * Если вы вставите более 3 участников, они будут проигнорированы.
     *
     * @var array
     */
    'stuff' => [
        'Nyan Cat - Администратор, Системный Администратор.',
        // 'Ponfertato - Администратор, Разработчик.',
    ],

    /**
     * Аватары для команды сервера. (По одному участнику в строке.)
     *
     * @var array
     */
    'stuff-avatars' => [
        'https://avatars.akamai.steamstatic.com/954063d1ce28246b70f3327096a551adc9f50718_full.jpg',
        // 'https://avatars.cloudflare.steamstatic.com/58244717ae4075d0430ce111d5dedbf5d4a6d047_full.jpg',
    ],

    /**
     * Названия игровых режимов.
     *
     * @var array
     */
    'gamemodesNames' => [
        'cinema' => 'Cinema',
        'sandbox' => 'Sandbox',
        //'код_игрового_режима' => 'Полное имя игрового режима'
    ],
];
