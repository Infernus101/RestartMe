<?php

namespace RestartMe\cmd;

use RestartMe\Main;

final class CommandFactory
{

    public const COMMANDS = [
        RTime::class,
    ];

    private Main $plugin;

    /**
     * CommandFactory constructor.
     * @param Main $plugin
     */
    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function init(): void
    {
        $commands = [];
        foreach (self::COMMANDS as $commandClass) {
            $commands[] = new $commandClass($this->plugin);
        }
        $this->plugin->getServer()->getCommandMap()->registerAll('RestartMe', $commands);
        $this->plugin->getServer()->getLogger()->info("§f=> §eRegistered §d" . count($commands) . " §ecommands! §f<=");
    }

}