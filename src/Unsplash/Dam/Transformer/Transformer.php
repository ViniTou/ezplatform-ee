<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Unsplash\Dam\Transformer;

use App\Connector\Dam\Asset;
use App\Connector\Dam\Variation\AssetVariationsTransformer;
use App\Connector\Dam\Variation\Transformation;
use App\UI\Asset as UIAsset;

class Transformer implements AssetVariationsTransformer
{
    public function transform(Asset $asset, Transformation $variation): UIAsset
    {
        $suffix = '';
        if ($variation->getTransformTo() === 'small') {
            $suffix = '&fm=jpg&w=400&fit=max';
        }

        return new UIAsset(
            $asset->getIdentifier()->getId(),
            $asset->getAssetLocation()->getLocation() . $suffix,
            $asset->getSource()->getSourceIdentifier()
        );
    }
}
