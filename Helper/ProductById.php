<?php

namespace Perspective\ProductByID\Helper;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductById extends AbstractHelper
{
    private $productRepository;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository
    )
    {
        parent::__construct($context);
        $this->productRepository = $productRepository;
    }

    /**
     * @return ProductInterface|string
     */
    public function getProductById()
    {
        try {
            return $this->productRepository->getById(
                $this->_getRequest()->getParam('productId', -1)
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
                $this->_getRequest()->getParam('productSku', -1)
            );
        } catch (NoSuchEntityException $exception)
        {
            return 'not_found_product';
        }
    }
}
