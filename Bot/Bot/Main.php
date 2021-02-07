<?php

namespace Bot;


include './vendor/autoload.php';
include_once './Bot/events/onChatEvent.php';
include_once 'Bot/config/FilesManager.php';

include_once 'Bot/commands/UserCommand.php';
include_once 'Bot/commands/TopNiggersCommand.php';
include_once 'Bot/commands/NiggaCommand.php';
include_once 'Bot/commands/BasedCommand.php';
include_once 'Bot/commands/TopBasedCommand.php';
include_once 'Bot/commands/ToxicCommand.php';
include_once 'Bot/commands/TopToxicCommand.php';

use Bot\commands\BasedCommand;
use Bot\commands\NiggaCommand;
use Bot\commands\TopBasedCommand;
use Bot\commands\TopNiggersCommand;
use Bot\commands\TopToxicCommand;
use Bot\commands\ToxicCommand;
use Bot\commands\UserCommand;
use Bot\config\FilesManager;
use Bot\config\Utils;
use Bot\events\onChatEvent;
use Discord\Discord;
use Discord\Parts\User\Activity;


class Main {

    /*
     * This is the main file of the bot !
     * Here we handle some events and commands and data files too.
     */

    private static $discord;

    public function __construct()
    {

        $discord = new Discord([
            'token' => 'lmaoo',
        ]);

        // INITIAL THINGS :

        self::$discord = $discord;

        $this->onListener();
        $this->loadFiles();
        $discord->run();

    }

    /*
     * Handling events :
     */

    public function onListener() {

        $discord = self::$discord;

        $discord->on('ready', function ($discord) {

            echo "Bot turned successfully", PHP_EOL;
            $this->onCommandListener();

            // Chat Message :

            $discord->on(\Discord\WebSockets\Event::MESSAGE_CREATE, function (\Discord\Parts\Channel\Message $message, Discord $discord) {

                onChatEvent::onListen($message, $discord);

            });

        });
    }

    /*
     * Handling commands :
     */

    public function onCommandListener() {

        $discord = self::$discord;

        $discord->on(\Discord\WebSockets\Event::MESSAGE_CREATE, function (\Discord\Parts\Channel\Message $message, Discord $discord) {

            // Let's check if the message could be a command to save some computing !

            if(Utils::startsWith($message->content, ">")) {

                $command = explode(" ", $message->content);
                $commandCall = $command[(int)0];

                // THIS SHIT NOT WORKING IDK WHY :/ ANYWAY, SWITCH STATEMENT MAKE THE JOB
                /*$commands = [
                    ">user" => new UserCommand($message->author->user, $command, null, $message),
                    ">topniggers" => new TopNiggersCommand($message->author->user, null, null, $message)
                ];*/

                switch ($commandCall) {

                    case ">user":
                    case ">profile":
                    case ">info":

                        new UserCommand($message->author->user, $command, null, $message);
                        break;

                    case ">topniggers":
                    case ">topnigga":

                        new TopNiggersCommand($message->author->user, null, null, $message);
                        break;

                    case ">nigga":
                    case ">counter":

                        new NiggaCommand($message->author->user, null, null, $message);
                        break;

                    case ">based":

                        new BasedCommand($message->author->user, $command, null, $message);
                        break;

                    case ">topbased":

                        new TopBasedCommand($message->author->user, null, null, $message);
                        break;

                    case ">toxic":

                        new ToxicCommand($message->author->user, $command, null, $message);
                        break;

                    case ">toptoxic":

                        new TopToxicCommand($message->author->user, null, null, $message);
                        break;

                }

                /*if (isset($commands[$commandCall])) {

                    // Call command
                    $commands[$commandCall];
                    return;

                }*/

            }

        });

    }

    /**
     * @return Discord
     */

    public static function getDiscord() : Discord {
        return self::$discord;
    }

    /*
     * Handling data files :
     */

    public function loadFiles() {
        (new FilesManager());
    }

}



