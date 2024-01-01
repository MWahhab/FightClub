<?php

use FightClub\Roster;

include_once("Fighter.php");
include_once("Roster.php");
include_once("ClubController.php");

$roster      = new Roster();
$rosterArray = $roster->getRoster();

$responseData = [];
foreach ($rosterArray as $fighter) {
    $responseData[] = $fighter->toArray();
}

echo json_encode($responseData);
