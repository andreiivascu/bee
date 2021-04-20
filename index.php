<?php
if (!isset($_SESSION)) session_start();

use App\Game;

require 'vendor/autoload.php';

if (isset($_GET['action'])) {
    $swarm = unserialize($_SESSION['bee_game']);
    echo $swarm->hit();
} else {
    $swarm = new Game();
    echo $swarm->render();
}
