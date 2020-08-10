<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Unsplash\Dam\Handler;

use App\Connector\Dam\Asset;
use App\Connector\Dam\AssetCollection;
use App\Connector\Dam\AssetIdentifier;
use App\Connector\Dam\AssetLocation;
use App\Connector\Dam\AssetMetadata;
use App\Connector\Dam\AssetSource;
use App\Connector\Dam\Search\Query;
use App\Unsplash\UnsplashClient;

class Handler implements \App\Connector\Dam\Handler\Handler
{
    /** @var \App\Unsplash\UnsplashClient */
    private $client;

    public function __construct(UnsplashClient $client)
    {
        $this->client = $client;
    }

    public function search(Query $query, int $page, int $limit): AssetCollection
    {
        $pageResult = $this->client->photos(
            $query->getPhrase(),
            $page,
            $limit
        );

        $results = $pageResult->getResults();

        $assets = [];
        foreach ($results as $result) {
            $assets[] = new Asset(
                new AssetIdentifier($result['id']),
                new AssetSource('unsplash'),
                new AssetLocation($result['urls']['raw']),
                new AssetMetadata([])
            );
        }

        return new AssetCollection($assets);
    }

    public function fetchAsset(string $id, array $parameters = []): Asset
    {
        $photo = $this->client->find($id);

        return new Asset(
            new AssetIdentifier((string)$photo->id),
            new AssetSource('unsplash'),
            new AssetLocation($photo->urls['regular']),
            new AssetMetadata([])
        );
    }
}
