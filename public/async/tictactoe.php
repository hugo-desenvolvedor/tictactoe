<?php
include("../../vendor/autoload.php");

$board = $_POST['boardState'];
$level = $_POST['level'];

$game = new \App\TicTacToe\Game($level, 'X');

$game->makeCPUMove($board);

die(json_encode([
    'lastCPUMove' => $game->getLastCPUMove(),
    'gameStatus' => $game->getStatus(),
    'boardState' => $game->getBoardState()
]));
