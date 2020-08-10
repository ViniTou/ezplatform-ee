<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam;

use ArrayIterator;

class AssetCollection implements \IteratorAggregate
{
    /** @var \App\Connector\Dam\Asset[] */
    protected $assets;

    /**
     * @param \App\Connector\Dam\Asset[] $assets
     */
    public function __construct(array $assets)
    {
        $this->assets = $assets;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->assets);
    }

    public function getAssets(): array
    {
        return $this->assets;
    }
}
