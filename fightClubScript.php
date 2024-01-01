<?php
include_once("Fighter.php");
include_once("Roster.php");
include_once("ClubController.php");

$json        = file_get_contents('php://input');
$requestData = json_decode($json, true); // Decode as an associative array

$firstFighterIndex  = (int) $requestData['firstFighter'];
$secondFighterIndex = (int) $requestData['secondFighter'];


$roster = new \FightClub\Roster();

$fightClub = new \FightClub\ClubController();
echo "\n";
$fightClub->initiateBattle($roster->getFighterByIndex($firstFighterIndex), $roster->getFighterByIndex($secondFighterIndex));

$fightClub->autoAttack();
$events = $fightClub->getEvents();

$json = json_encode($events);
echo $json;
