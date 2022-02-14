<?php

namespace App\Tests;

use App\Entity\Visite;
use PHPUnit\Framework\TestCase;

/**
 * Description of VisiteTest
 *
 * @author Niels-Patrick
 */
class VisiteTest extends TestCase {
    
    /**
     * Test vérifiant que la méthode getDatecreationString()
     * retourne la bonne date au format "JJ/MM/AAAA"
     */
    public function testGetDatecreationString(){
        $visite = new Visite();
        $visite->setDatecreation(new \DateTime("2021-11-24"));
        $this->assertEquals("24/11/2021", $visite->getDatecreationString());
    }
    
}
