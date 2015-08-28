<?php
require_once("./StatSig.php");

use Targex\StickArena\StatSig;

class StatSigTest extends \PHPUnit_Framework_TestCase
{
  private $ava;
  private $bloodsyn;
  private $skye;
  private $test1;
  private $test2;

  public function __construct() {
    $this->ava = new StatSig("ava");
    $this->bloodsyn = new StatSig("bloodsyn");
    $this->ryan = new StatSig("ryan");
    $this->skye = new StatSig("skye");
    $this->test1 = new StatSig("test.test12");
    $this->test2 = new StatSig("phpunit4.7");
  }

  public function test_get_username() {
    $this->assertSame("test.test12", $this->test1->get_username());
    $this->assertSame("PHPUnit4.7", $this->test2->get_username());
  }

  public function test_get_permissions() {
    $this->assertSame(2, $this->skye->get_permissions());
    $this->assertSame(-1, $this->test1->get_permissions());
    $this->assertSame(0, $this->test2->get_permissions());
  }

  public function test_get_wins() {
    $this->assertSame(1, $this->test1->get_wins());
    $this->assertSame(7, $this->test2->get_wins());
  }

  public function test_get_losses() {
    $this->assertSame(0, $this->test1->get_losses());
    $this->assertSame(2, $this->test2->get_losses());
  }

  public function test_get_kills() {
    $this->assertSame(5, $this->test1->get_kills());
    $this->assertSame(99, $this->test2->get_kills());
  }

  public function test_get_deaths() {
    $this->assertSame(0, $this->test1->get_deaths());
    $this->assertSame(72, $this->test2->get_deaths());
  }

  public function test_get_total_rounds() {
    $this->assertSame(2, $this->test1->get_total_rounds());
    $this->assertSame(13, $this->test2->get_total_rounds());
  }

  public function test_is_banned() {
    $this->assertSame(1, $this->test1->is_banned());
    $this->assertSame(0, $this->test2->is_banned());
  }

  public function test_is_a_moderator() {
    $this->assertSame(1, $this->skye->is_a_moderator());
    $this->assertSame(0, $this->test2->is_a_moderator());
  }

  public function test_is_a_league_champion() {
    $this->assertSame(1, $this->ava->is_a_league_champion());
    $this->assertSame(0, $this->test1->is_a_league_champion());
  }

  public function test_is_a_community_builder() {
    $this->assertSame(1, $this->ryan->is_a_community_builder());
    $this->assertSame(0, $this->bloodsyn->is_a_community_builder());
  }

  public function test_is_a_featured_map_maker() {
    $this->assertSame(1, $this->bloodsyn->is_a_featured_map_maker());
    $this->assertSame(0, $this->ryan->is_a_featured_map_maker());
  }

  public function test_has_a_builder() {
    $this->assertSame(1, $this->bloodsyn->has_a_builder());
    $this->assertSame(1, $this->ryan->has_a_builder());
    $this->assertSame(0, $this->test1->has_a_builder());
  }

  public function test_has_a_labpass() {
    $this->assertSame(1, $this->skye->has_a_labpass());
    $this->assertSame(0, $this->test1->has_a_labpass());
  }

  public function test_calculate_kill_death_ratio() {
    $this->assertSame(5.0, $this->test1->calculate_kill_death_ratio());
    $this->assertSame(1.37, $this->test2->calculate_kill_death_ratio());
  }

  public function test_calculate_win_loss_ratio() {
    $this->assertSame(1.0, $this->test1->calculate_win_loss_ratio());
    $this->assertSame(3.5, $this->test2->calculate_win_loss_ratio());
  }

  public function test_calculate_rounds_completed() {
    $this->assertSame(1, $this->test1->calculate_rounds_completed());
    $this->assertSame(9, $this->test2->calculate_rounds_completed());
  }

  public function test_calculate_rounds_forfeited() {
    $this->assertSame(1, $this->test1->calculate_rounds_forfeited());
    $this->assertSame(4, $this->test2->calculate_rounds_forfeited());
  }

  public function test_calculate_kills_per_round() {
    $this->assertSame(5.0, $this->test1->calculate_kills_per_round());
    $this->assertSame(11.0, $this->test2->calculate_kills_per_round());
  }

  public function test_calculate_deaths_per_round() {
    $this->assertSame(0.0, $this->test1->calculate_deaths_per_round());
    $this->assertSame(8.0, $this->test2->calculate_deaths_per_round());
  }

  public function test_calculate_round_completion() {
    $this->assertSame(50, $this->test1->calculate_round_completion());
    $this->assertSame(69, $this->test2->calculate_round_completion());
  }

  public function test_evaluate_rank() {
    $this->assertSame(1, $this->test1->evaluate_rank());
    $this->assertSame(2, $this->test2->evaluate_rank());
  }

  public function test_evaluate_rating() {
    $this->assertSame("A+", $this->test1->evaluate_rating());
    $this->assertSame("A-", $this->test2->evaluate_rating());
  }
}