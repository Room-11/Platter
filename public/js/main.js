(function(Client) {
    'use strict';

    var client = new Client('ws://localhost:8080/ws').connect();

    client.addListener(function(message) {
        console.log('Received data: ');
        console.log(message);

        if (message.type === 'debug' && message.message === 'connected' ) {
            client.send({
                type: 'message',
                message: 'This is my awesome message....'
            });
        }
    })
}(Jeeves.Client));