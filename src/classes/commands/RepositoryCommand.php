<?php

namespace jahndigital\Classes\Commands;

class RepositoryCommand
{
    public static function handle($args): void
    {
        $repositoryName = $args[2] ?? null;
        if (!$repositoryName) {
            echo "Repository name is required.\n";
            return;
        }

        $config = ConfigManager::getConfig();
        $namespace = "Vendor\Sitepackage"; // Default namespace
        if ($config) {
            $namespace = $config['vendor'] . '\\' . $config['package'];
        }

        $repositoryDir = "Classes/Domain/Repository";
        if (!is_dir($repositoryDir)) {
            mkdir($repositoryDir, 0777, true);
        }

        $template = "<?php\n\n"
            . "declare(strict_types=1);\n\n"
            . "namespace $namespace\Domain\Repository;\n\n"
            . "class $repositoryName extends AbstractRepository {}\n";

        file_put_contents("$repositoryDir/$repositoryName.php", $template);
        echo "$repositoryName repository created in $repositoryDir.\n";
    }
}
