<?php

namespace App\Data;

abstract class BaseMigration {
    public abstract function Up(): void;
    public abstract function Down(): void;
}