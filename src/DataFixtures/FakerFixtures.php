<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Source Tuto : https://blog.dev-web.io/
 *
 * Install :
 * - composer req orm
 * - composer req --dev make doctrine/doctrine-fixtures-bundle
 * - composer req --dev fzaninotto/faker
 *
 * Done this for create faker data :
 * - php bin/console doctrine:fixtures:load
 *
 * Class FakerFixtures
 * @package App\DataFixtures
 */
class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 products
        // If a few data (<10 000), use this :
        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->setName($faker->name);
            $product->setPrice($faker->randomFloat(2, 5, 1000));
            $product->setDescription($faker->text);
            $manager->persist($product);
        }

        $manager->flush();

        /*
        // If a lot of data (>100 000), use this :
        $batchSize = 20;
        for ($i = 1; $i <= 100000; ++$i) {
            $product = new Product();
            $product->setName($faker->name);
            $product->setPrice($faker->randomFloat(2, 5, 1000));
            $product->setDescription($faker->text);
            $manager->persist($product);
            if (($i % $batchSize) === 0) {
                $manager->flush();
                $manager->clear(); // Detaches all objects from Doctrine!
            }
        }
        $manager->flush();
        */
    }
}