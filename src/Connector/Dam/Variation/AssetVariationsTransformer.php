<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam\Variation;

use App\Connector\Dam\Asset;

interface AssetVariationsTransformer
{
    public function transform(Asset $asset, Transformation $variation): \App\UI\Asset;
}
