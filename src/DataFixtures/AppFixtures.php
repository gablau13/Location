<?php

namespace App\DataFixtures;

use App\Entity\Anounce;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        for ($i=0; $i<20; $i++){
      $anounce = new Anounce();
      $anounce ->setTitle("Chambre numero $i");
      $anounce ->setSlug("Chambre-$i");
      $anounce ->setdescription("je loue cette chambre très confortable avec salle de bain!");
      $anounce ->setPrice(75000);
      $anounce ->setAddress("Quartier $i");
      $anounce ->setCoverImage("https://via.placeholder.com/500×300");
      $anounce ->setRoom(mt_rand(0,5));
      $anounce ->setIsAvailable(mt_rand(0,5));
      $anounce ->setCreateAt(new DateTime());
      
        
        $manager->persist($anounce);
    }

    
        $manager->flush();
    }
}
