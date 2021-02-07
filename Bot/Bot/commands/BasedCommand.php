<?php


namespace Bot\commands;


use Bot\config\FilesManager;
use Bot\config\Utils;
use Bot\Main;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Discord\Parts\User\User;

class BasedCommand extends Command
{

    public static $cooldown = [];

    /**
     * @inheritDoc
     */
    function execute(?User $user, ?array $args, Message $message): bool
    {

        if(empty($args[1])) {

            $embed = (new Embed(Main::getDiscord()))

                ->setAuthor("Usage", "https://icons.iconarchive.com/icons/paomedia/small-n-flat/24/sign-question-icon.png")
                ->setDescription("You have to mention a ```user``` to give him a based point (with a 3 minutes cooldown) !")
                ->setColor(Utils::getColor(Utils::RED))
                ->setImage("https://cdn.discordapp.com/attachments/732798739269287966/806974978456158309/animated-line-image-0379.gif")
                ->setTimestamp(null);


            $message->channel->sendEmbed($embed);
            return true;

        }

        $mention = $message->mentions->first();

        if($mention instanceof User) {

            if(isset(self::$cooldown[$user->id]) and self::$cooldown[$user->id] > time()) {

                $cooldown = self::$cooldown[$user->id] - time();
                $embed = (new Embed(Main::getDiscord()))

                    ->setAuthor("Cooldown", "https://icons.iconarchive.com/icons/led24.de/led/16/counter-count-up-icon.png")
                    ->setDescription("You need to wait ```{$cooldown} second(s)``` to reuse this !")
                    ->setColor(Utils::getColor(Utils::RED))
                    ->setImage("https://cdn.discordapp.com/attachments/732798739269287966/806974978456158309/animated-line-image-0379.gif")
                    ->setTimestamp(null);

                $message->channel->sendEmbed($embed);
                return true;

            }

            FilesManager::setBased($mention->id);
            $embed = (new Embed(Main::getDiscord()))

                ->setAuthor("Based", "https://icons.iconarchive.com/icons/custom-icon-design/flatastic-4/128/Hot-icon.png")
                ->setDescription("<@{$user->id}> gave <@{$mention->id}> a based point ! now he got **" . FilesManager::getBased($mention->id) . " based points !**")
                ->setColor(Utils::getColor(Utils::PINK))
                ->setImage("https://cdn.discordapp.com/attachments/732798739269287966/806974978456158309/animated-line-image-0379.gif")
                ->setTimestamp(null);


            $message->channel->sendEmbed($embed);
            self::$cooldown[$user->id] = time() + (60 * 3);

            return true;

        }

        return true;

    }
}