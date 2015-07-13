<?php
namespace Targex\Stats;

class StatSig
{
  public function __construct($username) {
    $this->username = $username;
    $api = simplexml_load_file('http://api.xgenstudios.com/?method=xgen.stickarena.stats.get&username='.$this->username);
    $this->stats = $api[0]->stats->game;
    $this->users_with_builders = ["codyshadow", "chicken", ".,syco,.", "y3lloman", "bloodsyn", "dan", "stickslayer132", "77gamer77", ".,criticalx,.", "dmaster12", "springbranch", ".get.money.", "shadowcasterx4ffc", "yiff.", "mapymaper.", "jakethesnake", "masterchuf", "air,", "delocuro", "cr1t1c1sm", "sk8indude", "ghostrec0n", "bridgeofstraw", "action", "jaguar", "ghecko", "cadaver999", ".,chickenator,.", "shot", "jzuo", "believed", "felumade.", "stabulator", "vegeta,rock", "firegun000", "bullet.girl.", "gore4life", ",.smokez.,", "718", "joeseph", "volt", "coldhot", "5k1", "crocodile", "difficult", "deadmafia", "hanktankerous", "wolfy", "shot..to..kill..."];
    $this->league_champions = ["ava", "mayne", "koolaid"];
  }

  public function get_username() {
    return $this->stats->user['username'];
  }

  public function get_permissions() {
    return intval($this->stats->user['perms']);
  }

  public function get_wins() {
    return intval($this->stats->user->stat[0]);
  }

  public function get_losses() {
    return intval($this->stats->user->stat[1]);
  }

  public function get_kills() {
    return intval($this->stats->user->stat[2]);
  }

  public function get_deaths() {
    return intval($this->stats->user->stat[3]);
  }

  public function get_total_rounds() {
    return intval($this->stats->user->stat[4]);
  }

  public function is_banned() {
    return intval($this->get_permissions()) == -1 ? 1 : 0;
  }

  public function is_a_moderator() {
    return intval($this->get_permissions()) > 0 ? 1 : 0;
  }

  public function is_a_league_champion() {
    return in_array(strtolower($this->get_username()), $this->league_champions) ? 1 : 0;
  }

  public function has_a_labpass() {
    return intval($this->stats->user->stat[5]);
  }

  public function has_a_builder() {
    return in_array(strtolower($this->get_username()), $this->users_with_builders) ? 1 : 0;
  }

  public function calculate_kill_death_ratio() {
    if ($this->get_deaths() == 0) return $this->get_kills();
    return floor(($this->get_kills()/$this->get_deaths())*100)/100;
  }

  public function calculate_win_loss_ratio() {
    if ($this->get_losses() == 0) return $this->get_wins();
    return floor(($this->get_wins()/$this->get_losses())*100)/100;
  }

  public function calculate_rounds_completed() {
    return $this->get_wins()+$this->get_losses();
  }

  public function calculate_rounds_forfeited() {
    return $this->get_total_rounds()-$this->calculate_rounds_completed();
  }

  public function calculate_kills_per_round() {
    return floor(($this->get_kills()/$this->calculate_rounds_completed())*100)/100;
  }

  public function calculate_deaths_per_round() {
    return floor(($this->get_deaths()/$this->calculate_rounds_completed())*100)/100;
  }

  public function calculate_round_completion() {
    return intval(($this->calculate_rounds_completed()/$this->get_total_rounds())*100);
  }

  public function evaluate_rank() {
    $k = $this->get_kills();
    if ($k >= 5 && $k < 25) {
      return 1;
    } else if ($k >= 25 && $k < 100) {
      return 2;
    } else if ($k >= 100 && $k < 300) {
      return 3;
    } else if ($k >= 300 && $k < 750) {
      return 4;
    } else if ($k >= 750 && $k < 2000) {
      return 5;
    } else if ($k >= 2000 && $k < 5000) {
      return 6;
    } else if ($k >= 5000 && $k < 10000) {
      return 7;
    } else if ($k >= 10000 && $k < 20000) {
      return 8;
    } else if ($k >= 20000 && $k < 40000) {
      return 9;
    } else if ($k >= 40000 && $k < 60000) {
      return 10;
    } else if ($k >= 60000 && $k < 80000) {
      return 11;
    } else if ($k >= 80000 && $k < 100000) {
      return 12;
    } else if ($k >= 100000 && $k < 125000) {
      return 13;
    } else if ($k >= 125000 && $k < 150000) {
      return 14;
    } else if ($k >= 150000) {
      return 15;
    }
  }

  public function evaluate_rating() {
    $kd = $this->calculate_kill_death_ratio();
    $k = $this->get_kills();
    $r = $this->evaluate_rank();
    if ($kd >= 0 && $kd < 0.15) {
      return "D";
    } else if ($kd >= 0.15 && $kd < 0.3) {
      return "D+";
    } else if ($kd >= 0.3 && $kd < 0.4) {
      return "C-";
    } else if ($kd >= .4 && $kd < 0.55) {
      return "C";
    } else if ($kd >= 0.55 && $kd < 0.7) {
      return "C+";
    } else if ($kd >= 0.7 && $kd < 0.85) {
      return "B-";
    } else if ($kd >= 0.85 && $kd < 1) {
      return "B";
    } else if ($kd >= 1 && $kd < 1.3) {
      return "B+";
    } else if ($kd >= 1.3  && $kd < 1.7) {
      return "A-";
    } else if ($kd >= 1.7 && $kd < 2) {
      return "A";
    } else if ($kd >= 2 && $kd < 3 && $k >= 5000) {
      return "A+";
    } else if ($kd >= 2 && $r >= 0 && $k < 5000) {
      return "A+";
    } else if ($kd >= 3 && $kd < 5 && $k >= 5000) {
      return "A++";
    } else if ($kd >= 5 && $k == 5000) {
      return "A++";
    } else if ($kd >= 5 && $k >= 10000) {
      return "A+++";
    }
  }
}