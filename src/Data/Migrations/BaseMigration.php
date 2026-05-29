<?php

namespace App\Data\Migrations;

abstract class BaseMigration {
    public abstract function Up(): void;
    public abstract function Down(): void;
}