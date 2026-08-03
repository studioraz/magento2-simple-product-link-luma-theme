<?php

declare(strict_types=1);

namespace SR\SimpleProductLinkLumaTheme\Observer;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use SR\SimpleProductLinkLumaTheme\Model\Cache\GroupCacheCleaner;
use SR\SimpleProductLinkLumaTheme\Model\Product\GroupValuesResolver;
use SR\SimpleProductLinkLumaTheme\Setup\Patch\Data\AddSimpleProductGroupAttribute;

class InvalidateCacheOnProductSave implements ObserverInterface
{
    public function __construct(
        private readonly GroupCacheCleaner $groupCacheCleaner,
        private readonly GroupValuesResolver $groupValuesResolver,
    ) {}

    public function execute(Observer $observer): void
    {
        /** @var Product $product */
        $product = $observer->getEvent()->getProduct();
        if (!$product) {
            return;
        }

        $attributeCode = AddSimpleProductGroupAttribute::ATTRIBUTE_CODE;
        $groupValues = [
            $product->getData($attributeCode),
            $product->getOrigData($attributeCode),
        ];

        $productId = (int)$product->getId();
        if ($productId > 0) {
            $groupValues = array_merge(
                $groupValues,
                $this->groupValuesResolver->getByProductIds([$productId])
            );
        }

        if (!$this->hasGroupValue($groupValues)) {
            return;
        }

        $this->groupCacheCleaner->cleanGroupValues($groupValues);
    }

    /**
     * @param mixed[] $groupValues
     */
    private function hasGroupValue(array $groupValues): bool
    {
        foreach ($groupValues as $groupValue) {
            if ($groupValue !== null && $groupValue !== '') {
                return true;
            }
        }

        return false;
    }
}
