<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Category;
use Smarty\Smarty;

class CategoryController extends BaseController {

    public function __construct()
    {
        return parent::__construct(new Smarty(), "Category");
    }

    public function Show() {
        $categoryId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $sortBy     = isset($_GET['sort']) && $_GET['sort'] == 'views' ? 'views' : 'date';

        $category = Category::GetById($categoryId);
        if (!$category) {
            http_response_code(404);
            echo "404 - Category Not Found";
            return;
        }

        $articles = Article::GetByCategoryId($categoryId, $sortBy);

        $this->smarty->assign("category", $category);
        $this->smarty->assign("articles", $articles);
        $this->smarty->assign("sortBy",   $sortBy);
        $this->smarty->assign("Title",    $category->Name);
        $this->smarty->display('Show.tpl');
    }
}