<?php

namespace Codememory\Components\Asset;

use Codememory\Components\Caching\Exceptions\ConfigPathNotExistException;
use Codememory\Components\Configuration\Config;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Configuration\Interfaces\ConfigInterface;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\IncorrectPathToEnviException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;
use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\FileSystem\File;
use Codememory\Support\Str;

/**
 * Class Utils
 *
 * @package Codememory\Components\Asset
 *
 * @author  Codememory
 */
class Utils
{

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * @throws ConfigPathNotExistException
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function __construct()
    {

        $config = new Config(new File());

        $this->config = $config->open(GlobalConfig::get('asset.configName'));

    }

    /**
     * @return string
     */
    public function getDist(): string
    {

        return trim($this->config->get('paths.dist'), '/') . '/';

    }

    /**
     * @return string
     */
    public function getAssets(): string
    {

        return trim($this->config->get('paths.assets'), '/') . '/';

    }

    /**
     * @return string
     */
    public function getActiveOutput(): string
    {

        $activeOutput = $this->config->get('activeOutput');
        $path = $this->config->get(sprintf('paths.%s', $activeOutput));

        return trim($path, '/') . '/';

    }

    /**
     * @return array
     */
    public function getAliases(): array
    {

        $aliases = $this->config->get('aliases') ?: [];
        $formattedAliases = [];

        foreach ($aliases as $alias) {
            [$path, $pathAlias] = explode('@', $alias);

            $formattedAliases[] = [
                'path'  => trim($path, '/'),
                'alias' => $pathAlias
            ];
        }

        foreach ($formattedAliases as &$formattedAlias) {
            $formattedAliasPath = &$formattedAlias['path'];

            preg_match_all('/{(?<names>[^}]+)}/', $formattedAliasPath, $match);

            if ([] !== $match['names']) {
                foreach ($match['names'] as $name) {
                    $aliasPath = $this->getPathFromAlias($formattedAliases, $name);

                    Str::replace($formattedAliasPath, sprintf('{%s}', $name), $aliasPath);
                }
            }
        }

        return $formattedAliases;

    }

    /**
     * @param string $alias
     *
     * @return string|null
     */
    public function getPathByAlias(string $alias): ?string
    {

        $aliasPath = $this->getPathFromAlias($this->getAliases(), $alias);

        if (null !== $aliasPath) {
            return $this->getActiveOutput() . $aliasPath;
        }

        return null;

    }

    /**
     * @param array  $dataAliases
     * @param string $alias
     *
     * @return string|null
     */
    private function getPathFromAlias(array $dataAliases, string $alias): ?string
    {

        foreach ([] !== $dataAliases ? $dataAliases : $this->getAliases() as $aliasData) {
            if ($aliasData['alias'] === $alias) {
                return $aliasData['path'];
            }
        }

        return null;

    }

}