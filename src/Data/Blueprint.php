<?php
namespace App\Data;

use Exception;

class Blueprint {
    private array $columns = [];

    private ?BlueprintType $type;

    private ?string $tableName;

    public function __construct(BlueprintType $type, string $tableName) {
        $this->type = $type;
        $this->tableName = $tableName;
    }

    public function GetBlueprintQuery(): string {
        $query = "";
        switch ($this->type) {
            case BlueprintType::CREATE:
                $query = "CREATE TABLE `{$this->tableName}` (" . join(', ', $this->columns) . ')';
                break;
            default:
                throw new Exception("Unknown Blueprint type");
        }
        return $query;
    }

    public function Id() {
        array_push($this->columns, "`Id` INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (`Id`)");
    }

    public function Int(string $columnName, bool $notNull = true, ?int $defaultValue = null) {
        array_push($this->columns, "`{$columnName}` INT" 
        . ($notNull ? " NOT NULL" : '' )
        . (!is_null($defaultValue) ? " DEFAULT {$defaultValue}" : ''));
    }

    public function String(string $columnName) {
        array_push($this->columns, "`{$columnName}` VARCHAR(255)");
    }

    public function Text(string $columnName) {
        array_push($this->columns, "`{$columnName}` TEXT");
    }

    public function ForeignId(string $keyColumn, string $referencedTable, string $referencedColumn) {
        array_push($this->columns, "FOREIGN KEY ({$keyColumn}) REFERENCES {$referencedTable}({$referencedColumn})");
    }

    public function DateTime(string $columnName) {
        array_push($this->columns, "`{$columnName}` DATETIME");
    }
}


enum BlueprintType {
    case CREATE;
}