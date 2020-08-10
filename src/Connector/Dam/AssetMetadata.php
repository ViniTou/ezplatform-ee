<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam;

class AssetMetadata
{
    /** @var array */
    private $metadata;

    public function __construct(array $metadata)
    {
        $this->metadata = $metadata;
    }

    public function getMetadataValue(string $metadataName)
    {
        return $this->metadata[$metadataName];
    }
}
