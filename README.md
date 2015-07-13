# Introduction
Here you will find the code that was used to make the mobile version of the Targex stat sigs. It makes extracting player stats from XGen's API absolutely painless.

# Instructions
1. Copy the StatSig.php file to your directory.
2. Make a new file, name it whatever you want (I'll call mine index.php).
3. Include the StatSig.php file in your index.php file, like so:
```php
require_once("StatSig.php");
```
4. Use the Targex namespace, like so:
```php
use Targex\Stats\StatSig;
```
5. Initialize an instance of the StatSig class, like so:
```php
$player = new StatSig($_POST['username']);
```
 * Note: $player and $_POST['username'] can be renamed to whatever you want; however, if you're making a stat sig site I recommend keeping them as they are.
6. From here it's rather intuitive, you just use it like this:
```php
echo $player->get_kills();
```
7. Save index.php

# Quick Reference
Here are all of the method names in the StatSig class:
* get_username
* get_permissions
* get_wins
* get_losses
* get_kills
* get_deaths
* get_total_rounds
* is_banned
* is_a_moderator
* is_a_league_champion
* has_a_labpass
* has_a_builder
* calculate_kill_death_ratio
* calculate_win_loss_ratio
* calculate_rounds_completed
* calculate_rounds_forfeited
* calculate_kills_per_round
* calculate_deaths_per_round
* calculate_round_completion
* evaluate_rank
* evaluate_rating

# Additional
If you still don't quite get it, take a look at example.php.