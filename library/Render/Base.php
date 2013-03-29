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

require_once APP_PATH . '/library/Generic/Specimen.php';
require_once APP_PATH . '/library/Generic/Problem.php';


abstract class Base
{
    /**
     * @var Generic\Problem
     */
    protected $problem = null;


    /**
     * @param Generic\Problem $problem
     */
    public function __construct(Generic\Problem $problem)
    {
        $this->_problem = $problem;
    }

    /**
     * @return string
     */
    abstract public function render();

    /**
     * @param Generic\Specimen $specimen
     * @return string
     */
    abstract public function renderSpecimen(Generic\Specimen $specimen);
}