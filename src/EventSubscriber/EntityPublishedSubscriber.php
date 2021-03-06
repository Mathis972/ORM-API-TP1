<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EntityPublishedSubscriber implements EventSubscriber
{
  public function getSubscribedEvents()
  {
    return [
      Events::preUpdate
    ];
  }

  public function preUpdate(LifecycleEventArgs $args)
  {
    $object = $args->getObject();

    if ($object instanceof Article && $object->getStatus() == 2) {
        $object->setPublished(new DateTime());
    }
  }
}