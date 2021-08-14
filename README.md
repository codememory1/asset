# Asset

## Установка

```
composer require codememory/asset
```

> После установки, обязательно выполнить команды
* Создать глобальную конфигурацию, если ее не существует
    * `php vendor/bin/gc-cdm g-config:init`
* Merge всей конфигурации
    * `php vendor/bin/gc-cdm g-config:merge --all`

## Обзор конфигурации
```yaml
asset:
  # Resource paths
  paths:
    dist: public/Dist
    assets: public/Assets

  # Active path that will be substituted as a prefix
  activeOutput: assets

  # File aliases
  aliases:
    - "images/cdm.png@cdm-log"
    - "images/icons@icons"
    - "{icons}/github.png@i-github"
```

## Пояснение алиасов

> Имя алиаса указывается после знака **@**  
> Чтобы наследовать путь конекретного алиаса в другом алиасе. Достаточно воспользоваться конструкцией **{alias-name}**

## Примеры алиасов
```yaml
aliases:
  - "images/cdm.png@cdm-logo"     # -> public/Assets/images/cdm.png
  - "images/icons@icons"          # -> public/Assets/images/icons
  - "{icons}/github.png@i-github" # -> public/Assets/images/icons/github.png
```

## Как получить путь алиаса?
```php
<?php

use Codememory\Components\Asset\Asset;

require_once 'vendor/autoload.php';

$asset = new Asset();

echo $asset->getPathByAlias('i-github'); // public/Assets/images/icons/github.png
```

## Получить путь алиаса и добавить к нему hash контента
```php
echo $asset->getPathByAliasWithVersion('i-github'); // public/Assets/images/icons/github.png?v=d41d8cd98f00b204e9800998ecf8427e
```

## Собрать свой путь, в качестве префикса поставить активный output
```php
echo $asset->getPath('img/logo.png') // public/Assets/img/logo.png
```