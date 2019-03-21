var boardState = [['', '', ''], ['', '', ''], ['', '', '']];
var gameStatus = 0;
var level = 0;

$(function () {
    $(".column").click(function () {
        if (gameStatus == 0) {
            var row = $(this).data('row');
            var column = $(this).data('column');

            setBoardStateCell(row, column, 'O');
            getCPUMove();
        }
    });
});

function getCPUMove() {
    $.ajax({
        method: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        url: "http://localhost/docler-holding/api/public/tictactoe/move",
        data: JSON.stringify({
            level: level,
            boardState: boardState
        }),
        success: function (data) {
            gameStatus = data.gameStatus;
            setBoardStateCell(data.lastCPUMove[0], data.lastCPUMove[1], data.lastCPUMove[2]);

            console.log('gameStatus', data.gameStatus);
        },
        error: function (error) {
            console.log('error', error);
        }
    });
}

function showWinner() {
    message = '';

    switch (gameStatus) {
        case 1 :
            message = 'Player X wins';
            break;
        case 2 :
            message = 'Player O wins';
            break;
        case 3 :
            message = 'Draw';
            break;
    }

    if (message != '') {
        $(".message").html(message).removeClass('hidden');
    }
}

function setBackgroundCell(row, column, playerUnit) {
    var cell = $(".column[data-row='" + row + "'][data-column='" + column + "']");

    if (playerUnit == "O") {
        cell.css("background-image", "url(img/o.png)");
    } else {
        cell.css("background-image", "url(img/x.png)");
    }
}

function setBoardStateCell(row, column, playerUnit) {
    if (gameStatus == 0) {
        if (boardState[row][column] != '') {
            $(".message").html('Try a new move').removeClass('hidden');
            return false;
        }
        boardState[row][column] = playerUnit;
        setBackgroundCell(row, column, playerUnit);
    }

    if (gameStatus == 1 || gameStatus == 3) {
        boardState[row][column] = playerUnit;
        setBackgroundCell(row, column, playerUnit);
    }
    showWinner();
}