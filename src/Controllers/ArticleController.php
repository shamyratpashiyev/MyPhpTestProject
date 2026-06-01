<?php

namespace App\Controllers;

use App\Models\Article;
use Smarty\Smarty;

class ArticleController extends BaseController {

    public function __construct()
    {
        return parent::__construct(new Smarty(), "Article");
    }

    public function Show() {
        $articleId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        $article = Article::GetById($articleId);
        if (!$article) {
            http_response_code(404);
            echo "404 - Article Not Found";
            return;
        }

        $relatedArticles = Article::GetRelated((int) $article->CategoryId, $article->Id, 3);

        $this->smarty->assign("article", $article);
        $this->smarty->assign("relatedArticles", $relatedArticles);
        $this->smarty->assign("Title", $article->Title);
        $this->smarty->display('Show.tpl');
    }
}

