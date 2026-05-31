<?php
namespace App\Models;

use App\Data\DbContext;
use App\Models\BaseModel;
use Illuminate\Support\Collection;
use PDO;

class Category extends BaseModel {
    public int $Id;
    public string $Name;
    public string $Description;
    public ?Collection $Articles;

    public static function GetTableName(): string {
        return "Categories";
    }

    /**
     * * @return Collection<Category>
     */
    public static function GetAll(): Collection {
        $context = DbContext::Get();
        $migrations = $context->query("SELECT * FROM " . Category::GetTableName())->fetchAll(PDO::FETCH_CLASS, Category::class);
        return new Collection($migrations);
    }

    /**
     * * @return Collection<Category>
     */
    public static function GetAllWithExistingArticle(): Collection {
        $context = DbContext::Get();
        $categoryTableName = Category::GetTableName();
        $articleTableName = Article::GetTableName();
        $migrations = $context->query(
            "SELECT c.* FROM {$categoryTableName} c "
            . " INNER JOIN {$articleTableName} a ON c.Id = a.CategoryId"
            . " GROUP BY c.Id")
            ->fetchAll(PDO::FETCH_CLASS, Category::class);
        return new Collection($migrations);
    }
}