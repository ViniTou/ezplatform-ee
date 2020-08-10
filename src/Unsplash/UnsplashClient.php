<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Unsplash;

use Crew\Unsplash\PageResult;
use Crew\Unsplash\Photo;

class UnsplashClient
{
    public function __construct(
        string $applicationId,
        ?string $secret = null,
        ?string $callbackUrl = null,
        ?string $utmSource = null
    ) {
        \Crew\Unsplash\HttpClient::init([
            'applicationId' => $applicationId,
//            'secret' => $secret,
//            'callbackUrl' => $callbackUrl,
            'utmSource' => $utmSource,
        ]);
    }

    public function photos(
        string $search,
        int $page = 1,
        int $perPage = 10,
        ?string $orientation = null,
        ?string $collections = null
    ): PageResult {
        return \Crew\Unsplash\Search::photos($search, $page, $perPage, $orientation, $collections);
    }

    public function find(
        string $id
    ): Photo {
        return \Crew\Unsplash\Photo::find($id);
    }
}
