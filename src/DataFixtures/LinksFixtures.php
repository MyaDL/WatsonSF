<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Link;

class LinksFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $link = new Link();
            $link->setTitle("Titre du lien $i");
            $link->setUrl("https://cvtic.unilim.fr");
            $link->setDescription("Description du lien $i");
            $link->setState(true);

            $manager->persist($link);
        }

        $manager->flush();
    }
}
