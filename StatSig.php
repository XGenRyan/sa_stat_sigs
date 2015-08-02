<?php
namespace Targex\StickArena;
use \SimpleXMLElement;

class StatSig
{
  protected $stats;
  protected $league_champions;
  protected $users_with_builders;

  public function __construct($username) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.xgenstudios.com/?method=xgen.stickarena.stats.get&username=".$username);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);
    curl_close($ch);
    $xml = new \SimpleXMLElement($html);
    $this->stats = $xml[0]->stats->game->user;
    $this->league_champions = ["ava", "jesus", "koolaid", "mayne"];
    $this->users_with_builders = [",.smokez.,", ".,chickenator,.", ".,criticalx,.", ".,syco,.", ".get.money.", "5k1", "718", "77gamer77", "action", "aero", "air,", "believed", "bloodsyn", "bridgeofstraw", "bullet.girl.", "cadaver999", "canasian", "chicken", "codyshadow", "coldhot", "cr1t1c1sm", "criminal", "crocodile", "dan", "deadmafia", "delocuro", "difficult", "dmaster12", "felumade.", "firegun000", "ghecko", "ghostrec0n", "gore4life", "hanktankerous", "heredur", "jaguar", "jakethesnake", "joeseph", "jzuo", "ladybulletx", "luis", "mapymaper.", "masterchuf", "miu", "name", "shadowcasterx4ffc", "shot", "shot..to..kill...", "sk8indude", "springbranch", "stabulator", "stickslayer132", "vegeta,rock", "volt", "wolf", "y3lloman", "yiff."];
  }

  public function get_username() {
    return (string)$this->stats['username'];
  }

  public function get_permissions() {
    return (int)$this->stats['perms'];
  }

  public function get_wins() {
    return (int)$this->stats->stat[0];
  }

  public function get_losses() {
    return (int)$this->stats->stat[1];
  }

  public function get_kills() {
    return (int)$this->stats->stat[2];
  }

  public function get_deaths() {
    return (int)$this->stats->stat[3];
  }

  public function get_total_rounds() {
    return (int)$this->stats->stat[4];
  }

  public function is_banned() {
    return (int)($this->get_permissions() === -1) ? 1 : 0;
  }

  public function is_a_moderator() {
    return (int)($this->get_permissions() > 0) ? 1 : 0;
  }

  public function is_a_league_champion() {
    return (int)in_array(strtolower($this->get_username()), $this->league_champions);
  }

  public function has_a_builder() {
    return (int)in_array(strtolower($this->get_username()), $this->users_with_builders);
  }

  public function has_a_labpass() {
    return (int)$this->stats->stat[5];
  }

  public function calculate_kill_death_ratio() {
    return ($this->get_deaths() === 0) ? (double)$this->get_kills() : floor(($this->get_kills()/$this->get_deaths())*100)/100;
  }

  public function calculate_win_loss_ratio() {
    return ($this->get_losses() === 0) ? (double)$this->get_wins() : floor(($this->get_wins()/$this->get_losses())*100)/100;
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
    return (int)(($this->calculate_rounds_completed()/$this->get_total_rounds())*100);
  }

  public function evaluate_rank() {
    $k = $this->get_kills();
    if ($k < 5) {
      return 0;
    } else if ($k >= 5 && $k < 25) {
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
    if ($kd >= 0.0 && $kd < 0.15) {
      return "D";
    } else if ($kd >= 0.15 && $kd < 0.3) {
      return "D+";
    } else if ($kd >= 0.3 && $kd < 0.4) {
      return "C-";
    } else if ($kd >= 0.4 && $kd < 0.55) {
      return "C";
    } else if ($kd >= 0.55 && $kd < 0.7) {
      return "C+";
    } else if ($kd >= 0.7 && $kd < 0.85) {
      return "B-";
    } else if ($kd >= 0.85 && $kd < 1.0) {
      return "B";
    } else if ($kd >= 1.0 && $kd < 1.3) {
      return "B+";
    } else if ($kd >= 1.3  && $kd < 1.7) {
      return "A-";
    } else if ($kd >= 1.7 && $kd < 2.0) {
      return "A";
    } else if ($kd >= 2.0 && $k < 5000) {
      return "A+";
    } else if ($kd >= 2.0 && $kd < 3.0 && $k >= 5000) {
      return "A+";
    } else if ($kd >= 3.0 && $kd < 5.0 && $k >= 5000) {
      return "A++";
    } else if ($kd >= 5.0 && $k >= 5000 && $k < 10000) {
      return "A++";
    } else if ($kd >= 5.0 && $k >= 10000) {
      return "A+++";
    }
  }
}
