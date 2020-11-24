<?php

namespace Teamnovu\StatamicImagePlaceholder\Listeners;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Statamic\Events\AssetUploaded;

class GenerateImagePlaceholder
{
    /**
     * Handle the event.
     *
     * @param  \Statamic\Events\AssetUploaded  $event
     * @return void
     */
    public function handle(AssetUploaded $event)
    {
        $imagePath = public_path('assets/' . $event->asset->path());
        $imageExt = pathinfo($imagePath, PATHINFO_EXTENSION);
        $tempName = uniqid('img_placeholder');
        $tempDestination = public_path('assets/' . $tempName . '.' . $imageExt);

        if (!in_array(strtolower($imageExt), array('jpg', 'png', 'gif', 'webp'))) {
            return;
        }

        try {
            $img = Image::load($imagePath);
            $originalImageHeight = $img->getHeight();
            $originalImageWidth = $img->getWidth();

            $img->optimize()->width(32)->format(Manipulations::FORMAT_PNG)->save($tempDestination);

            $tinyImageDataBase64 = base64_encode(file_get_contents($tempDestination));
            $tinyImageBase64 = 'data:image/jpeg;base64,' . $tinyImageDataBase64;

            $svg = view('placeholder::placeholder-svg', compact(
                'originalImageWidth',
                'originalImageHeight',
                'tinyImageBase64'
            ));

            $base64Svg = 'data:image/svg+xml;base64,' . base64_encode($svg);

            $event->asset->set('placeholder', $base64Svg);
            $event->asset->save();
        } finally {
            if (file_exists($tempDestination)) {
                unlink($tempDestination);
            }
        }
    }
}
