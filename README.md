# Statamic-Image-Placeholder

This statamic 3 add-on generates tiny svg placeholders for images when they are uploaded.
These placeholders can be retrieved from the api when using statamic as a headless cms.

Use this together with [vue-statamic-image](https://www.npmjs.com/package/vue-statamic-image) or [nuxt-statamic-image](https://www.npmjs.com/package/nuxt-statamic-image) to display responsive images with a fast, tiny and blurred placeholder.

## Installation

```shell
composer require teamnovu/statamic-image-placeholder
```

## Setup

For this add-on to work correctly you need to set the following settings in your statamic config

- config/assets.php -> 'secure' => false
- config/assets.php -> 'cache_meta' => true

## How it works

This add-on generates small svg versions of an image as soon as it is uploaded.
It then saves a placeholder property with the svg contents encoded as a base64 string in the asset's metadata.
