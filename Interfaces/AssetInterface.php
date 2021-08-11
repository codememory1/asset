<?php

namespace Codememory\Components\Asset\Interfaces;

/**
 * Interface AssetInterface
 *
 * @package Codememory\Components\Asset\Interfaces
 *
 * @author  Codememory
 */
interface AssetInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the path by alias name, if no alias exists, it will return null
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $aliasName
     *
     * @return string|null
     */
    public function getPathByAlias(string $aliasName): ?string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the path by alias name. if no alias exists, it will return null.
     * Also adds a GET parameter v with the hash value of the content of
     * the given file
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $aliasName
     *
     * @return string
     */
    public function getPathByAliasWithVersion(string $aliasName): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the path as a prefix to add activeOutput from the config
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $path
     *
     * @return string
     */
    public function getPath(string $path): string;

}