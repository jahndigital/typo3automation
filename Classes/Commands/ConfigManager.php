<?php

namespace jahndigital\Typo3Automation\Commands;

class ConfigManager
{
    private static $configFile = 'typo3cli-config.json';

    public static function getConfig()
    {
        if (file_exists(self::$configFile)) {
            return json_decode(file_get_contents(self::$configFile), true);
        }

        // Ask for vendor, package name, and main directory
        echo "Enter Vendor Name: ";
        $vendor = trim(fgets(STDIN));

        echo "Enter Package Name: ";
        $package = trim(fgets(STDIN));

        // List directories in extensions folder
        $extensionsDir = 'extensions';
        $extensions = self::listDirectories($extensionsDir);

        if (empty($extensions)) {
            echo "No extensions found in the 'extensions' directory.\n";
            $mainDirectory = self::promptMainDirectory();
        } else {
            echo "Select an extension or enter the path manually:\n";
            foreach ($extensions as $key => $extension) {
                echo "$key. $extension\n";
            }

            // Prompt the user to select an option
            $selectedOption = trim(fgets(STDIN));

            if (isset($extensions[$selectedOption])) {
                $mainDirectory = "$extensionsDir/{$extensions[$selectedOption]}";
            } else {
                $mainDirectory = self::promptMainDirectory();
            }
        }

        $config = ['vendor' => $vendor, 'package' => $package, 'mainDirectory' => $mainDirectory];
        file_put_contents(self::$configFile, json_encode($config));

        return $config;
    }

    private static function listDirectories($dir)
    {
        $directories = [];

        if (is_dir($dir)) {
            $contents = scandir($dir);
            foreach ($contents as $content) {
                if (is_dir("$dir/$content") && !in_array($content, ['.', '..'])) {
                    $directories[] = $content;
                }
            }
        }

        return $directories;
    }

    private static function promptMainDirectory()
    {
        echo "Enter Main Directory (e.g., packages/ief-sitepackage): ";
        return trim(fgets(STDIN));
    }
}
