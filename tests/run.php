<?php
require_once("StatSigTest.php");

$exceptions = [];
$run = new StatSigTest();

try {
  $run->test_get_username();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_get_permissions();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_get_wins();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_get_losses();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_get_kills();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_get_deaths();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_get_total_rounds();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_is_banned();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_is_a_moderator();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_is_a_league_champion();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_has_a_labpass();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_has_a_builder();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_kill_death_ratio();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_win_loss_ratio();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_rounds_completed();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_rounds_forfeited();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_kills_per_round();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_deaths_per_round();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_calculate_round_completion();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_evaluate_rank();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}
try {
  $run->test_evaluate_rating();
} catch (Exception $e) {
  $exceptions[] = $e->getMessage();
}

$number_of_tests = count(get_class_methods('StatSigTest'))-count(get_class_methods('Exception'));
$number_of_assertions = $run->get_number_of_assertions;
$number_of_failures = count($exceptions);

if ($number_of_failures != 0) {
  if ($number_of_failures == 1) {
    print "\nThere was 1 failure:\n\n";
  } else {
    print "\nThere were ".$number_of_failures." failures:\n\n";
  }
  foreach ($exceptions as $k=>$e) {
    print ++$k.".) ".$e."\n\n";
  }
  print "FAILED!\n";
} else {
  print "\nPASSED!\n";
}

print "Tests: ".$number_of_tests.", Assertions: ".$number_of_assertions.", Failures: ".$number_of_failures.".\n";