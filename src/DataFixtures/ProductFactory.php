<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\Currency;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ProductFactory
{
    private $manager;
    private $faker;

    public function __construct(ObjectManager $manager)
    {
        $this->faker = FakerFactory::create();
        $this->manager = $manager;
    }

    public function createProduct(): Product
    {
        $product = new Product();

        // Generate dummy data using Faker
        $product->setName($this->faker->words(3,true));
        $product->setDescription($this->faker->sentence);
        $product->setPrice($this->faker->randomFloat(2, 1, 1000));
        $product->setCurrency(Currency::USD());
        $product->setCreatedAt($this->faker->dateTimeBetween('-1 year','now'));

        $this->manager->persist($product);
        $this->manager->flush();

        return $product;
    }
}
