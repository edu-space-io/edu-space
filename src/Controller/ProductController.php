<?php

namespace App\Controller;

//use App\Service\Product\Dto\FilterProductDto;
//use App\Service\Product\Exceptions\ProductAlreadyExistsInCart;
//use App\Service\Product\Exceptions\ProductNotExistsException;
//use Illuminate\Contracts\Foundation\Application;
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Contracts\View\View;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;

use App\Enum\Icon;
use App\Service\Product\AddToCartService;
use App\Service\Product\Dto\FilterProductDto;
use App\Service\Product\Exception\ProductAlreadyExistsInCart;
use App\Service\Product\Exception\ProductNotExistsException;
use App\Service\Product\FilterProductsListService;
use App\Service\Product\GetProductService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
//  /**
// * @param Request $request
// */
//  public function removeFromCart(Request $request): void
//  {
//    try {
//      $this->removeFromCartService->execute($request->product);
//
//      response()->json([
//                         'status' => 'success',
//                       ], JsonResponse::HTTP_OK);
//    } catch (ProductNotExistsException $e) {
//      response()->json([
//                         'status' => 'error',
//                         'message' => $e->getMessage(),
//                       ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
//    }
//  }
//  /**
//   * @param Request $request
//   * @return JsonResponse
//   * @throws ProductNotExistsException
//   */
//  public function decreaseProductInCart(Request $request): JsonResponse
//  {
//    $count = $this->decreaseCountInCartService->execute($request->product);
//
//    return response()->json([
//                              'status' => 'success',
//                              'count' => $count,
//                            ], JsonResponse::HTTP_OK);
//  }
//
//  /**
//   * @param Request $request
//   * @return JsonResponse
//   */
    #[Route('/products/add-to-cart', name: 'products.add-to-cart')]
    public function addToCart(AddToCartService $addToCartService, Request $request): JsonResponse
    {
        try {
            $count = $addToCartService->execute($request->get('product'));

            return new JsonResponse([
                'status' => 'success',
                'count' => $count,
            ], Response::HTTP_OK);
        } catch (ProductAlreadyExistsInCart $e) {
            return new JsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    #[Route('/products', name: 'products')]
    public function index(FilterProductsListService $getProductsListService, Request $request): Response
    {
        $products = $getProductsListService->execute(FilterProductDto::fromRequest($request->query->all()));
        $arrowRight = Icon::ARROW_NARROW_RIGHT();
        $cart = Icon::CART();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'arrow_right' => $arrowRight,
            'cart' => $cart,
        ]);
    }

    /**
     * @throws ProductNotExistsException
     */
    #[Route('/products/{id}', name: 'products.show')]
    public function show(GetProductService $getProductService, int $id): Response
    {
        dd('foo');
        $product = $getProductService->execute($id);
        $arrowLeft = Icon::ARROW_NARROW_LEFT();
        $arrowRight = Icon::ARROW_NARROW_RIGHT();
        $addToCart = Icon::ADD_TO_CART();
        $cart = Icon::CART();

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'arrow_left' => $arrowLeft,
            'arrow_right' => $arrowLeft,
            'add_to_cart' => $addToCart,
            'cart' => $cart
        ]);
    }
}