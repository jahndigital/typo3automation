<?php

namespace jahndigital\Typo3Automation\Commands;

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

        $repositoryDir = $config['mainDirectory'] . "/Classes/Domain/Repository";
        if (!is_dir($repositoryDir)) {
            mkdir($repositoryDir, 0777, true);
        }

        $template = "<?php\n\n"
            . "declare(strict_types=1);\n\n"
            . "namespace $namespace\Domain\Repository;\n\n"
            . "use TYPO3\CMS\Core\Utility\GeneralUtility;\n\n"
            . "use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;\n\n"
            . "use TYPO3\CMS\Extbase\Persistence\Repository;\n\n"
            . "class $repositoryName extends Repository\n"
            . "{\n"
            . "     public function initializeObject(): void\n"
            . "    {\n"
            . "         \$this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);\n"
            . "         \$this->defaultQuerySettings->setRespectStoragePage(false);\n"
            . "    }\n"
            . "}\n";

        file_put_contents("$repositoryDir/$repositoryName.php", $template);
        echo "$repositoryName repository created in $repositoryDir.\n";
    }
}
