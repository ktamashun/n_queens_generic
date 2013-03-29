<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamás Kovács
 * Date: 2013.03.28.
 * Time: 22:37
 * To change this template use File | Settings | File Templates.
 */

namespace Nqueens;
use Generic;
use Render;

require_once APP_PATH . '/library/Generic/Specimen.php';


class Specimen extends Generic\Specimen
{
    protected $_rating = null;


    public function getRating()
    {
        if (null !== $this->_rating) {
            return $this->_rating;
        }

        $rating = 0;
        //$this->_chromosomes = array(1 => 2, 2 => 1, 3 => 1, 4 => 1);

        for ($i = 1; $i <= $this->_chromosomeNumber; $i++) {
            $result = 0;

            for ($j = $this->_chromosomeNumber; $j > $i; $j--) {
                $result = $this->_testPositions(array($i, $this->_chromosomes[$i]), array($j, $this->_chromosomes[$j]));

                if (0 == $result) {
                    break;
                }
            }

            if (0 == $result) {
                break;
            }

            $rating++;
        }

        if ($rating == ($this->_chromosomeNumber - 1)) {
            $rating++;
        }

        return $this->_rating = $rating;
    }

    /**
     * @param int $number
     * @return Specimen
     */
    public function mutate($number)
    {
        for ($n = 0; $n < $number; $n++) {
            $i = rand(1, $this->_chromosomeNumber);
            $j = rand(1, $this->_chromosomeNumber);

            $this->_chromosomes[$i] = $j;
        }

        return $this;
    }

    protected function _testPositions($queen1, $queen2)
    {
        //echo '(' . $queen1[0] . ', ' . $queen1[1] . ') VS. (' . $queen2[0] . ', ' . $queen2[1] . ')' . "\n";

        if ($queen1[0] == $queen2[0]) {
            return 0;
        }
        if ($queen1[1] == $queen2[1]) {
            return 0;
        }
        if (abs($queen2[0] - $queen1[0]) == abs($queen2[1] - $queen1[1])) {
            return 0;
        }

        return 1;
    }
}