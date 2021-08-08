<?php

namespace RestartMe\cmd;

use pocketmine\command\CommandSender;
use RestartMe\Main;

class RTime extends BaseCommand
{

    public function __construct(Main $plugin)
    {
        parent::__construct($plugin, "rtime", "Time left for a auto restart");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (isset($args[0])) {
            $this->sendUsage($sender);
        } else {
            $this->sendMessage($sender, "§a" . gmdate("H:i:s", $this->pl->rtime) . " §6till restart!");
        }
    }

}