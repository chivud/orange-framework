<?php

namespace Core\Services;

use Core\Exceptions\InvalidConfigException;

class Config
{
    const CONFIG_ROOT_PATH = '../../config/';

    public static function get($config)
    {
        $parts = explode('.', $config);

        $configArray = [];
        $configPath = __DIR__ . '/' . self::CONFIG_ROOT_PATH . $parts[0] . '.php';

        if (file_exists($configPath)) {
            $configArray = require $configPath;
        }

        if (count($parts) > 1 && isset($configArray[$parts[1]])) {
            return $configArray[$parts[1]];
        } elseif (count($parts) == 1 && !empty($configArray)) {
            return $configArray;
        } else {
            throw new InvalidConfigException('"' . $config . '" config is invalid');
        }

    }
}
