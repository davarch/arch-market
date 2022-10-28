<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;
use Storage;

class FakerImageProvider extends Base
{
    public function thumbnail(string $directory): string
    {
        $directoryPath = "/images/$directory";
        if (! Storage::disk('public')->directoryExists($directoryPath)) {
            Storage::disk('public')->makeDirectory($directoryPath);
        }

        $fileName = $this->generator->file(
            base_path("tests/Fixtures$directoryPath"),
            storage_path("app/public$directoryPath"),
            false
        );

        return "storage$directoryPath/$fileName";
    }
}
