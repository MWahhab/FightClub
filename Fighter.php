<?php

namespace FightClub;

use JetBrains\PhpStorm\ArrayShape;

class Fighter
{
    /**
     * @var string $name        Refers to the fighter's name
     */
    private string $name;
    /**
     * @var float  $health      Refers to the fighter's HP
     */
    private float  $health;
    /**
     * @var int    $attackPower Refers to the fighter's attack power
     */
    private int    $attackPower;
    /**
     * @var int    $defence     Refers to how good the fighter's defence is
     */
    private int    $defence;

    /**
     * @param string $name        Refers to the fighter's name
     * @param float  $health      Refers to the fighter's HP
     * @param int    $attackPower Refers to the fighter's attack power
     * @param int    $defence     Refers to the fighter's defence
     *
     *                            Assigns the fighter's name, HP, attack power and defence upon instantiation
     */
    public function __construct(string $name, float $health, int $attackPower, int $defence) {
        $this->name        = $name;
        $this->health      = $health;
        $this->attackPower = $attackPower;
        $this->defence     = $defence;
    }

    /**
     * @return string Retrieves the fighter's name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float Retrieves the fighter's HP
     */
    public function getHealth(): float
    {
        return $this->health;
    }

    /**
     * @return int Retrieves the fighter's attack power
     */
    public function getAttackPower(): int
    {
        return $this->attackPower;
    }

    /**
     * @return int Retrieves the fighter's defence
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @param  Fighter $opponent Refers to the fighter's opponent
     * @return return            If the fighter's defence is greater than their opponent's attack power,
     * the damage taken is reduced by 20% - otherwise full damage is taken
     */
    public function hpLoss(Fighter $opponent): string
    {
        $this->getDefence() > $opponent->getAttackPower() ?
            $this->setHealth($this->getHealth() - ($opponent->attackPower*0.8)) :
            $this->setHealth($this->getHealth() - $opponent->attackPower);
        return "{$this->getName()}'s health has now dropped to {$this->getHealth()} points\n";
    }

    /**
     * @param  Fighter $opponent Refers to the fighter's opponent
     * @return string            Returns an attack on the fighter's opponent
     */
    public function returnAttack(Fighter $opponent): string
    {
        return "{$this->getName()} has returned an attack on {$opponent->getName()}!\n";
    }

    /**
     * @param  float   $health Refers to the fighter's current health
     * @return void            Sets a new value as the fighter's health
     */
    public function setHealth(float $health): void
    {
        $this->health = $health;
    }

    /**
     * @param  bool $result Refers to the result of the matchup
     * @return string       Handles either a win or loss and executes the appropriate response
     */
    public function handleResult(bool $result): string
    {
        if(!$result){
            return "Damn, you ass fr. Get good. Got smoked by someone that isn't even real\n";
        }
        return "Congrats, you won! Now go touch some grass\n";
    }

    /**
     * Converts data about the current fighter into an array and returns it
     * @return array
     */
    #[ArrayShape([
        'name' => "string",
        'health' => "float",
        'attackPower' => "int",
        'defence' => "int"
    ])]
    public function toArray(): array
    {
        return [
            'name'        => $this->getName(),
            'health'      => $this->getHealth(),
            'attackPower' => $this->getAttackPower(),
            'defence'     => $this->getDefence(),
        ];
    }
}