<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam;

use App\Connector\Dam\Search\Query;

interface AssetServiceInterface
{
    public function search(Query $query, int $page = 1, int $limit = 20): AssetCollection;

    public function fetchAsset(AssetIdentifier $identifier, AssetSource $source, array $parameters = []): Asset;
}
