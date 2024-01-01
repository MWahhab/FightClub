<?php

namespace FightClub;

class Roster
{
    /**
     * @var array $roster Represents the fighters within the roster
     */
    private array $roster;

    /**
     * Creates a 10 fighter large roster upon instantiation
     */
    public function __construct() {
        $this->roster = [
            new Fighter("Gandhi", 142.00, 20, 32),
            new Fighter("Arya", 120.00, 25, 22),
            new Fighter("Thor", 160.00, 18, 33),
            new Fighter("Elsa", 110.00, 42, 30),
            new Fighter("Neo", 145.00, 28, 24),
            new Fighter("Wonder Woman", 155.00, 19, 31),
            new Fighter("Batman", 130.00, 24, 29),
            new Fighter("Black Widow", 125.00, 26, 37),
            new Fighter("Spider-Man", 135.00, 38, 32),
            new Fighter("Superman", 150.00, 26, 36)
            ];
    }

    /**
     * @return array|Fighter[] Retrieves the roster array
     */
    public function getRoster(): array
    {
        return $this->roster;
    }

    public function getFighterByIndex(int $index): Fighter|null
    {
        if (isset($this->roster[$index])) {
            return $this->roster[$index];
        }

        return null;
    }

}