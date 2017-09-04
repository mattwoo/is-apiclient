<?php

namespace Mattwoo\IsystemsClient\HTTP\Response\DTO;

/**
 * This file is a part of apiclient package.
 * Author: Mateusz Westwalewicz
 * Date: 31.08.2017
 * Time: 12:59
 */
class Producer implements \JsonSerializable
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $siteUrl;
    /**
     * @var string
     */
    private $logoFilename;
    /**
     * @var string
     */
    private $ordering;
    /**
     * @var string
     */
    private $sourceId;

    public function __construct(
        ?int $id,
        string $name,
        ?string $siteUrl,
        string $logoFilename,
        int $ordering,
        ?string $sourceId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->siteUrl = $siteUrl;
        $this->logoFilename = $logoFilename;
        $this->ordering = $ordering;
        $this->sourceId = $sourceId;
    }

    public static function createByArray(array $p): Producer
    {
        return new self(
            $p['id'], $p['name'], $p['site_url'], $p['logo_filename'], $p['ordering'], $p['source_id']
        );
    }

    /** {@inheritdoc} */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'site_url' => $this->siteUrl,
            'logo_filename' => $this->logoFilename,
            'ordering' => $this->ordering,
            'source_id' => $this->sourceId,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function getLogoFilename(): string
    {
        return $this->logoFilename;
    }

    public function getOrdering(): string
    {
        return $this->ordering;
    }

    public function getSourceId(): string
    {
        return $this->sourceId;
    }
}
