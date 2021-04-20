<?php

namespace App;

use App\Swarm\DroneBee;
use App\Swarm\QueenBee;
use App\Swarm\Swarm;
use App\Swarm\WorkerBee;

class Game 
{
    public $bees = [];
    private $selected_bee;
    private $selected_bee_index;

    protected function startGame()
    {
        $swarm = new Swarm();

        for ($i=0; $i < $swarm->queen_bees; $i++) { 
            $this->bees[] = new QueenBee('Queen Bee');
        }

        for ($i=0; $i < $swarm->worker_bees; $i++) { 
            $this->bees[] = new WorkerBee('Worker Bee');
        }

        for ($i=0; $i < $swarm->drone_bees; $i++) { 
            $this->bees[] = new DroneBee('Drone Bee');
        }

        $_SESSION['bee_game'] = serialize($this);
    }

    public function render()
    {
        $html = '<form action="?action=hit" method="post">';
        $html .= '<input type="submit" name="submit" id="submit" value="Hit" /></form>';
        if (!isset($_GET['action'])) {
            $this->startGame();
        }
        if (count($this->bees)) {
            $html .= 'The swarm consists of the following bees:';
            $html .= '<ol>';
            foreach ($this->bees as $bee) {
                $html .= "<li>{$bee->getType()}; Health: {$bee->getHealth()}</li>";
            }
            $html .= '</ol>';
        } else {
            $html .= "All bees are dead";
            $this->startGame();
        }
        return $html;
    }

    public function hit()
    {
        $this->selectBeeFromSwarm();
        $damage = $this->selected_bee->getHealth() - $this->selected_bee->hitDamage();
        $this->selected_bee->setHealth($damage);
        $this->bees[$this->selected_bee_index] = $this->selected_bee;
        $html = $this->render();
        $html .= "The selected bee was of type {$this->selected_bee->getType()} hit with {$this->selected_bee->hitDamage()} damage and has {$this->selected_bee->getHealth()} health remaining";
        return $html;
    }

    protected function selectBeeFromSwarm()
    {
        $this->selected_bee_index = array_rand($this->bees);
        $this->selected_bee = &$this->bees[$this->selected_bee_index];
    }
}