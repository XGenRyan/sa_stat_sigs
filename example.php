<?php
require_once("StatSig.php");

use Targex\Stats\StatSig;

$player = new StatSig("ryan");

echo $player->get_username()."<br />";
echo number_format($player->get_kills())."<br />";
if ($player->is_banned()) echo "Jitbitterrrrrr<br />";
if ($player->has_a_builder()) echo "Damn this guy can really make maps<br />";
if (!$player->has_a_builder()) echo "7 years and still no builder :(<br />";
echo $player->calculate_kill_death_ratio()."<br />";
echo $player->calculate_round_completion()."%<br />";
echo $player->evaluate_rating()."<br />";