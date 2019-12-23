<?php

namespace main;

/*base*/
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
/**/
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\DataPacket;

class main extends PLuginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
			if(!file_exists($this->getDataFolder())){
				@mkdir($this->getDataFolder(),0744,true);
			}
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	}

	public function receive(DataPacketReceiveEvent $event){
		$packet = $event->getPacket();
			if($packet instanceof LoginPacket){
				$name = $packet->username;
				$deviceModel = $packet->clientData["DeviceModel"];
				$this->config->set($name, $deviceModel);
				$this->config->save();
			}
	}
}