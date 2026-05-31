<?php
namespace App\Models;

use App\Data\DbContext;
use App\Models\BaseModel;
use DateTime;
use Illuminate\Support\Collection;
use PDO;

class Article extends BaseModel {
    public int $Id;
    public string $Title;
    public string $ImagePath;
    public string $Description;
    public string $Text;
    public string $CategoryId;
    public string $PublicationDate;
    public int $ViewCount;

    public static function GetTableName(): string {
        return "Articles";
    }

    /**
     * * @return Collection<Article>
     */
    public static function GetAll(): Collection {
        $context = DbContext::Get();
        $result = $context->query("SELECT * FROM " . Article::GetTableName())->fetchAll(PDO::FETCH_CLASS, Article::class);
        return new Collection($result);
    }

    /**
     * * @return Collection<Article>
     */
    public static function GetArticlesPerCategory(int $articlesPerCategoryCount): Collection {
        $context = DbContext::Get();
        $articleTableName = Article::GetTableName();
        $result = $context->query("WITH RankedArticles AS (
                                        SELECT *,
                                            ROW_NUMBER() OVER (
                                                PARTITION BY CategoryId 
                                                ORDER BY Id ASC
                                            ) AS row_num
                                        FROM {$articleTableName}
                                    )
                                    SELECT * FROM RankedArticles
                                    WHERE row_num <= {$articlesPerCategoryCount}")
                ->fetchAll(PDO::FETCH_CLASS, Article::class);
        return new Collection($result);
    }
}