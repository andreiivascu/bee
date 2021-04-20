<?php

use App\Hero\Hero;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testHeroHasHealth()
    {
        $this->assertClassHasAttribute('health', Hero::class);
    }
}