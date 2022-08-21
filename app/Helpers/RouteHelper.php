<?php

namespace App\Helpers;

class RouteHelper
{
    public static function includeRouteFiles(string $folder): void
    {
        // Iterate thru the v1 folder recursively
        $dirIterator = new \RecursiveDirectoryIterator($folder);

        /** @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator $it */
        $it = new \RecursiveIteratorIterator($dirIterator);

        // Require the file in each iteration
        while ($it->valid()) {
            if (
                ! $it->isDot()
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php'
            ) {
                require $it->current()->getPathname();
            }
            $it->next();
        }
    }
}
