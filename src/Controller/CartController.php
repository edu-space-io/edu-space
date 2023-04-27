<?php

namespace App\Controller;

//use App\Service\Cart\Exceptions\CartIsEmpty;
//use App\Service\Cart\GetCartService;
//use App\Service\Product\AddToCartService;
//use App\Service\Product\Dto\FilterProductDto;
//use App\Service\Product\Exceptions\ProductAlreadyExistsInCart;
//use App\Service\Product\Exceptions\ProductNotExistsException;
//use App\Service\Product\FilterProductsListService;
//use App\Service\Product\GetProductService;
//use Illuminate\Contracts\Foundation\Application;
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Contracts\View\View;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
//    private FilterProductsListService $getProductsListService;
//    private GetProductService $getProductService;
//    private AddToCartService $addToCartService;
//    private $getCartService;

//    /**
//     * ProductController constructor.
//     * @param GetCartService $getCartService
//     */
//    public function __construct(
////        GetCartService $getCartService
//    )
//    {
////        $this->getCartService = $getCartService;
//    }

//    /**
//     * @return Application|Factory|View
//     */
    #[Route('/cart', name: 'cart.index')]
    public function index(): Response
    {
//        try {
//            $products = $this->getCartService->execute();

      return $this->render('base.html.twig');
//            return $this->render('cart/base.html.twig', [
//                'products' => $products,
//            ]);
//        } catch (CartIsEmpty $e) {
//            return view('cart.index', [
//                'products' => [],
//            ]);
//        }

    }
}
