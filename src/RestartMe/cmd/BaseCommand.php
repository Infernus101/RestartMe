<?php


namespace RestartMe\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use RestartMe\Main;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand
{

    public Main $pl;

    public bool $consoleUsageMessage;

    /**
     * BaseCommand constructor.
     * @param Main $plugin
     * @param string $name
     * @param string $description
     * @param string $usageMessage
     * @param array $aliases
     */
    public function __construct(Main $plugin, string $name, string $description = "", string $usageMessage = "", array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->pl = $plugin;
    }

    /**
     * @return string
     */
    public function getUsage(): string
    {
        return "/" . parent::getName() . " " . parent::getUsage();
    }

    /**
     * @return Plugin
     */
    public function getPlugin(): Plugin
    {
        return $this->pl;
    }

    /**
     * @param CommandSender $sender
     * @param ?string $alias
     * @param bool $isConsole
     */
    public function sendUsage(CommandSender $sender, ?string $alias = null, bool $isConsole = false): void
    {
        $alias = $alias ?? $this->getName();
        $message = TextFormat::GOLD . "Usage: " . TextFormat::GRAY . "/$alias ";
        if (!$sender instanceof Player) {
            if (!$isConsole) {
                $message = TextFormat::RED . "[Error] Please run this command in-game";
            } elseif (is_string($this->consoleUsageMessage)) {
                $message .= $this->consoleUsageMessage;
            } else {
                $message .= str_replace("[player]", "<player>", parent::getUsage());
            }
        } else {
            $message .= parent::getUsage();
        }
        $this->sendMessage($sender, $message);
    }

    /**
     * @param CommandSender $sender
     * @param string $message
     */
    public function sendMessage(CommandSender $sender, string $message): void
    {
        $sender->sendMessage(Main::FT_PREFIX . TextFormat::GOLD . $message);
    }

}