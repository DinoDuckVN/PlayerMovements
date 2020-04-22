<?php

declare(strict_types=1);

namespace DinoVNOWO\PlayerMovements;

use pocketmine\Player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{
	
	private $players = [];
	
	private static $instance;
	
	public function onEnable() : void{
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public static function getInstance() : PluginBase{
		return self::$instance;
	}
	
	public function onMove(PlayerMoveEvent $event) : void{
		$player = $event->getPlayer();
		if($event->isCancelled()){
			return;
		}
		if(!$event->getFrom()->asVector3()->equals($event->getTo()->asVector3())){
			$this->plugin->players[$player->getId()] = $player->ticksLived;
		}
	}
	
	public function isMoving(Player $player, int $differticks = 2) : bool{
		return array_key_exists($player->getId(), $this->players) &&
        $player->ticksLived - $this->players[$player->getId()] <= $ticks;
	}
}
