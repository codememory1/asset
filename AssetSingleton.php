<?php

namespace Codememory\Components\Asset;

use Codememory\Components\Asset\Interfaces\AssetInterface;

/**
 * Class AssetSingleton
 *
 * @package Codememory\Components\Asset
 *
 * @author  Codememory
 */
class AssetSingleton
{

    /**
     * @var AssetInterface|null
     */
    private static ?AssetInterface $asset = null;

    /**
     * AssetSingleton Construct
     */
    protected function __construct()
    {
    }

    /**
     * @return AssetInterface
     */
    public static function getInstance(): AssetInterface
    {

        if (self::$asset instanceof Asset) {
            return self::$asset;
        }

        return self::$asset = new Asset();

    }

    /**
     * AssetSingleton Clone
     */
    protected function __clone()
    {
    }

}