<?php

use App\Controllers\AuthController;
use App\Controllers\TicTacToeController;

$app->post('/auth', AuthController::class . ':auth');
$app->post('/tictactoe/move', TicTacToeController::class . ':move');
$app->post('/tictactoe/game-status', TicTacToeController::class . ':gameStatus');