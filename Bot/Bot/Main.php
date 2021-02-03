<?php

namespace Bot;

include './vendor/autoload.php';
include './Bot/events/onChatEvent.php';
use Discord\Discord;


class Main {

    private $discord;

    public function __construct()
    {

        $discord = new Discord([
            'token' => 'token',
        ]);
        $this->discord = $discord;

        $this->onEventListener();
        $discord->run();

    }

    /*
     * Handle
     */

    public function onEventListener() {

        $discord = $this->discord;

        $discord->on('ready', function ($discord) {

            echo "Bot turned successfully";

            // Chat Message :

            $discord->on(\Discord\WebSockets\Event::MESSAGE_CREATE, function (\Discord\Parts\Channel\Message $message, Discord $discord) {
                onChatEvent::onListen($message, $discord);
            });

        });
    }

}



