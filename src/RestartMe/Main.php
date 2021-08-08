<?php

namespace RestartMe;

use pocketmine\plugin\PluginBase;
use RestartMe\cmd\CommandFactory;
use RestartMe\task\SecondTask;

class Main extends PluginBase
{

    public const PREFIX = "§a§l[§bRestart§a]>§r§c ";

    private static ?Main $object = null;

    public int $rtime = 0;

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$object;
    }

    public function onEnable(): void
    {
        $this->loadConfig();
        $this->initialize();
        $this->registerCommands();
    }

    public function loadConfig(): void
    {
        $this->saveDefaultConfig();
    }

    private function initialize(): void
    {
        $this->rtime = $this->getConfig()->get("restart-time", 60) * 60;
        $this->getScheduler()->scheduleRepeatingTask(new SecondTask($this), 20);
    }

    public function registerCommands(): void
    {
        (new CommandFactory($this))->init();
    }

    public function onLoad(): void
    {
        if (!self::$object instanceof Main) self::$object = $this;
    }

}