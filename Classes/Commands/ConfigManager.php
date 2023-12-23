<?php

namespace jahndigital\Typo3Automation\Classes\Commands;

class ConfigManager
{
    private static $configFile = 'typo3cli-config.json';

    public static function getConfig()
    {
        if (file_exists(self::$configFile)) {
            return json_decode(file_get_contents(self::$configFile), true);
        }

        // Ask for vendor and package name
        echo "Enter Vendor Name: ";
        $vendor = trim(fgets(STDIN));

        echo "Enter Package Name: ";
        $package = trim(fgets(STDIN));

        $config = ['vendor' => $vendor, 'package' => $package];
        file_put_contents(self::$configFile, json_encode($config));

        return $config;
    }
}
