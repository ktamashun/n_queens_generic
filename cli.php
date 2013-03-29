<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Kovács Tamás
 * Date: 2013.03.28.
 * Time: 22:04
 * To change this template use File | Settings | File Templates.
 */

//use Nqueens;

require_once 'config.php';
require_once APP_PATH . '/library/Nqueens/Problem.php';
require_once APP_PATH . '/library/Render/Cli.php';

$problem = new NQueens\Problem(NUMBER_OF_QUEENS, MAX_POPULATION_SIZE);
$problem->generateFirstPopulation(FIRST_POPULATION_SIZE);




$renderer = new Render\Cli($problem);
echo "START POPULATION: \n" . $renderer->render(false);


for ($i = 1; $i <= 100; $i++) {

    if (NUMBER_OF_QUEENS == $problem->getMaxRating()) {
        break;
    }

    $problem->solve();
    echo $i . ". POPULATION: \n" . $renderer->render(false);
}

if (NUMBER_OF_QUEENS == $problem->getMaxRating()) {
    $winnerSpecimen = $problem->getWinnerSpecimen();
    echo "WINNER SOLUTION: \n\n" . $renderer->renderSpecimen($winnerSpecimen) . "\n\n";
} else {
    echo "DID NOT FIND ANY SOLUTIONS :( \n\n";
}
