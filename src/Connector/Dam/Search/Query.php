<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam\Search;

use App\Connector\Dam\AssetSource;

class Query
{
    /** @var string */
    protected $phrase;

    /** @var \App\Connector\Dam\AssetSource */
    protected $source;

    public function __construct(string $phrase, AssetSource $source)
    {
        $this->phrase = $phrase;
        $this->source = $source;
    }

    public function getPhrase(): string
    {
        return $this->phrase;
    }

    public function getSource(): AssetSource
    {
        return $this->source;
    }
}
