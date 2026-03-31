<?php

namespace App\Tests;

use App\Entity\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testEventVisibleSiPublieEtDateFuture(): void
    {
        $event = new Event();
        $event->setTitre('Concert');
        $event->setIsPublished(true);
        $event->setDateDebut(new \DateTime('+1 day'));

        $this->assertTrue($event->isVisible());
    }

    public function testEventNonVisibleSiNonPublie(): void
    {
        $event = new Event();
        $event->setTitre('Concert');
        $event->setIsPublished(false);
        $event->setDateDebut(new \DateTime('+1 day'));

        $this->assertFalse($event->isVisible());
    }

    public function testEventNonVisibleSiDatePassee(): void
    {
        $event = new Event();
        $event->setTitre('Concert');
        $event->setIsPublished(true);
        $event->setDateDebut(new \DateTime('-1 day'));

        $this->assertFalse($event->isVisible());
    }
}