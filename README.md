# Introduction
Here you will find the code that was used to make the mobile version of the Targex stat sigs. It makes extracting player stats from XGen's API absolutely painless.

# Instructions
1. Copy the StatSig.php file to your directory.
2. Make a new file, name it whatever you want (I'll call mine index.php).
3. Include the StatSig.php file in your index.php file, like so:
    ```php
require_once("StatSig.php");
\```
4. Use the Targex namespace, like so:
    ```php
use Targex\Stats\StatSig;
\```
5. Initialize an instance of the StatSig class, like so:
    ```php
$player = new StatSig($_POST['username']);
\```
  * Note: $player and $_POST['username'] can be renamed to whatever you want; however, if you're making a stat sig site I recommend keeping them as they are.
6. From here it's rather intuitive, you just use it like this:
    ```php
echo $player->get_kills();
\```
7. Save index.php

# Quick Reference
Here are all of the method names in the StatSig class along with their data types:
* get_username (string)
* get_permissions (int)
* get_wins (int)
* get_losses (int)
* get_kills (int)
* get_deaths (int)
* get_total_rounds (int)
* is_banned (bool)
* is_a_moderator (bool)
* is_a_league_champion (bool)
* has_a_labpass (bool)
* has_a_builder (bool)
* calculate_kill_death_ratio (float)
* calculate_win_loss_ratio (float)
* calculate_rounds_completed (int)
* calculate_rounds_forfeited (int)
* calculate_kills_per_round (float)
* calculate_deaths_per_round (float)
* calculate_round_completion (int)
* evaluate_rank (int)
* evaluate_rating (string)

# Additional
If you still don't quite get it, take a look at example.php.