<?php

/**
 * https://devdocs.magento.com/guides/v2.4/extension-dev-guide/view-models.html
 */
namespace Perspective\ProductByID\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductById implements ArgumentInterface
{
    private $productRepository;
    private $request;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        RequestInterface $request
    )
    {
        $this->productRepository = $productRepository;
        $this->request = $request;
    }

    /**
     * @return ProductInterface|string
     */
    public function getProductById()
    {
        try {
            return $this->productRepository->getById(
                $this->request->getParam('productId', -1)
            );
        } catch (NoSuchEntityException $exception)
        {
            return 'not_found_product';
        }
    }

    /**
     * @return ProductInterface|string
     */
    public function getProductBySku()
    {
        try {
            return $this->productRepository->get(
                $this->request->getParam('productSku', -1)
            );
        } catch (NoSuchEntityException $exception)
        {
            return 'not_found_product';
        }
    }
}
