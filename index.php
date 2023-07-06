<?php 

class Player {
    public $name;
    public $coins;

    public function __construct($name, $coins)
    {
        $this->name = $name;
        $this->coins = $coins;
    }

    public function point(Player $player2)
    {
        $this->coins++;
        $player2->coins--;
    }

    public function bankrupt() 
    {
        return $this->coins == 0;
    }

    public function bank()
    {
        return $this->coins;
    }

    public function oods(Player $player2)
    {
        return $player1oods = round(100 * $this->bank() / ($this->bank() + $player2->bank())) . "%";
    }
}

class Game {
    protected $player1;
    protected $player2;
    protected $flips = 1;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function flip()
    {
        return $flip = rand(0, 1) ? 'орёл': 'решка';  # Подбросить монетуы
    }

    public function start()
    {
        
        echo "Шансы {$this->player1->name} = {$this->player1->oods($this->player2)} - у него {$this->player1->bank()} фишек <br>";
        echo "Шансы {$this->player2->name} = {$this->player2->oods($this->player1)} - у него {$this->player2->bank()} фишек <br>";

        $this->play();
    }


    public function play()
    {
        while(true) 
        {                   
            if ($this->flip() === 'орёл') {                                         # Если орёл, п1 получает монету, п2 теряет                     
                $this->player1->point($this->player2);
            } else {                                                                # Если решка, п1 теряет монету, п2 получает
                $this->player2->point($this->player1);
            }

            if (($this->player1->bankrupt()  || $this->player2->bankrupt())) {       # Если у кого-то кол-во монет будет 0, то игра окончена
                return $this->end();
            }

            $this->flips++;
        }
    }

    public function winner(): Player 
    {
        return $this->player1->bank() > $this->player2->bank() ? $this->player1 : $this->player2;
    }

    public function end()
    {
            echo "
            Game over.                                          <br>
            Было сделано {$this->flips} бросков.                <br>
            {$this->player1->name}: {$this->player1->bank()}    <br>
            {$this->player2->name}: {$this->player2->bank()}    <br>
            Winner is 
            {$this->winner()->name}!
            "; 
    }   

}

$game = new Game(
    new Player("Casino", 3000),
    new Player("Saveliy", 100)
);

$game->start();