<?php

namespace App\Controllers;

use Smarty\Smarty;

class MainController extends BaseController {

    public function __construct()
    {
        return parent::__construct(new Smarty(), "Main");
    }

    public function Index() {
        $menu = array(
            ['name' => "Italian pizza"],
            ['name' => "German sausage"],
            );
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("title", "Main Page");
        $this->smarty->display('index.tpl');
    }
}