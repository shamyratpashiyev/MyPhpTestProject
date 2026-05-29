<?php
namespace App\Data;

class Schema {
    public static function Create(string $tableName, callable $blueprintCreator) {
        // Creating a new blueprint obj
        $blueprint = new Blueprint(BlueprintType::CREATE, $tableName);
        // Applying table structure parameters
        ($blueprintCreator)($blueprint);
        DbContext::ExecuteRawSql($blueprint->GetBlueprintQuery());
    }
}