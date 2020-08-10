<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam\Collector;

use App\Connector\Dam\AssetCollection;
use App\Connector\Dam\AssetIdentifier;
use App\Connector\Dam\AssetSource;
use App\Connector\Dam\Handler\HandlersRegistryInterface;
use App\Connector\Dam\Search\Query;
use App\Connector\Dam\Asset;
use App\Connector\Dam\Variation\TransformersRegistryInterface;
use App\Connector\Dam\Variation\Transformation;
use Traversable;

class GenericCollector implements HandlersRegistryInterface, TransformersRegistryInterface
{
    /** @var \App\Connector\Dam\Handler\Handler[] */
    private $handlers;

    /** @var \App\Connector\Dam\Variation\AssetTransformerService[] */
    private $transformers;

    public function __construct(Traversable $handlers, Traversable $transformers)
    {
        $this->handlers = iterator_to_array($handlers);
        $this->transformers = iterator_to_array($transformers);
    }

    public function getHandler(AssetSource $source)
    {
        return $this->handlers[$source->getSourceIdentifier()];
    }

    public function getTransformer(AssetSource $source)
    {
        return $this->transformers[$source->getSourceIdentifier()];
    }
}
