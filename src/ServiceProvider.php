<?php

namespace Teamnovu\StatamicImagePlaceholder;

use Teamnovu\Http\Resources\CustomEntryResource;
use Statamic\Http\Resources\API\EntryResource;
use Statamic\Http\Resources\API\Resource;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        'Statamic\Events\AssetUploaded' => [
            'Teamnovu\StatamicImagePlaceholder\Listeners\GenerateImagePlaceholder',
        ],
    ];

    protected $subscribe = [
        'Statamic\Events\AssetUploaded'
    ];

    public function boot()
    {
        parent::boot();

        Resource::map([
            EntryResource::class => CustomEntryResource::class
        ]);
    }
}
