<?php

namespace App\Swarm;

class Swarm
{
    protected $damage = 0;
    protected $health = 0;
    protected $hit_damage = 0;
    public $type;
    public $queen_bees = 1;
    public $worker_bees = 5;
    public $drone_bees = 8;

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    protected function setDamage($value)
    {
        $this->damage = $value;
    }

    protected function getDamage()
    {
        return $this->damage;
    }

    public function setHealth($value)
    {
        $this->health = $value;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function isAlive()
    {
        return $this->health > 0;
    }

    public function hitDamage()
    {
        return $this->hit_damage;
    }

    public function setType($value)
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }
}