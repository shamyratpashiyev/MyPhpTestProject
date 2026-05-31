<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Collection;
use Smarty\Smarty;

class MainController extends BaseController {

    public function __construct()
    {
        return parent::__construct(new Smarty(), "Main");
    }

    public function Index() {
        $articlesPerCategoryCount = 3;
        $categoriesWithArticles = Category::GetAllWithExistingArticle();
        $articlesPerCategory = Article::GetArticlesPerCategory($articlesPerCategoryCount);
        $categoriesWithArticles = $categoriesWithArticles->
                map(function($cat) use($articlesPerCategory){ 
                    $cat->Articles = new Collection($articlesPerCategory->where(fn($ar) => $ar->CategoryId == $cat->Id));
                    return $cat;
                });

        $this->smarty->assign("categoriesWithArticles", $categoriesWithArticles);
        $this->smarty->assign("Title", "Main Page");
        $this->smarty->display('Index.tpl');
    }
}