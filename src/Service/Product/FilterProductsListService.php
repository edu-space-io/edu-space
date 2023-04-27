<?php

namespace App\Service\Product;

use App\Entity\Product;
use App\Service\Product\Dto\FilterProductDto;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class FilterProductsListService
{
    private ManagerRegistry $doctrine;
    private PaginatorInterface $paginator;
    public function __construct(ManagerRegistry $doctrine, PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        $this->doctrine = $doctrine;
    }

    public function execute(FilterProductDto $filterProductDto): PaginationInterface
    {
        $query = $this->doctrine->getRepository(Product::class)->createQueryBuilder('p');

        return $this->paginator->paginate(
            $query,
            $filterProductDto->getPage(), // Current page number
            $filterProductDto->getPerPage() // Number of items per page
        );
    }
}
