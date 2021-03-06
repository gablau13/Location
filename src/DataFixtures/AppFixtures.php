<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Image;
use App\Entity\Anounce;
use App\Entity\Comment;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $slugger = new Slugify();
        for ($i = 0; $i < 8; $i++) {
            $anounce = new Anounce();
            $anounce->setTitle($faker->sentence(3, false))
            ->setIntroduction($faker->text(200))
                ->setSlug($slugger->Slugify($anounce->getTitle()))
                ->setdescription($faker->text(500))
                ->setPrice(mt_rand(30000, 60000))
                ->setAddress($faker->address())
                ->setCoverImage("245ddf7b29d56317b36962962ba625bf.jpg")
                ->setRoom(mt_rand(1, 5))
                ->setIsAvailable(mt_rand(0, 1))
                ->setCreateAt($faker->dateTimeThisYear('+2 months'));

            for ($j = 0; $j<mt_rand(0, 10); $j++) {
                $comment = new Comment();
                $comment->setAuthor($faker->name())
                    ->setMail($faker->email())
                    ->setContent($faker->text(200))
                    ->setCreatedAt($faker->datetimeBetween('-3 month', 'now'))
                    ->setAnounce($anounce);
                $manager->persist($comment);
                $anounce->AddComment($comment);
            }
           for ($k=0; $k<mt_rand(0,7); $k++){
               $image=new Image();
               $image->setImageUrl('https://picsum.photos/500/300/?ramdom=' . mt_rand(1, 50000))
                     ->setDescription($faker->sentence())
                     ->setAnounce($anounce);
                $manager->persist($image);
                $anounce->AddImage($image);
           }
            $manager->persist($anounce);
        }

        $manager->flush();
    }
}
