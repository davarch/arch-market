<?php

namespace Support\Testing;

use Faker\Provider\Base;
use Storage;

class FakerImageProvider extends Base
{
    public function thumbnail(string $directory): string
    {
        $storage = Storage::disk('images');

        if (! $storage->exists($directory)) {
            $storage->makeDirectory($directory);
        }

        $fileName = $this->generator->file(
            base_path("tests/Fixtures/images/$directory"),
            $storage->path($directory),
            false
        );

        return "/storage/images/$directory/$fileName";
    }
}
