<?php
namespace App\Models;

abstract class BaseModel {
    abstract static function GetTableName(): string;
}