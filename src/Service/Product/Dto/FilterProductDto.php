<?php


namespace App\Service\Product\Dto;


use InvalidArgumentException;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class FilterProductDto extends DataTransferObject
{
    public int $perPage = 10;
    public int $page;
    public array $onlyIds = [];

    public static function fromRequest(array $request): self
    {
        try {
            return new self([
                'perPage' => $request['perPage'] ?? 10,
                'page' => $request['page'] ?? 1,
                'onlyIds' => $request['onlyIds'] ?? [],
            ]);
        } catch (UnknownProperties) {
            throw new InvalidArgumentException('Unknown properties in request');
        }
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getOnlyIds(): array
    {
        return $this->onlyIds;
    }
}
