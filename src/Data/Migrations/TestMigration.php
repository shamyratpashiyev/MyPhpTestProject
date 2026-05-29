<?php
namespace App\Data\Migrations;

use App\Data\Blueprint;
use App\Data\Schema;

class TestMigration extends BaseMigration {
    public function Up(): void {
        Schema::Create("Category", function(Blueprint $blueprint) {
            $blueprint->Id();
            $blueprint->String("Name");
        });
    }

    public function Down(): void {

    }
}