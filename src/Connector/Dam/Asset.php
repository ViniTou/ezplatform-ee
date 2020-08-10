<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam;

class Asset
{
    /** @var \App\Connector\Dam\AssetIdentifier */
    protected $identifier;

    /** @var \App\Connector\Dam\AssetSource */
    protected $source;

    /** @var \App\Connector\Dam\AssetLocation */
    protected $assetLocation;

    public function __construct(
        AssetIdentifier $identifier,
        AssetSource $source,
        AssetLocation $assetLocation,
        AssetMetadata $assetMetadata
    ) {
        $this->identifier = $identifier;
        $this->source = $source;
        $this->assetLocation = $assetLocation;
    }

    public function getIdentifier(): AssetIdentifier
    {
        return $this->identifier;
    }

    public function getSource(): AssetSource
    {
        return $this->source;
    }

    public function getAssetLocation(): AssetLocation
    {
        return $this->assetLocation;
    }
}
