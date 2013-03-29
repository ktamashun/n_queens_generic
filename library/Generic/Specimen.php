<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamás Kovács
 * Date: 2013.03.28.
 * Time: 22:36
 * To change this template use File | Settings | File Templates.
 */

namespace Generic;


abstract class Specimen
{
    protected $_chromosomes = array();
    protected $_chromosomeNumber = 1;


    /**
     * @param array $chromosomes
     */
    public function __construct($chromosomes)
    {
        $this->_chromosomes = $chromosomes;
        $this->_chromosomeNumber = count($chromosomes);
    }

    /**
     * @return array
     */
    public function getChromosomes()
    {
        return $this->_chromosomes;
    }

    /**
     * @return int
     */
    abstract public function getRating();

    /**
     * @param int $number
     * @return Specimen
     */
    abstract public function mutate($number);
}
