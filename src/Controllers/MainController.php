<?php

namespace App\Controllers;

use App\Models\Category;
use Smarty\Smarty;

class MainController extends BaseController {

    public function __construct()
    {
        return parent::__construct(new Smarty(), "Main");
    }

    public function Index() {
        $categories = Category::GetAll();
        $this->smarty->assign("categories", $categories);
        $this->smarty->assign("title", "Main Page");
        $this->smarty->display('index.tpl');
    }
}