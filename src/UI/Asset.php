<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\UI;

class Asset
{
    public $id;

    public $uri;

    public $source;

    public function __construct(string $id, string $uri, string $source)
    {
        $this->id = $id;
        $this->uri = $uri;
        $this->source = $source;
    }
}
