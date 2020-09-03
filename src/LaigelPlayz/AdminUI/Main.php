<?php

namespace LaigelPLayz\AdminUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use jojoe77777\FormAPI\FormAPI;

class Main extends PluginBase {

	public function onEnable(){

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "adminui":
			if($sender instanceof Player){
				$this->OpenMyForm($sender);
			} else {
				$sender->sendMessage("Please Execute this Command Ingame");
			}
		}
		return true;
	}

	public function OpenMyForm($player){
		$api =  $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$this->OpenFlyForm($player);

				break;

				case 1:
				$player->setHealth(20);
				$player->sendMessage("You Heal You'r self!");

				break;

				case 2:
				$player->setFood(20);
				$player->sendMessage("You Fed You'r self!");

				break;

				case 3:
				$this->OpenGamemodeForm($player);

				break;

				case 4:
				$this->OpenTimeForm($player);

				break;
			}
		});
		$form->setTitle("Admin UI");
		$form->setContent("Please Select an Action");
		$form->addButton("Fly");
		$form->addButton("Heal");
		$form->addButton("Feed");
		$form->addButton("Select Gamemode");
		$form->addButton("Change Time");
		$form->sendToPlayer($player);
		return $form;
	}

	public function OpenFlyForm($player){
		$api =  $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$player->setAllowFlight(true);
				$player->sendMessage("You Turn on Fly Mode");

				break;

				case 1:
				$player->setAllowFlight(false);
				$player->sendMessage("You Turn off Fly Mode");

				break;

				case 2:
				$this->OpenMyForm($player);

				break;
			}
		});
		$form->setTitle("FLY");
		$form->setContent("Turn Fly Off and On");
		$form->addButton("Fly On");
		$form->addButton("Fly Off");
		$form->addButton("BACK");
		$form->sendToPlayer($player);
		return $form;
	}

	public function OpenGamemodeForm($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$player->setGameMode(0);
				$player->sendMessage("you'r Gamemode is now Survival");

				break;

				case 1:
				$player->setGameMode(1);
				$player->sendMessage("You'r Gamemode is now creative");

				break;

				case 2:
				$player->setGamemode(2);
				$player->sendMessage("You'r Gamemode is now Adventure");

				break;

				case 3:
				$player->setGamemode(3);
				$player->sendMessage("You are now in Spectator Mode");

				break;

				case 4:
				$this->OpenMyForm($player);

				break;
			}
		});
		$form->setTitle("Gamemode");
		$form->setContent("Choose Gamemode!");
		$form->addButton("Survival");
		$form->addButton("Creative");
		$form->addButton("Adventure");
		$form->addButton("Spectator");
		$form->addButton("BACK");
		$form->sendToPlayer($player);
		return $form;
	}

	public function OpenTimeForm($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$player->getLevel()->setTime(23000);
				$player->sendMessage("Time set to Sunrise");
				
				break;

				case 1:
				$player->getLevel()->setTime(1000);
				$player->sendMessage("Time set to Day");

				break;

				case 2:
				$player->getLevel()->setTime(6000);
				$player->sendMessage("Time set to Noon");

				break;

				case 3:
				$player->getLevel()->setTime(12000);
				$player->sendMessage("Time set to Sunset");

				break;

				case 4:
				$player->getLevel()->setTime(13000);
				$player->sendMessage("Time set to Night");

				break;

				case 5:
				$player->getLevel()->setTime(18000);
				$player->sendMessage("Time set to MidNight");

				break;

				case 6:
				$this->OpenMyForm($player);

				break;
			}
		});
		$form->setTitle("Gamemode");
		$form->setContent("Choose Gamemode!");
		$form->addButton("SunRise");
		$form->addButton("Day");
		$form->addButton("Noon");
		$form->addButton("Sunset");
		$form->addButton("Night");
		$form->addButton("MidNight");
		$form->addButton("BACK");
		$form->sendToPlayer($player);
		return $form;
	}



}
