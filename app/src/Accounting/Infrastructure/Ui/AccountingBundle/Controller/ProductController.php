<?php

namespace Misa\Accounting\Infrastructure\Ui\AccountingBundle\Controller;

use Misa\Accounting\Application\Input\Product\ProductInput;
use Misa\Accounting\Application\Services\Product\MngService as ProductMngService;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use MisaSdk\Common\Controller\Controller;

/**
 * ProductItemController Class
 *
 * @package Misa\Accounting\Infrastructure\Ui\AccountingBundle\Controller
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Orbis
 * @Route("/product")
 */
class ProductController extends Controller
{
    /** @var ProductMngService */
    private $productMngService;

    public function __construct(ProductMngService $productMngService)
    {
        $this->productMngService = $productMngService;
    }


    /**
     * @Route("", name="accounting_providers_product_create")
     * @Method({"POST"})
     * @param Request $request
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function createProductAction(Request $request, LoggerInterface $logger)
    {
        $logger->info('create Product');

        $id = $this->productMngService->create(new ProductInput(
            $request->get('name'),
            $request->get('item_id')
        ));

        return new JsonResponse(['id' => $id]);
    }

    /**
     * @Route("/{productId}", name="accounting_providers_product_update")
     * @Method({"PUT"})
     * @param $productId
     * @param Request $request
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function updateProductAction($productId, Request $request, LoggerInterface $logger)
    {
        $logger->info('update Product');

        $this->productMngService->update(new ProductInput(
            $request->get('name'),
            $request->get('item_id'),
            false
        ), $productId);

        return new JsonResponse(['ok']);
    }


    /**
     * @Route("/{productId}", name="accounting_providers_product_delete")
     * @Method({"DELETE"})
     * @param $productId
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function deleteProductAction($productId, LoggerInterface $logger)
    {
        $logger->info('delete Product');

        $this->productMngService->remove($productId);

        return new JsonResponse(['ok']);
    }
}
