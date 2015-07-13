<?php
require_once("StatSig.php");

use Targex\StickArena\StatSig;

$player = new StatSig($argv[1]);
echo $player->get_username()."\n";
echo number_format($player->get_permissions())."\n";
echo number_format($player->get_wins())."\n";
echo number_format($player->get_losses())."\n";
echo number_format($player->get_kills())."\n";
echo number_format($player->get_deaths())."\n";
echo number_format($player->get_total_rounds())."\n";
echo $player->is_banned()."\n";
echo $player->is_a_moderator()."\n";
echo $player->is_a_league_champion()."\n";
echo $player->has_a_labpass()."\n";
echo $player->has_a_builder()."\n";
echo $player->calculate_kill_death_ratio()."\n";
echo $player->calculate_win_loss_ratio()."\n";
echo number_format($player->calculate_rounds_completed())."\n";
echo number_format($player->calculate_rounds_forfeited())."\n";
echo $player->calculate_kills_per_round()."\n";
echo $player->calculate_deaths_per_round()."\n";
echo $player->calculate_round_completion()."\n";
echo $player->evaluate_rank()."\n";
echo $player->evaluate_rating()."\n";