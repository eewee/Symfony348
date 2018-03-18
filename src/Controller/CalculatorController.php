<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

// Source : https://symfony.com/doc/current/testing.html
// Sample for TEST-UNIT (see : /tests/CalculatorTest.php)
class CalculatorController extends Controller
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}
