<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div class="main">
    <div class="restart">RESTART THE GAME</div>
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
    <div class="message hidden">Message</div>
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="js/tic-tac-toe.js"></script>
</body>
</html>