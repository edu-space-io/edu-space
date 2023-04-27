<?php

namespace App\Service\Cart;

use App\Entity\Product;
use App\Service\Product\FilterProductsListService;
//use App\Services\Cart\Exceptions\CartIsEmpty;
//use App\Services\Product\Dto\FilterProductDto;
//use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Collection;

class GetCartService
{
    private FilterProductsListService $filterProductListService;

    /**
     * GetCartService constructor.
     * @param FilterProductsListService $filterProductListService
     */
    public function __construct(
        FilterProductsListService $filterProductListService
    )
    {
        $this->filterProductListService = $filterProductListService;
    }

    /**
     * @return Collection
     * @throws CartIsEmpty
     */
    public function execute()
    {
//        if (!session('cart.products')) {
//            throw new CartIsEmpty('В корзине нет продуктов');
//        }
//
//        $productsInCart = collect(session('cart.products'));
//        $productInCartIds = collect(session('cart.products'))->pluck('id')->toArray();
//
//        $filterProductDto = new FilterProductDto([
//            'onlyIds' => $productInCartIds,
//        ]);
//
//        return Product::when(count($filterProductDto->onlyIds), function ($query) use ($filterProductDto) {
//            $query->whereIn('id', $filterProductDto->onlyIds);
//        })
//            ->get()
//            ->map(function ($product) use ($productsInCart) {
//                $productInCart = $productsInCart->firstWhere('id', $product->id);
//                $product->count = $productInCart['count'];
//
//                return $product;
//            });
    }
}
