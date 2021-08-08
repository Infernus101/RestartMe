<?php

namespace RestartMe\task;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use RestartMe\Main;

class SecondTask extends Task
{

    /** @var Main */
    private Main $plugin;

    /**
     * SecondTask constructor.
     * @param Main $plugin
     */
    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick): void
    {
        $rtime = $this->plugin->rtime;
        if ($rtime <= 10 && $rtime > 0) {
            $extra = ($rtime !== 1) ? "s" : "";
            $this->plugin->getServer()->broadcastMessage(Main::PREFIX . TextFormat::GREEN . "Server restarting in " . TextFormat::RED . "{$rtime} " . TextFormat::GREEN . "second" . $extra . "...");
        } elseif ($rtime === 60) {
            $this->plugin->getServer()->broadcastMessage(Main::PREFIX . TextFormat::RED . "Server is going to restart in 1 minute...!");
        } elseif ($rtime <= 0) {
            $this->plugin->getServer()->shutdown();
        }
        --$this->plugin->rtime;
    }

}