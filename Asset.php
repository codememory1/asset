<?php

namespace Codememory\Components\Asset;

use Codememory\Components\Asset\Interfaces\AssetInterface;
use Codememory\FileSystem\File;
use Codememory\FileSystem\Interfaces\FileInterface;

/**
 * Class Asset
 *
 * @package Codememory\Components\Asset
 *
 * @author  Codememory
 */
class Asset implements AssetInterface
{

    /**
     * @var Utils
     */
    private Utils $utils;

    /**
     * @var FileInterface
     */
    private FileInterface $filesystem;

    /**
     * Asset Construct
     */
    public function __construct()
    {

        $this->utils = new Utils();
        $this->filesystem = new File();

    }

    /**
     * @inheritDoc
     */
    public function getPathByAlias(string $aliasName): ?string
    {

        return $this->utils->getPathByAlias($aliasName);

    }

    /**
     * @inheritDoc
     */
    public function getPathByAliasWithVersion(string $aliasName): string
    {

        $path = $this->getPathByAlias($aliasName);
        $hash = md5(file_get_contents($this->filesystem->getRealPath($path)));

        return sprintf('%s?v=%s', $path, $hash);

    }

    /**
     * @inheritDoc
     */
    public function getPath(string $path): string
    {

        return $this->utils->getActiveOutput().$path;

    }

}