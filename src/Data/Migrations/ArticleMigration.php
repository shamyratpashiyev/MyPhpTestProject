<?php
namespace App\Data\Migrations;

use App\Data\Blueprint;
use App\Data\Schema;
use App\Models\Article;
use App\Models\Category;

class ArticleMigration extends BaseMigration {
    public function Up(): void {
        Schema::Create(Article::GetTableName(), function(Blueprint $blueprint) {
            $blueprint->Id();
            $blueprint->String("Title");
            $blueprint->String("ImagePath");
            $blueprint->Text("Description");
            $blueprint->Text("Text");
            $blueprint->Int("CategoryId");
            $blueprint->ForeignId("CategoryId", Category::GetTableName(), "Id");
            $blueprint->DateTime("PublicationDate");
            $blueprint->Int("ViewCount", defaultValue: 0);
        });
    }

    public function Down(): void {

    }
}