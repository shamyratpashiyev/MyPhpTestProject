<?php
namespace App\Data\Migrations;

use App\Data\Blueprint;
use App\Data\Schema;
use App\Models\Category;

class m_000001_CategoryMigration extends BaseMigration {
    public function Up(): void {
        Schema::Create(Category::GetTableName(), function(Blueprint $blueprint) {
            $blueprint->Id();
            $blueprint->String("Name");
            $blueprint->Text("Description");
        });
    }

    public function Down(): void {

    }
}