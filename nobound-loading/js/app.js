"use strict";

function _instanceof(left, right) {
    if (
        right != null &&
        typeof Symbol !== "undefined" &&
        right[Symbol.hasInstance]
    ) {
        return !!right[Symbol.hasInstance](left);
    } else {
        return left instanceof right;
    }
}

function _classCallCheck(instance, Constructor) {
    if (!_instanceof(instance, Constructor)) {
        throw new TypeError("Cannot call a class as a function");
    }
}

function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
    }
}

function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
}

/**
 *
 */
var AudioPlayer =
    /*#__PURE__*/
    (function () {
        class AudioPlayer {
            constructor(playlist) {
                _classCallCheck(this, AudioPlayer);

                this.index = 0;
                this.playlist = playlist.sort(function () {
                    return Math.random() - 0.5;
                });
            }
        }

        _createClass(AudioPlayer, [
            {
                key: "play",
                value: function play(index) {
                    if (this.playlist.length === 0) {
                        return;
                    }

                    index = typeof index === "number" ? index : this.index;

                    if (!this.playlist[index]) {
                        throw new Error("Invalid music index provided");
                    }

                    var self = this;
                    var howl;

                    if (!this.playlist[index].howl) {
                        howl = this.playlist[index].howl = new Howl({
                            formats: ["ogg"],
                            src: [this.playlist[index].src],
                            volume: Math.min(1, Math.abs(this.playlist[index].volume)),
                            html5: true,
                            onend: function onend() {
                                self.next();
                            },
                        });
                    } else {
                        howl = this.playlist[index].howl;
                    }

                    this.stop();
                    howl.play();
                    this.index = index;
                },
            },
            {
                key: "pause",
                value: function pause() {
                    if (this.playlist[this.index].howl) {
                        this.playlist[this.index].howl.pause();
                    }
                },
            },
            {
                key: "stop",
                value: function stop() {
                    if (this.playlist[this.index].howl) {
                        this.playlist[this.index].howl.stop();
                    }
                },
            },
            {
                key: "next",
                value: function next() {
                    var index = this.index + 1;

                    if (index >= this.playlist.length) {
                        index = 0;
                    }

                    return this.skipTo(index);
                },
            },
            {
                key: "skipTo",
                value: function skipTo(index) {
                    this.stop();
                    this.play(index);
                },
            },
        ]);

        return AudioPlayer;
    })();

/**
 *
 */
var LoadingScreen =
    /*#__PURE__*/
    (function () {
        class LoadingScreen {
            constructor(gamemodes) {
                _classCallCheck(this, LoadingScreen);

                this.totalFiles = 1;
                this.neededFiles = 1;
                this.gamemodes = gamemodes;
                this.$ = {
                    serverName: document.getElementById("server_name"),
                    serverMap: document.getElementById("server_map"),
                    serverSlots: document.getElementById("server_slots"),
                    serverGamemode: document.getElementById("server_gamemode"),
                    clientStatus: document.getElementById("client_status"),
                    downloadingFile: document.getElementById("downloading_file"),
                    progressPercent: document.getElementById("progress_percent"),
                    progressPercentText: document.getElementById("progress_percent_text"),
                };
            }
        }

        _createClass(LoadingScreen, [
            {
                key: "setFilesNeeded",
                value: function setFilesNeeded(files) {
                    this.neededFiles = Math.min(1, files);
                },
            },
            {
                key: "setTotalFiles",
                value: function setTotalFiles(files) {
                    this.totalFiles = Math.min(1, files);
                },
            },
            {
                key: "setServerInfo",
                value: function setServerInfo(
                    serverName,
                    mapName,
                    maxPlayers,
                    gamemodeName
                ) {
                    this.$.serverName.innerHTML = serverName;
                    this.$.serverMap.innerHTML = mapName;
                    this.$.serverSlots.innerHTML = maxPlayers;
                    this.$.serverGamemode.innerHTML =
                        this.transformGamemodeName(gamemodeName);
                },
            },
            {
                key: "onStatusChanged",
                value: function onStatusChanged(status) {
                    this.$.clientStatus.innerHTML = status;

                    if (status === "Sending client info...") {
                        this.$.progressPercentText.textContent = "100%";
                        this.$.progressPercent.style.width = "100%";
                    }
                },
            },
            {
                key: "onFileDownloading",
                value: function onFileDownloading(file) {
                    var percent = Math.floor(
                        ((this.totalFiles - this.neededFiles) / this.totalFiles) * 100
                    );
                    this.$.downloadingFile.innerHTML = file;
                    this.$.progressPercentText.textContent = percent + "%";
                    this.$.progressPercent.style.width = percent + "%";
                },
            },
            {
                key: "transformGamemodeName",
                value: function transformGamemodeName(gamemodeName) {
                    return (
                        this.gamemodes[gamemodeName] ||
                        String(gamemodeName)
                            .replace("_", " ")
                            .replace("-", " ")
                            .replace(/\w\S*/g, function (s) {
                                return s.charAt(0).toUpperCase() + s.substr(1);
                            })
                    );
                },
            },
        ]);

        return LoadingScreen;
    })();
