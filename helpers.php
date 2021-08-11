<?php

use Codememory\Components\Asset\AssetSingleton;

if (!function_exists('assetPath')) {
    /**
     * @param string $path
     *
     * @return string
     */
    function assetPath(string $path): string
    {

        return AssetSingleton::getInstance()->getPath($path);

    }
}

if (!function_exists('assetAliasPath')) {
    /**
     * @param string $aliasName
     * @param bool   $withVersion
     *
     * @return string
     */
    function assetAliasPath(string $aliasName, bool $withVersion = true): string
    {

        if ($withVersion) {
            return AssetSingleton::getInstance()->getPathByAliasWithVersion($aliasName);
        }

        return AssetSingleton::getInstance()->getPathByAlias($aliasName);

    }
}