# Garry's Mod Loading Screen
![How it looks.](https://i.imgur.com/I8XV443.png)

## Features
* Random music with autoplay in background.
* Displays server information (Server name, number of slots, gamemode and current map name).
* Displays player information (SteamID2, name of current downloading file and current status).
* Displays server rules.
* Loading progress bar.

## Requirements
* PHP 5.4 or higher.
* SimpleXML extension.
* BCMath extension.

## Instructions
* Configure settings in the `config.php` to your liking.
* Upload all the files to your webserver.
* Set the URL of the loading screen in your `server.cfg` like that `sv_loadingurl "http://example.com/gmod-loadingscreen/?steamid=%s"`

## Credits
* [Font Awesome Free](https://github.com/FortAwesome/Font-Awesome) by @fontawesome<br>
    License: https://github.com/FortAwesome/Font-Awesome/blob/master/LICENSE.txt (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License)
* [AnimateCSS](https://github.com/daneden/animate.css) by Daniel Eden<br>
    License: https://github.com/daneden/animate.css/blob/master/LICENSE (MIT License)
* [Howler](https://github.com/goldfire/howler.js) by James Simpson and GoldFire Studios Inc.<br>
    License: https://github.com/goldfire/howler.js/blob/master/LICENSE.md (MIT License)

## License
* This project is licensed under the MIT license. (http://opensource.org/licenses/MIT)
