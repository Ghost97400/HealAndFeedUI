<?php

namespace ghost;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class HealAndFeedUI extends PluginBase implements Listener{

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        $commandname = $command;
        if($commandname == "hfui"){
            if($sender instanceof Player){
                $this->hfui($sender);
            }
        }
    return true;
    }

    public function hfui(Player $player){
        $form = new SimpleForm(function (Player $player, int $data = null){
            if($data === null){
                return;
            }
            switch($data){
                case 0:
                    $player->getHungerManager()->setFood(20);
                    $player->getHungerManager()->setSaturation(20);
                    $player->sendTip("§eYou Have Been Feeded");

                break;

                case 1:
                    $player->setHealth(20);
                    $player->sendTip("§eYou Have Been Healed");

                break;

                case 2:
                    $player->sendTip("§4HealAndFeedUI has been closed");
                break;
            }
        });
        $form->setTitle("Heal-And-FeedUI");
        $form->addButton("Feed");
        $form->addButton("Heal");
        $form->addButton("Exit");
        $player->sendForm($form);
        return $form;
    }
}