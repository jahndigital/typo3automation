<?php

namespace jahndigital\Typo3Automation\Classes\Commands;

class ControllerCommand
{
    public static function handle($args): void
    {
        $controllerName = $args[2] ?? null;
        if (!$controllerName) {
            echo "Controller name is required.\n";
            return;
        }

        $config = ConfigManager::getConfig();
        $namespace = "Vendor\Sitepackage"; // Default namespace
        if ($config) {
            $namespace = $config['vendor'] . '\\' . $config['package'];
        }

        $controllerDir = "Classes/Controller";
        if (!is_dir($controllerDir)) {
            mkdir($controllerDir, 0777, true);
        }

        $template = "<?php\n\n"
            . "declare(strict_types=1);\n\n"
            . "namespace $namespace\Controller;\n\n"
            . "use Psr\Http\Message\ResponseInterface;\n\n"
            . "class $controllerName extends AbstractController\n"
            . "{\n"
            . "    public function listAction(): ResponseInterface\n"
            . "    {\n"
            . "        return \$this->htmlResponse();\n"
            . "    }\n\n"
            . "    public function showAction(): ResponseInterface\n"
            . "    {\n"
            . "        return \$this->htmlResponse();\n"
            . "    }\n"
            . "}\n";

        file_put_contents("$controllerDir/$controllerName.php", $template);
        echo "$controllerName controller created in $controllerDir.\n";
    }
}
