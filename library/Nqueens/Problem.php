<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamás Kovács
 * Date: 2013.03.28.
 * Time: 22:14
 * To change this template use File | Settings | File Templates.
 */

namespace Nqueens;
use Generic;

require_once APP_PATH . '/library/Generic/Problem.php';
require_once APP_PATH . '/library/Nqueens/Specimen.php';


class Problem extends Generic\Problem
{
    /**
     * Létrehoz egy random adatokkal feltöltött példányt.
     *
     * @return Specimen
     */
    public function generateRandomSpecimen()
    {
        $chromosomes = array();

        for ($i = 1; $i <= $this->_size; $i++)
        {
            $chromosomes[$i] = rand(1, $this->_size);
        }

        return new Specimen($chromosomes);
    }

    /**
     * Létrehoz egy megadott adatokkal feltöltött példányt.
     *
     * @return Specimen
     */
    public function generateSpecimen($chromosomes)
    {
        return new Specimen($chromosomes);
    }
}
