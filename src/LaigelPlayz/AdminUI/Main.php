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

class Main extends PluginBase implements Listener {

	public $playerlist = [];

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

				case 5:
				$this->OpenKillForm($player);
			}
		});
		$form->setTitle("Admin UI");
		$form->setContent("Please Select an Action");
		$form->addButton("§3Fly");
		$form->addButton("§cHeal");
		$form->addButton("§aFeed");
		$form->addButton("§6Gamemode");
		$form->addButton("§eTime");
		$form->addButton("§cKill");
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
		$form->addButton("§aFly On");
		$form->addButton("§cFly Off");
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
		$form->addButton("§cSurvival");
		$form->addButton("§aCreative");
		$form->addButton("§6Adventure");
		$form->addButton("§eSpectator");
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
		$form->setTitle("Admin Ui TIME");
		$form->setContent("Change the time of the level you are in!");
		$form->addButton("§6Sunrise");
		$form->addButton("§eDay");
		$form->addButton("§7Noon");
		$form->addButton("§6Sunset");
		$form->addButton("§cNight");
		$form->addButton("§aMidnight");
		$form->addButton("BACK");
		$form->sendToPlayer($player);
		return $form;
	}

	public function OpenKillForm($player){
		$list = [];
		foreach($this->getServer()->getOnlinePlayers() as $p){
			$list[] = $p->getName();
		}

		$this->playerList[$player->getName()] = $list;
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $player, ?array $data = null) use ($list){
			if(!isset($data)){
				return true;
			}

			$name = $data[1];
			$name = $list[$name];
			$player = Server::getInstance()->getPlayer($name);
			$player->kill();
		});
		$form->setTitle("Kill");
		$form->addLabel("§cKill Selection");
		$form->addDropDown("$aselect a player to kill", $this->playerList[$player->getName()]);
		$form->sendToPlayer($player);
		return $form;
	}



}
