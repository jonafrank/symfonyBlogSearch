<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use AppBundle\Entity\Post;

class LoadPostData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = new Faker\Generator();
        $faker->addProvider(new Faker\Provider\en_US\Text($faker));
        $faker->addProvider(new Faker\Provider\Lorem($faker));
        for ($i=1; $i<=100; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(4));
            $post->setBody($faker->realText(500));
            $manager->persist($post);
        }
        $manager->flush();
    }
}
