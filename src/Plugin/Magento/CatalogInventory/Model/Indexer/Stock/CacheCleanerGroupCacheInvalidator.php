<?php

declare(strict_types=1);

namespace SR\SimpleProductLinkLumaTheme\Plugin\Magento\CatalogInventory\Model\Indexer\Stock;

use Magento\CatalogInventory\Model\Indexer\Stock\CacheCleaner;
use SR\SimpleProductLinkLumaTheme\Model\Cache\GroupCacheCleaner;
use SR\SimpleProductLinkLumaTheme\Model\Product\GroupValuesResolver;

class CacheCleanerGroupCacheInvalidator
{
    public function __construct(
        private readonly GroupValuesResolver $groupValuesResolver,
        private readonly GroupCacheCleaner $groupCacheCleaner,
    ) {}

    public function afterClean(CacheCleaner $subject, $result, array $productIds, callable $reindex)
    {
        $this->groupCacheCleaner->cleanGroupValues(
            $this->groupValuesResolver->getByProductIds($productIds)
        );

        return $result;
    }
}
