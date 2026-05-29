<?php
namespace App\Data;

use Exception;

class Blueprint {
    private string $blueprintQuery;

    public function __construct(BlueprintType $type, string $tableName) {
        $this->InitializeQuery($type, $tableName);
    }

    private function InitializeQuery(BlueprintType $type, string $tableName): void {
        switch ($tableName) {
            case BlueprintType::CREATE:
                $this->blueprintQuery = "CREATE TABLE `{$tableName}` ()";
                break;
            default:
                throw new Exception("Unknown Blueprint type");
        }
    }

    private function OpenBrackets() {
        $this->blueprintQuery = str_replace(")", "", $this->blueprintQuery); 
    }

    private function CloseBrackets() {
        $this->blueprintQuery . ")";
    }

    public function GetBlueprintQuery(): string {
        return $this->blueprintQuery;
    }

    public function Id() {
        $this->OpenBrackets();
        $this->blueprintQuery . " `Id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY (`Id`) ";
        $this->CloseBrackets();
    }

    public function AutoIncrement(string $columnName) {
        $this->OpenBrackets();
        $this->blueprintQuery . " `{$columnName}` INT AUTO_INCREMENT NOT NULL ";
        $this->CloseBrackets();
    }

    public function String(string $columnName) {
        $this->OpenBrackets();
        $this->blueprintQuery . " `{$columnName}` VARCHAR(255) ";
        $this->CloseBrackets();
    }

    public function Text(string $columnName) {
        $this->OpenBrackets();
        $this->blueprintQuery . " `{$columnName}` TEXT ";
        $this->CloseBrackets();
    }

    public function ForeignId(string $keyColumn, string $referencedTable, string $referencedColumn) {
        $this->OpenBrackets();
        $this->blueprintQuery . " FOREIGN KEY ({$keyColumn}) REFERENCES {$referencedTable}({$referencedColumn}) ";
        $this->CloseBrackets();
    }
}


enum BlueprintType {
    case CREATE;
}