<?php
    $_POST['line'];
    $_POST['row'];
    $_POST['cell'];
    $matrix = $_POST['matrix'];

    if (!isFull($matrix)) {
        $response = makeMove($matrix);
        $winner = getWinner($response['matrix']);

        die(json_encode([
            'winner' => $winner['status'],
            'player' => $winner['player'],
            'row' => $response['row'],
            'cell' => $response['cell'],
            'matrix' => $response['matrix']
        ]));
    } else {
        die(json_encode([
            'winner' => false,
            'row' => false,
            'cell' => false,
            'matrix' => $matrix
        ]));
    }

    function makeMove($matrix)
    {
        $row = rand(0, 2);
        $cell = rand(0, 2);

        if($matrix[$row][$cell] != 0){
            makeMove($matrix);
        } else {
            $matrix[$row][$cell] = 2;
            return [
                'cell' => $cell,
                'row' => $row,
                'matrix' => $matrix
            ];
        }
    }

    function getWinner($matrix)
    {
        $winner['status'] = false;
        $winner['player'] = 0;

        //matriz horizontal
        for($i = 0; $i < 3; $i++) {
            if($matrix[$i][0] != 0 && $matrix[$i][0] == $matrix[$i][1] && $matrix[$i][1] == $matrix[$i][2]) {
                return [
                    'status' => true,
                    'player' => $matrix[$i][0]
                ];
            }
        }

        //matriz vertical
        for($i = 0; $i < 3; $i++) {
            if($matrix[0][$i] != 0 && $matrix[0][$i] == $matrix[1][$i] && $matrix[1][$i] == $matrix[2][$i]) {
                return [
                    'status' => true,
                    'player' => $matrix[0][$i]
                ];
            }
        }

        //diagonal para direita
        if($matrix[0][0] != 0 & $matrix[0][0] == $matrix[1][1] && $matrix[1][1] == $matrix[2][2]) {
            return [
                'status' => true,
                'player' => $matrix[0][0]
            ];
        }

        //diagonal para a esquerda
        if($matrix[2][0] != 0 & $matrix[2][0] == $matrix[1][1] && $matrix[1][1] == $matrix[0][2]) {
            return [
                'status' => true,
                'player' => $matrix[2][0]
            ];
        }

        return [
            'status' => false,
            'player' => 0
        ];
    }

    function isFull($matrix)
    {
        $full = true;
        //verifica se o array está completo
        foreach ($matrix as $row) {
            foreach ($row as $cell) {
                if ($cell == 0) {
                    $full = false;
                    break;
                }
            }
        }

        return $full;
    }
