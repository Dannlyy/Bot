<?php


namespace Bot\commands;


include_once 'Bot/commands/Command.php';
include_once './Bot/config/Utils.php';

use Bot\config\FilesManager;
use Bot\config\Utils;
use Bot\Main;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Discord\Parts\User\User;

class NiggaCommand extends Command
{

    /**
     * @inheritDoc
     */
    function execute(?User $user, ?array $args, Message $message): bool
    {

        $file = FilesManager::getNiggerFile();
        $count = 0;

        foreach ($file->getAll() as $id => $amount) {
            $count += $amount;
        }

        $embed = (new Embed(Main::getDiscord()))

            ->setAuthor("Nigga counter", "https://icons.iconarchive.com/icons/yusuke-kamiyamane/fugue/16/counter-count-up-icon.png")
            ->setDescription("We have reached an amount of **{$count}** nigga word said in the chat OwO")
            ->setColor(Utils::getColor(Utils::PINK))
            ->setImage("https://cdn.discordapp.com/attachments/732798739269287966/806974978456158309/animated-line-image-0379.gif")
            ->setTimestamp(null);


        $message->channel->sendEmbed($embed);
        return true;

    }
}