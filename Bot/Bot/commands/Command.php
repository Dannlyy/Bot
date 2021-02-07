<?php


namespace Bot\commands;


use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;
use Discord\Parts\User\User;

abstract class Command
{

    private $args;
    private $sender;
    private $permission = null;

    /**
     * Command constructor.
     * @param $sender
     * @param array|null $args
     * @param null $permission
     * @param Message $message
     */

    public function __construct($sender, ?array $args = null, $permission = null, Message $message)
    {

        $this->sender = $sender;
        $this->args = $args;
        $this->permission = $permission;

        $this->execute($sender, $args, $message);

    }

    /**
     * @param User|null $user
     * @param array|null $args
     * @param Message $message
     * @return bool
     */

    abstract function execute(?User $user, ?array $args, Message $message) : bool;

    /*
     * Some useful commands !
     * For permission, checking ect..
     */

    /**
     * @param string|null $permission
     */

    public function setPermission(?string $permission) : void {
        $this->permission = $permission;
    }

    /**
     * @param $id
     * @return bool
     */

    public function hasPermission($id) : bool {

    }


}