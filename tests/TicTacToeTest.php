<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \App\TicTacToe\{Game, GameStatus, Board};
use \App\Enum\{LevelEnum, GameStatusEnum};

class TicTacToeTest extends TestCase
{
    public function testCanCreateABoard(): void
    {
        $this->assertInstanceOf(Board::class, new Board());
    }

    public function testCanCreateAGameStatus(): void
    {
        $this->assertInstanceOf(GameStatus::class, new GameStatus());
    }

    public function testCanCreateAGame(): void
    {
        $this->assertInstanceOf(Game::class, new Game(LevelEnum::EASY, 'X'));
        $this->assertInstanceOf(Game::class, new Game(LevelEnum::MEDIUM, 'X'));
    }

    public function testSetAndGetBoardState(): void
    {
        $expectedBoard = [
            0 => ['', '', ''],
            1 => ['', '', ''],
            2 => ['', '', '']
        ];

        $board = new Board();
        $board->setBoardState($expectedBoard);

        $this->assertEquals($expectedBoard, $board->getBoardState());
    }


    public function testMakeAMoveInEasyLevel(): void
    {
        $game = new Game(LevelEnum::EASY, 'X');
        $board = [
            0 => ['', '', ''],
            1 => ['', 'O', ''],
            2 => ['', '', '']
        ];

        $game->makeCPUMove($board);

        $expectedBoard = [
            0 => ['X', '', ''],
            1 => ['', 'O', ''],
            2 => ['', '', '']
        ];

        $this->assertEquals('X', $game->getLastCPUMove()[2]);
        $this->assertEquals(GameStatusEnum::DEFAULT, $game->getStatus());
        $this->assertEquals($expectedBoard, $game->getBoardState());
    }

    public function testMakeAMoveInMediumLevel(): void
    {
        $game = new Game(LevelEnum::MEDIUM, 'X');

        $board = [
            0 => ['', '', ''],
            1 => ['', 'O', ''],
            2 => ['', '', '']
        ];

        $expectedPlayerUnit = '';
        $game->makeCPUMove($board);
        $boardState = $game->getBoardState();

        foreach ($boardState as $rowKey => $rowValue) {
            foreach ($rowValue as $columnKey => $columnValue) {
                if ($columnValue == 'X') {
                    $expectedPlayerUnit = $columnValue;
                }
            }
        }
        $this->assertEquals('X', $game->getLastCPUMove()[2]);
        $this->assertEquals(GameStatusEnum::DEFAULT, $game->getStatus());
        $this->assertEquals('X', $expectedPlayerUnit);
    }

    public function testIfPlayerUnitWinsInHorizontalBeforeCpuMovement(): void
    {
        $expectedBoard = [
            0 => ['O', 'O', ''],
            1 => ['O', 'O', 'X'],
            2 => ['X', 'X', 'X']
        ];

        $game = new Game(LevelEnum::MEDIUM, 'X');
        $game->makeCPUMove($expectedBoard);

        $this->assertEquals(GameStatusEnum::PLAYER_X, $game->getStatus());
        $this->assertEquals($expectedBoard, $game->getBoardState());
    }

    public function testIfPlayerUnitWinsInVerticalBeforeCpuMovement(): void
    {
        $expectedBoard = [
            0 => ['', 'X', 'O'],
            1 => ['O', 'X', ''],
            2 => ['O', 'X', '']
        ];

        $game = new Game(LevelEnum::EASY, 'X');
        $game->makeCPUMove($expectedBoard);

        $this->assertEquals($expectedBoard, $game->getBoardState());
        $this->assertEquals(GameStatusEnum::PLAYER_X, $game->getStatus());
    }

    public function testIfPlayerUnitWinsInLeftToRightDiagonalBeforeCpuMovement(): void
    {
        $expectedBoard = [
            0 => ['O', '', 'X'],
            1 => ['X', 'O', ''],
            2 => ['X', '', 'O']
        ];

        $game = new Game(LevelEnum::EASY, 'X');
        $game->makeCPUMove($expectedBoard);

        $this->assertEquals($expectedBoard, $game->getBoardState());
        $this->assertEquals(GameStatusEnum::PLAYER_O, $game->getStatus());
    }

    public function testIfPlayerUnitWinsInRightToLeftDiagonalBeforeCpuMovement(): void
    {
        $expectedBoard = [
            0 => ['X', '', 'O'],
            1 => ['X', 'O', ''],
            2 => ['O', '', 'X']
        ];

        $game = new Game(LevelEnum::EASY, 'X');
        $game->makeCPUMove($expectedBoard);

        $this->assertEquals($expectedBoard, $game->getBoardState());
        $this->assertEquals(GameStatusEnum::PLAYER_O, $game->getStatus());
    }

    public function testIfPlayerUnitWinsSettingLastCell(): void
    {
        $expectedBoard = [
            0 => ['X', 'X', 'O'],
            1 => ['X', 'X', 'O'],
            2 => ['O', 'O', '']
        ];

        $game = new Game(LevelEnum::MEDIUM, 'X');
        $game->makeCPUMove($expectedBoard);

        $expectedBoard[2][2] = 'X';

        $this->assertEquals($expectedBoard, $game->getBoardState());
        $this->assertEquals(GameStatusEnum::PLAYER_X, $game->getStatus());
    }

    public function testIfGameStatusIsDraw(): void
    {
        $expectedBoard = [
            0 => ['O', 'X', 'O'],
            1 => ['X', 'O', 'X'],
            2 => ['X', 'O', 'X']
        ];

        $game = new Game(LevelEnum::MEDIUM, 'X');
        $game->makeCPUMove($expectedBoard);

        $this->assertEquals($expectedBoard, $game->getBoardState());
        $this->assertEquals(GameStatusEnum::DRAW, $game->getStatus());
    }

    public function testIfPlayerUnitDrawSettingLastCell(): void
    {
        $expectedBoard = [
            0 => ['O', 'X', 'O'],
            1 => ['X', 'O', 'X'],
            2 => ['X', 'O', '']
        ];

        $game = new Game(LevelEnum::MEDIUM, 'X');
        $game->makeCPUMove($expectedBoard);

        $expectedBoard[2][2] = 'X';

        $this->assertEquals(GameStatusEnum::DRAW, $game->getStatus());
        $this->assertEquals($expectedBoard, $game->getBoardState());
    }
}