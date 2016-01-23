var Jeeves = Jeeves || {};

Jeeves.Client = (function() {
    'use strict';

    var _url;
    var _connection;
    var _listeners = [];

    function Client(url) {
        _url = url;
    }

    Client.prototype.connect = function() {
        _connection = new WebSocket(_url);

        _connection.addEventListener('message', this.onData.bind(this));

        return this;
    };

    Client.prototype.send = function (message) {
        _connection.send(JSON.stringify(message));
    };

    Client.prototype.addListener = function(callback) {
        _listeners.push(callback);
    };

    Client.prototype.onData = function(e) {
        _listeners.forEach(function(listener) {
            listener(JSON.parse(e.data));
        });
    };

    return Client;
}());
