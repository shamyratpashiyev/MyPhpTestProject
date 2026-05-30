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
    public DateTime $PublicationDate;
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
}