<?php

namespace FightClub;

class ClubController
{
    /**
     * @var Roster  $roster      Represents the fighter roster
     */
    private Roster  $roster;

    /**
     * @var Fighter $yourFighter Represents your chosen fighter
     */
    private Fighter $yourFighter;

    /**
     * @var Fighter $opponent    Represents your chosen opponent
     */
    private Fighter $opponent;

    /**
     * @var bool    $reset       Refers to whether the match needs to reset or not
     *
     *                           If reset is true, no attacks can be launched until a new fight is initiated
     */
    private bool    $reset;
    /**
     * @var array   $events      Refers to the events that take place during the battle
     */
    private array   $events;

    /**
     * Upon instantiation, instantiates the Roster class and assigns it to the roster array.
     *
     * Also prints the current roster to the terminal so the user can view each fighter as well as their respective details
     */
    public function __construct() {
        $this->roster = new Roster();
        //$this->roster->displayRoster();
    }

    /**
     * @param  Fighter $yourFighter Refers to your chosen fighter
     * @param  Fighter $opponent    Refers to your chosen opponent
     * @return void                 Sets your fighter and opponent. Also makes sure there's a 50/50 chances of landing a first shot. If you attack first, a method to handle your opponent's response is executed.
     */
    public function initiateBattle(Fighter $yourFighter, Fighter $opponent): void
    {
        $this->setReset(false);
        $this->setEvents([]);

        $this->setYourFighter($yourFighter);
        $this->setOpponent($opponent);

        if(rand(1,10) > 5) {

            $event = "{$opponent->getName()} takes the first shot!\n";
            $this->addEvents($event);

            $this->addEvents($yourFighter->hpLoss($opponent));
            return;
        }

        $event = "{$yourFighter->getName()} takes the first shot!\n";

        $this->addEvents($event);

        $this->addEvents($opponent->hpLoss($yourFighter));

        $this->addEvents($opponent->returnAttack($yourFighter));
        $this->addEvents($yourFighter->hpLoss($opponent));
    }

    public function setEvents($events): void
    {
        $this->events = $events;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function addEvents(string $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return bool Retrieves the reset value
     */
    private function getReset(): bool
    {
        return $this->reset;
    }

    /**
     * @param  bool  $reset Refers to whether the match needs to be reset or not
     * @return void         Sets the boolean value of the reset property
     */
    private function setReset(bool $reset): void
    {
        $this->reset = $reset;
    }

    /**
     * @return Fighter Retrieves your chosen fighter
     */
    public function getYourFighter(): Fighter
    {
        return $this->yourFighter;
    }

    /**
     * @return Fighter Retrieves your chosen opponent
     */
    public function getOpponent(): Fighter
    {
        return $this->opponent;
    }

    /**
     * @return void Initiates a new attack on your opponent, after which your opponent returns an attack on your fighter
     *
     *              Also executes a win/loss response when either your fighter or opponent reach 0 health points.
     *
     *              Will refuse to attack so long as the reset attribute is true
     */
    public function attack(): void
    {
        if($this->getReset() === true) {

            $event = "Sorry! You cant continue this battle as the match has concluded. Please initiate a new one!";
            echo $event;
            $this->addEvents($event);

            return;
        }

        $this->addEvents($this->getYourFighter()->returnAttack($this->getOpponent()));
        $this->addEvents($this->getOpponent()->hpLoss($this->getYourFighter()));

        $this->addEvents($this->getOpponent()->returnAttack($this->getYourFighter()));
        $this->addEvents($this->getYourFighter()->hpLoss($this->getOpponent()));

        if($this->getYourFighter()->getHealth() <= 0) {
            $this->addEvents($this->getYourFighter()->handleResult(false));
            $this->setReset(true);
            return;
        }

        if($this->getOpponent()->getHealth() <= 0) {
            $this->addEvents($this->getYourFighter()->handleResult(true));
            $this->setReset(true);
        }

    }

    /**
     * @return void Auto attacks until one fighter's at or below 0 HP
     */
    public function autoAttack(): void
    {
        if($this->getReset() === true) {
            $event = "Sorry! You cant continue this battle as the match has concluded. Please initiate a new one!";
            echo $event;
            $this->addEvents($event);
            return;
        }

        while($this->getYourFighter()->getHealth() > 0 && $this->getOpponent()->getHealth() > 0) {
            $this->attack();
        }

    }


    /**
     * @param  Fighter $yourFighter Refers to your chosen fighter
     * @return void                 Sets your chosen fighter
     */
    private function setYourFighter(Fighter $yourFighter): void
    {
        $this->yourFighter = $yourFighter;
    }

    /**
     * @param  Fighter $opponent Refers to your chosen opponent
     * @return void              Sets your chosen opponent
     */
    private function setOpponent(Fighter $opponent): void
    {
        $this->opponent = $opponent;
    }


}