<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Controller;

use App\Connector\Dam\AssetIdentifier;
use App\Connector\Dam\AssetServiceInterface;
use App\Connector\Dam\AssetSource;
use App\Connector\Dam\Search\Query;
use App\Connector\Dam\Variation\AssetVariationsTransformer;
use App\Connector\Dam\Variation\Transformation;
use App\Form\Type\DamSearchType;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\API\Repository\Values\Content\Field;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DamAssetSearchController extends AbstractController
{
    /** @var \Symfony\Component\Form\FormFactoryInterface */
    private $formFactory;

    /** @var \App\Connector\Dam\AssetServiceInterface */
    private $damConnectorService;

    /** @var \App\Connector\Dam\Variation\AssetVariationsTransformer */
    private $assetVariationTransformer;

    public function __construct(
        FormFactoryInterface $formFactory,
        AssetServiceInterface $damConnectorService,
        AssetVariationsTransformer $assetVariationTransformer
    ) {
        $this->formFactory = $formFactory;
        $this->damConnectorService = $damConnectorService;
        $this->assetVariationTransformer = $assetVariationTransformer;
    }

    public function modalAction(Request $request)
    {
        return $this->render(
            '@ezdesign/modal/select_from_dam.html.twig',
            [
                'form' => $this->formFactory->create(
                    DamSearchType::class
                )->createView(),
            ]
        );
    }

    public function fetchResultsAction(Request $request): JsonResponse
    {
        $assetCollection = $this->damConnectorService->search(
            new Query($request->get('query'), new AssetSource($request->get('source')))
        );

        $variation = new Transformation($request->get('variation'));

        $usAssets = [];
        foreach ($assetCollection as $asset) {
            $usAssets[] = $this->assetVariationTransformer->transform($asset, $variation);
        }

        return new JsonResponse($usAssets);
    }

    public function renderAssetAction(
        string $id,
        string $source,
        Content $content,
        Field $field,
        array $parameters = []
    ) {
        $asset = $this->damConnectorService->fetchAsset(
            new AssetIdentifier($id),
            new AssetSource($source),
            $parameters
        );

        return $this->render(
            '@ezdesign/field_type/damimageasset/ezdamimageasset.html.twig',
            [
                'field' => $field,
                'content' => $content,
                'asset' => $asset,
            ]

        );
    }
}
