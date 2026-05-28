<?php
namespace App\Controllers;

use Smarty\Smarty;

class BaseController {

    protected Smarty $smarty;

    public function __construct(Smarty $smarty, string $templateFolder)
    {
        $this->smarty = $smarty;

        $smarty->setTemplateDir(__DIR__ . '/../Templates/' . $templateFolder);
        $smarty->setConfigDir(__DIR__ . '/../Templates/config/' . $templateFolder);
        $smarty->setCompileDir(__DIR__ . '/../Templates/compile/' . $templateFolder);
        $smarty->setCacheDir(__DIR__ . '/../Templates/cache/' . $templateFolder);
    }
}