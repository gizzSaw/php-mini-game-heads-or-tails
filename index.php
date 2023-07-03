<?php 

class Player {
    public $name;
    public $coins;

    public function __construct($name, $coins)
    {
        $this->name = $name;
        $this->coins = $coins;
    }
}

class Game {
    protected $player1;
    protected $player2;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function start()
    {
        while(true) 
        {
            $flip = rand(0, 1) ? 'орёл': 'решка';                                   # Подбросить монетуы
            
            if ($flip === 'орёл') {                                                 # Если орёл, п1 получает монету, п2 теряет
                $this->player1->coins++;
                $this->player2->coins--;
            } elseif ($flip === 'решка') {                                          # Если решка, п1 теряет монету, п2 получает
                $this->player1->coins--;
                $this->player2->coins++;
            }

            if ($this->player1->coins === 0 || $this->player2->coins === 0) {       # Если у кого-то кол-во монет будет 0, то игра окончена
                return $this->end();
            }
        }
    }

    public function winner() 
    {
        if ($this->player1->coins > $this->player2->coins) {
            return $this->player1;
        } else {
            return $this->player2;
        }
    }

    public function end()
    {
            echo "
            Game over.
            Winner is 
            {$this->winner()->name}
            "; 
    }   

}

$game = new Game(
    new Player("Joe", 100),
    new Player("Jane", 100)
);

$game->start();