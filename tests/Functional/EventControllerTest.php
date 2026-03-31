<?php

namespace App\Tests\Functional;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    private $entityManager;
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();

        $this->entityManager->createQuery('DELETE FROM App\Entity\Event e')->execute();
    }

    public function testEventVisibleApparait(): void
    {
        $event = new Event();
        $event->setTitre('Concert visible');
        $event->setIsPublished(true);
        $event->setDateDebut(new \DateTime('+1 day'));

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        $this->client->request('GET', '/events');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Concert visible');
    }

    public function testEventNonVisibleNApparaistPas(): void
    {
        $event = new Event();
        $event->setTitre('Concert caché');
        $event->setIsPublished(false);
        $event->setDateDebut(new \DateTime('+1 day'));

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        $this->client->request('GET', '/events');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorNotExists('h2');
    }
}