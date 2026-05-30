<?php
namespace App\Console;

use App\Data\DbContext;
use App\Data\Migrations\BaseMigration;
use App\Data\Seeders\BaseDataSeeder;
use Illuminate\Support\Collection;
use Dotenv\Dotenv;
use Composer\Script\Event;
use ReflectionClass;

class Kernel {
    public static function Migrate(Event $_): void {

        // Initializing Dotenv targeting project root folder
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        // Creating the database and migrations table itself
        $context = DbContext::Get();
        $dbName = $_ENV["DB_NAME"];

        $context->exec("CREATE TABLE IF NOT EXISTS `__migrations` (
            `Id` INT AUTO_INCREMENT NOT NULL,
            PRIMARY KEY (`Id`),
            `Name` VARCHAR(250) NOT NULL,
            `Date` DATETIME NOT NULL
        )");

        // Running the existing migrations that are not in migrations table
        $classmap = require __DIR__ . '/../../vendor/composer/autoload_classmap.php';

        $migrationsArray = $context->query("SELECT Name FROM `__migrations`;")->fetchAll();
        $migrations = new Collection($migrationsArray);

        $classesCollection = new Collection(array_keys($classmap));

        foreach ($classesCollection->where(fn(string $x) => str_contains($x, "Migration"))->sort() as $className) {
            if (class_exists($className)) {
                $reflection = new ReflectionClass($className);

                if ($reflection->isSubclassOf(BaseMigration::class) && !$reflection->isAbstract()) {
                    if (!$migrations->contains(fn(array $x) => $x["Name"] == $reflection->getShortName())) {
                        $reflection->getMethod("Up")->invoke($reflection->newInstance());
                        $context->exec("INSERT INTO `__migrations` (Name, Date) VALUES('{$reflection->getShortName()}', NOW())");
                    }
                }
            }
        }
    }

    public static function Seed(Event $_): void {

        // Initializing Dotenv targeting project root folder
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        // Creating the database and migrations table itself
        $context = DbContext::Get();
        $appEnv = $_ENV["APP_ENV"];

        // Running the existing seeders
        $classmap = require __DIR__ . '/../../vendor/composer/autoload_classmap.php';

        $classesCollection = new Collection(array_keys($classmap));

        foreach ($classesCollection->where(fn(string $x) => str_contains($x, "DataSeeder"))->sort() as $className) {
            if (class_exists($className)) {
                $reflection = new ReflectionClass($className);

                if ($reflection->isSubclassOf(BaseDataSeeder::class) && !$reflection->isAbstract()) {
                    if ($appEnv == 'Development') {
                        $reflection->getMethod("Seed")->invoke($reflection->newInstance());
                    }
                }
            }
        }
    }
}

