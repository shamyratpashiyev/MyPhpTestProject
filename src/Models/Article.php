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
     * @return Collection<Article>
     */
    public static function GetByCategoryId(int $categoryId, string $sortBy = 'date'): Collection {
        $context = DbContext::Get();
        $tableName = Article::GetTableName();

        $orderColumn = match($sortBy) {
            'views' => 'ViewCount',
            default => 'PublicationDate',
        };

        $query = $context->prepare(
            "SELECT * FROM {$tableName}" 
            . " WHERE CategoryId = :categoryId" 
            . " ORDER BY {$orderColumn}"
        );
        $query->execute(['categoryId' => $categoryId]);
        return new Collection($query->fetchAll(PDO::FETCH_CLASS, Article::class));
    }

    /**
     * @return Article|null
     */
    public static function GetById(int $id): ?Article {
        $context = DbContext::Get();
        $tableName = Article::GetTableName();
        $query = $context->prepare("SELECT * FROM {$tableName} WHERE Id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetchObject(Article::class);
        return $result ?: null;
    }

    /**
     * Returns up to $limit articles with $categoryId, excluding the given article id.
     * @return Collection<Article>
     */
    public static function GetRelated(int $categoryId, int $excludeId, int $limit = 3): Collection {
        $context = DbContext::Get();
        $tableName = Article::GetTableName();
        $query = $context->prepare(
            "SELECT * FROM {$tableName}"
            . " WHERE CategoryId = :categoryId AND Id != :excludeId"
            . " ORDER BY PublicationDate"
            . " LIMIT :lim"
        );
        $query->bindValue('categoryId', $categoryId, PDO::PARAM_INT);
        $query->bindValue('excludeId', $excludeId, PDO::PARAM_INT);
        $query->bindValue('lim', $limit, PDO::PARAM_INT);
        $query->execute();
        return new Collection($query->fetchAll(PDO::FETCH_CLASS, Article::class));
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