<?php

namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of VisiteValidationsTest
 *
 * @author Niels-Patrick
 */
class VisiteValidationsTest extends KernelTestCase {
    
    /**
     * 
     * @return Visite
     */
    public function getVisite(): Visite {
        return (new Visite())
                ->setVille("New York")
                ->setPays("USA");
    }
    
    /**
     * Vérifie qu'il n'y a pas d'erreur dans le cas d'une note correcte
     */
    public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite, 0);
    }
    
    /**
     * Vérifie qu'il y a bien une erreur dans le cas d'une note incorrecte
     */
    public function testNonValidNoteVisite(){
        $visite = $this->getVisite()->setNote(21);
        $this->assertErrors($visite, 1);
    }
    
    /**
     * Vérifie qu'il y a bien une erreur dans le cas d'une température max
     * inférieure à la température min
     */
    public function testNonValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(18);
        $this->assertErrors($visite, 1, "min=20, max=18 devrait échouer");
    }
    
    /**
     * Appel au kernel et à "assertCount" pour les tests de
     * récupération d'erreur
     * @param Visite $visite
     * @param int $nbErreursAttendues
     * @param string $message
     */
    public function assertErrors(Visite $visite, int $nbErreursAttendues,
            string $message=""){
        self::bootKernel();
        $error = self::$container->get('validator')->validate($visite);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }

}
