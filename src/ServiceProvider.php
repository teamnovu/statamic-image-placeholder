<?php

namespace Teamnovu\StatamicImagePreview;

use App\Http\Resources\CustomEntryResource;
use Statamic\Http\Resources\API\EntryResource;
use Statamic\Http\Resources\API\Resource;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        'Statamic\Events\AssetUploaded' => [
            'Teamnovu\StatamicImagePreview\Listeners\GenerateImagePreview',
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
