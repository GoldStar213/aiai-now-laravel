<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

use App\Models\Category;
use App\Models\Service;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        if (!empty($media->model_type)) {
            return strtolower(substr(strrchr($media->model_type, "\\"), 1)) . '/' . md5($media->id . config('app.key')) . '/';
        }

        return md5($media->id . config('app.key')) . '/';
    }

    public function getPathForConversions(Media $media) : string
    {
        // return $this->getPath($media) . 'conversions/';
        return md5($media->id . config('app.key')) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        // return $this->getPath($media) . 'responsive/';
        return md5($media->id . config('app.key')) . 'conversions/';
    }
}