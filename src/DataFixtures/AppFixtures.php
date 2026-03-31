<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $event1 = new Event();
        $event1->setTitre('Concert de Jazz');
        $event1->setIsPublished(true);
        $event1->setDateDebut(new \DateTime('+5 days'));
        $manager->persist($event1);

        $event2 = new Event();
        $event2->setTitre('Exposition cachée');
        $event2->setIsPublished(false);
        $event2->setDateDebut(new \DateTime('+3 days'));
        $manager->persist($event2);


        $event3 = new Event();
        $event3->setTitre('Festival terminé');
        $event3->setIsPublished(true);
        $event3->setDateDebut(new \DateTime('-2 days'));
        $manager->persist($event3);

        $manager->flush();
    }
}