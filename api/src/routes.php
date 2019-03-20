<?php

use App\Controllers\TicTacToeController;

$app->post('/tictactoe/move', TicTacToeController::class . ':move');
$app->post('/tictactoe/game-status', TicTacToeController::class . ':gameStatus');