<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam;

class AssetSource
{
    /** @var string */
    public $sourceIdentifier;

    public function __construct(string $sourceIdentifier)
    {
        $this->sourceIdentifier = $sourceIdentifier;
    }

    public function getSourceIdentifier(): string
    {
        return $this->sourceIdentifier;
    }
}
