<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamás Kovács
 * Date: 2013.03.28.
 * Time: 22:14
 * To change this template use File | Settings | File Templates.
 */

namespace Generic;
use Nqueens\Specimen;
use Render;


abstract class Problem
{
    /**
     * @var Specimen[]
     */
    protected $_population = array();

    /**
     * @var Render\Base
     */
    protected $_renderer = null;

    /**
     * @var int
     */
    protected $_maxPopulationSize = 200;
    protected $_size = null;


    /**
     * @param $maxPopulationSize
     */
    public function __construct($size, $maxPopulationSize)
    {
        $this->_maxPopulationSize = $maxPopulationSize;
        $this->_size = $size;
    }

    /**
     * @param int $populationSize
     * @return Problem
     */
    function generateFirstPopulation($populationSize = 100)
    {
        for ($i = 1; $i <= $populationSize; $i++) {
            $this->_population[] = $this->generateRandomSpecimen();
        }

        return $this;
    }

    /**
     * @return Specimen[]
     */
    public function getPopulation()
    {
        return $this->_population;
    }

    /**
     * @return array
     */
    public function getRatings()
    {
        $ratings = array();

        foreach ($this->getPopulation() as $specimen) {
            $ratings[] = $specimen->getRating();
        }

        return $ratings;
    }

    /**
     * @return float
     */
    public function getAvgRating()
    {
        $ratings = $this->getRatings();
        return array_sum($ratings) / count($ratings);
    }

    /**
     * @return int
     */
    public function getMaxRating()
    {
        $ratings = $this->getRatings();
        $maxRating = 0;

        foreach ($ratings as $rating) {
            if ($rating > $maxRating) {
                $maxRating = $rating;
            }
        }

        return $maxRating;
    }

    public function getWinnerSpecimen()
    {
        foreach ($this->_population as $specimen) {
            if ($this->_size == $specimen->getRating()) {
                return $specimen;
            }
        }
    }

    /**
     * @param Render\Base $renderer
     * @return Problem
     */
    public function setRenderer(Render\Base $renderer)
    {
        $this->_renderer = $renderer;
        return $this;
    }

    /**
     *
     */
    public function solve()
    {
        // filter by avg rating
        // mutation
        // cross breeding
        // check max rating
        // repeat

        $this->preformMutation(1);
        $this->preformCrossBreeding();
        $this->filterPopulation();
    }

    /**
     * @param Specimen $s1
     * @param Specimen $s2
     * @return Specimen
     */
    public function crossBreed(Specimen $s1, Specimen $s2)
    {
        $ch1 = $s1->getChromosomes();
        $ch2 = $s2->getChromosomes();

        $split = rand(1, count($ch1));
        $newCh = array();

        for ($i = 1; $i <= count($ch1); $i++) {
            if ($i <= $split) {
                $newCh[$i] = $ch1[$i];
            } else {
                $newCh[$i] = $ch2[$i];
            }
        }

        return $this->generateSpecimen($newCh);
    }

    /**
     *
     */
    public function preformCrossBreeding()
    {
        $population = $this->_population;
        $populationSize = count($population);
        $this->_population = array();

        for ($i = 0; $i < $populationSize; $i++) {
            for ($j = ($populationSize - 1); $j > $i; $j--) {
                $this->_population[] = $this->crossbreed($population[$i], $population[$j]);
            }
        }
    }

    /**
     * @param int $number
     */
    public function preformMutation($number = 1)
    {
        foreach ($this->_population as $specimen) {
            $specimen->mutate($number);
        }
    }

    public function filterPopulation()
    {
        $newPopulation = array();
        $avgRating = $this->getAvgRating();

        foreach ($this->_population as $specimen) {
            if ($avgRating <= $specimen->getRating()) {
                $newPopulation[] = $specimen;
            }

            if (count($newPopulation) >= $this->_maxPopulationSize) {
                break;
            }
        }

        if (count($newPopulation) < $this->_maxPopulationSize) {
            foreach ($this->_population as $specimen) {
                if ($avgRating > $specimen->getRating()) {
                    $newPopulation[] = $specimen;
                }

                if (count($newPopulation) >= $this->_maxPopulationSize) {
                    break;
                }
            }
        }

        $this->_population = $newPopulation;
    }

    /**
     * Létrehoz egy random adatokkal feltöltött példányt.
     *
     * @return Specimen
     */
    abstract public function generateRandomSpecimen();

    /**
     * Létrehoz egy megadott adatokkal feltöltött példányt.
     *
     * @return Specimen
     */
    abstract public function generateSpecimen($chromosomes);
}
