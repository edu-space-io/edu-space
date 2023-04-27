<?php


namespace App\Service\Product;


use App\Entity\Product;
use App\Service\Product\Exception\ProductNotExistsException;
use Doctrine\Persistence\ManagerRegistry;

class GetProductService
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @throws ProductNotExistsException
     */
    public function execute(int $id): Product
    {
        $product = $this->doctrine->getRepository(Product::class)->find($id);

        if (!$product instanceof Product) {
            throw new ProductNotExistsException("Продукта с id = $id не существует");
        }

        return $product;
    }
}
