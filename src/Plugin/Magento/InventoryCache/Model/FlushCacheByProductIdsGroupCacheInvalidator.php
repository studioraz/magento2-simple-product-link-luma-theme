<?php

declare(strict_types=1);

namespace SR\SimpleProductLinkLumaTheme\Plugin\Magento\InventoryCache\Model;

use Magento\InventoryCache\Model\FlushCacheByProductIds;
use SR\SimpleProductLinkLumaTheme\Model\Cache\GroupCacheCleaner;
use SR\SimpleProductLinkLumaTheme\Model\Product\GroupValuesResolver;

class FlushCacheByProductIdsGroupCacheInvalidator
{
    public function __construct(
        private readonly GroupValuesResolver $groupValuesResolver,
        private readonly GroupCacheCleaner $groupCacheCleaner,
    ) {}

    public function afterExecute(FlushCacheByProductIds $subject, $result, array $productIds)
    {
        $this->groupCacheCleaner->cleanGroupValues(
            $this->groupValuesResolver->getByProductIds($productIds)
        );

        return $result;
    }
}
