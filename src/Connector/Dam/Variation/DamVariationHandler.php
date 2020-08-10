<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace App\Connector\Dam\Variation;

use App\Connector\Dam\AssetSource;
use App\Connector\Dam\Collector\GenericCollector;
use eZ\Bundle\EzPublishCoreBundle\Imagine\IORepositoryResolver;
use eZ\Publish\API\Repository\Exceptions\InvalidVariationException;
use eZ\Publish\API\Repository\Values\Content\Field;
use eZ\Publish\API\Repository\Values\Content\VersionInfo;
use eZ\Publish\Core\FieldType\Image\Value as ImageValue;
use eZ\Publish\Core\MVC\Exception\SourceImageNotFoundException;
use eZ\Publish\SPI\FieldType\Value;
use eZ\Publish\SPI\Variation\Values\ImageVariation;
use eZ\Publish\SPI\Variation\VariationHandler;
use Imagine\Exception\RuntimeException;
use InvalidArgumentException;
use Liip\ImagineBundle\Exception\Binary\Loader\NotLoadableException;
use Liip\ImagineBundle\Exception\Imagine\Cache\Resolver\NotResolvableException;
use App\FieldType\DamImageAsset\Value as DamValue;

class DamVariationHandler implements VariationHandler
{

    /** @var \App\Connector\Dam\Collector\GenericCollector */
    private $collector;

    public function __construct(GenericCollector $collector)
    {
        $this->collector = $collector;
    }

    public function getVariation(
        Field $field,
        VersionInfo $versionInfo,
        $variationName,
        array $parameters = []
    ) {
        /** @var \App\FieldType\DamImageAsset\Value $imageValue */
        $imageValue = $field->value;
        $fieldId = $field->id;
        $fieldDefIdentifier = $field->fieldDefIdentifier;
        if (!$this->supportsValue($imageValue)) {
            throw new InvalidArgumentException("Value of Field with ID $fieldId ($fieldDefIdentifier) cannot be used for generating an image variation.");
        }

        $source = new AssetSource($imageValue->source);
        $asset = $this
            ->collector
            ->getHandler($source)
            ->fetchAsset($imageValue->destinationContentId);

        $transformedAsset = $this
            ->collector
            ->getTransformer($source)
            ->transform($asset, new Transformation($variationName));

        return new ImageVariation(
            [
                'name' => $variationName,
                'fileName' => $transformedAsset->id,
                'dirPath' => $transformedAsset->uri,
                'uri' => $transformedAsset->uri,
                'imageId' => $transformedAsset->id,
                'width' => 1,
                'height' => 1,
                'fileSize' => 1,
                'mimeType' => 'jpg',
                'lastModified' => '20-20-2020',
            ]
        );
    }

    private function supportsValue(Value $value): bool
    {
        return $value instanceof DamValue;
    }
}
