<?php

namespace Bot\events;

include_once './Bot/config/Utils.php';

use Bot\config\FilesManager;
use Bot\config\Utils;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;

class onChatEvent
{

    public static function onListen(Message $message, Discord $discord) {

        $niggaFamily = ["nigga", "nigger", "3zi", "3zwa", "nega", "niga", "neggro", "negro"];
        if($message->author->username === $discord->username) return false;

        foreach ($niggaFamily as $words) {
            if(strpos(strtolower($message->content), $words) !== false) {

                // LOGS :

                $embed = (new Embed($discord))

                    ->setAuthor($message->author->username . "#" . $message->author->discriminator, (string)$message->author->user->avatar)
                    ->setDescription("<@" . $message->author->id . "> **used the n word :** " . $message->content)
                    ->setColor(Utils::getColor(Utils::RED))
                    ->setTimestamp(null);

                $discord->getChannel(Utils::getLogsChannel())->sendEmbed($embed);

                // ADDING TO DB :
                FilesManager::setNigga($message->author->id);

                break;

            }
        }

    }

}