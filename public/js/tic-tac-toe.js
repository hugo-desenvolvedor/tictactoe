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
        showWinner();
    });
});

function getCPUMove() {
    $.ajax({
        method: "POST",
        url: "async/tictactoe.php",
        data: {
            level: level,
            boardState: boardState
        },
        success: function (data) {
            //console.log('data', data);

            response = JSON.parse(data);
            gameStatus = response.gameStatus;
            setBoardStateCell(response.lastCPUMove[0], response.lastCPUMove[1], response.lastCPUMove[2]);

            showWinner();
        },
        error: function (error) {
            console.log('error', error);
        }
    });
}

function showWinner() {
    switch (gameStatus) {
        case 1 :
            alert('Player X wins');
            break;
        case 2 :
            alert('Player O wins');
            break;
        case 3 :
            alert('Draw');
            break;
    }
}

function setBackgroundCell(row, column, playerUnit) {
    var cell = $(".column[data-row='" + row + "'][data-column='" + column + "']");

    if (playerUnit == "O") {
        cell.css("background-image", "url(img/o.png)");
    } else {
        cell.css("background-image", "url(img/x.png)");
    }
    //showWinner();
}

function setBoardStateCell(row, column, playerUnit) {
    if(gameStatus == 0)
    {
        if (boardState[row][column] != '') {
            alert("Try a new move");
            return false;
        }
        boardState[row][column] = playerUnit;
        setBackgroundCell(row, column, playerUnit);
    }

    if(gameStatus == 1 || gameStatus == 3)
    {
        boardState[row][column] = playerUnit;
        setBackgroundCell(row, column, playerUnit);
    }

}