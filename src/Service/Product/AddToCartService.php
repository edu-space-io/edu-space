<?php

namespace App\Service\Product;

use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class AddToCartService
{
    /**
     * @throws InvalidArgumentException
     */
    public function execute(?int $id): bool
    {
        $cache = new FilesystemAdapter();
        $productsInCart = $cache->getItem('cart.products');

        $this->findProduct($id, $productsInCart, $cache);
        if (!$productsInCart) {
            $cache->get('cart.products', function (ItemInterface $item) {
                $item->expiresAfter(3600);
                $item->set([]);
                return $item;
            });

            return true;
        }

        foreach ($productsInCart as $productInCart) {
            if ($productInCart['id'] === $id) {
                $productInCart['count'] += 1;
            }

            return true;
        }

        return false;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function findProduct(?int $id, mixed $productsInCart, FilesystemAdapter $cache): void
    {
        if (!$productsInCart) {
            $cache->get('cart.products', function (ItemInterface $item) use ($id) {
                $item->expiresAfter(3600);

                return [
                    'id' => $id,
                    'count' => 1
                ];
            });
        }
    }
}
