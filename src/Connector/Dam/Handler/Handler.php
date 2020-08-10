<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam\Handler;

use App\Connector\Dam\AssetCollection;
use App\Connector\Dam\Search\Query;

interface Handler
{
    public function search(Query $query, int $page, int $limit): AssetCollection;

    public function fetchAsset(string $id, array $parameters = []);
}
