<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
class ProductSeed extends Fixture
{
    private ProductFactory $productFactory;

    public function __construct(ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 100) as $i) {
            $product = $this->productFactory->createProduct();
            $manager->persist($product);
        }
    }
}