<?php

declare(strict_types=1);

namespace SR\SimpleProductLinkLumaTheme\Api;

use SR\SimpleProductLinkLumaTheme\Api\Data\LinkRuleInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface LinkRuleRepositoryInterface
{
    /**
     * @throws NoSuchEntityException
     */
    public function getById(int $ruleId): LinkRuleInterface;

    /**
     * @throws CouldNotSaveException
     */
    public function save(LinkRuleInterface $rule): LinkRuleInterface;

    /**
     * @throws CouldNotDeleteException
     */
    public function delete(LinkRuleInterface $rule): bool;
}
