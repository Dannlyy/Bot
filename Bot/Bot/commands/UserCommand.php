<?php


namespace Bot\commands;


include_once 'Bot/commands/Command.php';
include_once './Bot/config/Utils.php';

use Bot\config\FilesManager;
use Bot\config\Utils;
use Bot\Main;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Discord\Parts\User\User;

class UserCommand extends Command
{

    /**
     * @param User|null $user
     * @param array|null $args
     * @param Message $message
     * @return bool
     * @throws \Exception
     */

    public function execute(?User $user, ?array $args, Message $message) : bool {

        if(empty($args[1])) {

            $embed = (new Embed(Main::getDiscord()))

                ->setAuthor("Usage", "https://icons.iconarchive.com/icons/paomedia/small-n-flat/24/sign-question-icon.png")
                ->setDescription("You have to mention a ```user``` or add an ```ID``` to see a user profile informations !")
                ->setColor(Utils::getColor(Utils::RED))
                ->setImage("https://cdn.discordapp.com/attachments/732798739269287966/806974978456158309/animated-line-image-0379.gif")
                ->setTimestamp(null);


            $message->channel->sendEmbed($embed);
            return true;

        }

        $mention = $message->mentions->first();

        if($mention instanceof User) {

            $embed = (new Embed(Main::getDiscord()))

                ->setAuthor("Informations", "https://icons.iconarchive.com/icons/paomedia/small-n-flat/128/window-icon.png")
                ->setDescription("The user <@{$mention->id}> has said the n-word : **" . FilesManager::getNigga($mention->id) . " times !**")
                ->setColor(Utils::getColor(Utils::PINK))
                ->setImage("https://cdn.discordapp.com/attachments/732798739269287966/806974978456158309/animated-line-image-0379.gif")
                ->setTimestamp(null);


            $message->channel->sendEmbed($embed);
            return true;

        }

        return true;

    }


}