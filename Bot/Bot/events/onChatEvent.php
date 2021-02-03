<?php

namespace Bot\events;

include 'Bot/config/Config.php';

use Bot\config\Config;
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

                $embed = (new Embed($discord))

                    ->setAuthor($message->author->username . "#" . $message->author->discriminator, $message->author->user->avatar)
                    ->setDescription("<@" . $message->author->id . "> **used the n word :** " . $message->content)
                    ->setColor(Config::getColor(Config::RED))
                    ->setTimestamp(null);

                $discord->getChannel(Config::getLogsChannel())->sendEmbed($embed);
                break;

            }
        }

    }

}