<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam;

use App\Connector\Dam\Handler\HandlersRegistryInterface;
use App\Connector\Dam\Search\Query;

class AssetService implements AssetServiceInterface
{
    /** @var \App\Connector\Dam\Handler\HandlersRegistryInterface */
    private $collector;

    public function __construct(HandlersRegistryInterface $collector)
    {
        $this->collector = $collector;
    }

    public function search(Query $query, int $page = 1, int $limit = 20): AssetCollection
    {
        return $this
            ->collector
            ->getHandler($query->getSource())
            ->search($query, $page, $limit);
    }

    public function fetchAsset(
        AssetIdentifier $identifier,
        AssetSource $source,
        array $parameters = []
    ): Asset {
        return $this
            ->collector
            ->getHandler($source)
            ->fetchAsset($identifier->getId(), $parameters);
    }
}
