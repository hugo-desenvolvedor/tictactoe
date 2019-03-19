<link rel="stylesheet" type="text/css" href="css/style.css">

<script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>

<div class="grid">
    <div class="row row-0">
        <div class="column" data-row="0" data-column="0"></div>
        <div class="column" data-row="0" data-column="1"></div>
        <div class="column" data-row="0" data-column="2"></div>
    </div>
    <div class="row row-1">
        <div class="column" data-row="1" data-column="0"></div>
        <div class="column" data-row="1" data-column="1"></div>
        <div class="column" data-row="1" data-column="2"></div>
    </div>

    <div class="row row-2">
        <div class="column" data-row="2" data-column="0"></div>
        <div class="column" data-row="2" data-column="1"></div>
        <div class="column" data-row="2" data-column="2"></div>
    </div>
</div>

<script>
    var boardState = [['', '', ''], ['', '', ''], ['', '', '']];
    var gameStatus = 0;
    var level = 1;

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
                console.log('data', data);

                response = JSON.parse(data);
                gameStatus = response.gameStatus;
                setBoardStateCell(response.lastCPUMove[0], response.lastCPUMove[1], response.lastCPUMove[2]);
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
        console.log('setBackgroundCell', gameStatus);
        showWinner();
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
            setBackgroundCell(row, column, playerUnit);
        }

    }


    /*
    $(function(){

        var matrix = [[0, 0, 0], [0, 0, 0], [0, 0, 0]];
        var winner = false;
        if(winner === false) {
            $(".column").click(function() {

                var line = $(this).data('value').toString();
                var row = line.charAt(0);
                var column = line.charAt(1);

                if(matrix[row][column] != 0)
                {
                    alert("Try a new move");
                    return false;
                }
                matrix[row][column] = 1;

                $.ajax({
                    method: "POST",
                    url: "move.php",
                    data: {
                        line: line,
                        row: row,
                        column: column,
                        matrix: matrix
                    },
                    success: function(data){
                        if(winner === false) {
                            var columnX = $(".column[data-value='" + line +"']");
                            columnX.css("background-image", "url(x.png)");

                            var response = JSON.parse(data);

                            console.log('response', response);
                            console.log('matrix', matrix);

                            if (response.winner === true) {
                                winner = true;
                                alert('We have a winner');
                            } else {
                                if (response.row !== false && response.column !== false) {
                                    matrix[response.row][response.column] = 2;
                                    var lineO = response.row + "" + response.column;

                                    var columnO = $(".column[data-value='" + lineO +"']");
                                    columnO.css("background-image", "url(o.png)");
                                }
                            }
                        } else {
                            alert('We have a winner');
                        }
                    },
                    error: function(data){
                        console.log('error', data);
                    }
                });

            });
        }
    });
*/
</script>
