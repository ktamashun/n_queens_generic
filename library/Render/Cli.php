<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamás Kovács
 * Date: 2013.03.28.
 * Time: 23:10
 * To change this template use File | Settings | File Templates.
 */

namespace Render;

use Generic;

require_once 'Base.php';

class Cli extends Base
{
    /**
     * @param $withSpecimens
     * @return string
     */
    public function render($withSpecimens = true)
    {
        $problem = $this->_problem;
        $population = $problem->getPopulation();
        $str = "---------------------------------------------------------\n"
            . ' Number of queens: ' . count($population[1]->getChromosomes()) . "\n"
            . ' Population size: ' . count($population) . "\n"
            . ' Best possible rating: ' . count($population[1]->getChromosomes()) . "\n"
            . ' Average rating: ' . $problem->getAvgRating() . "\n"
            . ' Maximum rating: ' . $problem->getMaxRating() . "\n"
            . "---------------------------------------------------------\n\n";

        if ($withSpecimens) {
            foreach ($population as $i => $specimen)
            {
                $str .= '#' . ($i + 1) . ': Rating: ' . $specimen->getRating() . "\n" . $this->renderSpecimen($specimen) . "\n";
            }
        }

        return $str;
    }

    /**
     * @param Generic\Specimen $specimen
     * @return string
     */
    public function renderSpecimen(Generic\Specimen $specimen)
    {
        $str = '';
        $chromosomes = $specimen->getChromosomes();
        $chromosomeNumber = count($chromosomes);

        foreach ($chromosomes as $value)
        {
            $row = str_pad('X', $value, '.', STR_PAD_LEFT) . str_pad('', $chromosomeNumber - $value, '.', STR_PAD_LEFT);
            $str .= str_replace(array('.', 'X'), array('. ', 'X '), $row) . "\n";
        }

        return $str;
    }
}