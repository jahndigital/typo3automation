<?php

namespace jahndigital\Typo3Automation\Commands;

class ModelCommand
{
    public static function handle($args): void
    {
        $modelName = $args[2] ?? null;
        if (!$modelName) {
            echo "Model name is required.\n";
            return;
        }

        $config = ConfigManager::getConfig();
        $namespace = "Vendor\Sitepackage"; // Default namespace
        if ($config) {
            $namespace = $config['vendor'] . '\\' . $config['package'];
        }

        $modelDir = "Classes/Domain/Model";
        if (!is_dir($modelDir)) {
            mkdir($modelDir, 0777, true);
        }

        $template = "<?php\n\n"
            . "declare(strict_types=1);\n\n"
            . "namespace $namespace\Domain\Model;\n\n"
            . "use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;\n\n"
            . "class $modelName extends AbstractEntity\n"
            . "{\n\n"
            . "}\n";

        file_put_contents("$modelDir/$modelName.php", $template);
        echo "$modelName model created in $modelDir.\n";
    }
}
