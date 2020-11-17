<?php

namespace Teamnovu\StatamicImagePlaceholder\Http\Resources;

use Statamic\Http\Resources\API\EntryResource;

class CustomEntryResource extends EntryResource
{
    public function toArray($request)
    {
        return $this->resource
            ->toAugmentedCollection()
            ->toArray();
    }
}
