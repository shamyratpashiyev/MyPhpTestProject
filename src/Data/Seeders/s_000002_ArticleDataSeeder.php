<?php
namespace App\Data\Seeders;

use App\Data\DbContext;
use App\Models\Article;
use App\Models\Category;
use Faker\Factory;

class s_000002_ArticleDataSeeder extends BaseDataSeeder {

    public function Seed(): void {
        $context = DbContext::Get();
        $tableName = Article::GetTableName();
        $rowCount = 100;
        $categories = Category::GetAll();
        $faker = Factory::create();

        for($i = 0; $i < $rowCount; $i++) {
            $randomArticleImageInt = random_int(0, $rowCount);

            $title = $faker->sentence();
            $imagePath = "https://picsum.photos/seed/{$randomArticleImageInt}/300/200";
            $description = $faker->sentences(3, true);
            $text = $faker->realText();
            $categoryId = $categories[random_int(0, $categories->count() - 1)]->Id;
            $publicationDate = $faker->dateTimeThisMonth('now')->format('Y-m-d H:i:s');

            $query = $context->prepare("INSERT INTO {$tableName}(Title, ImagePath, Description, Text, CategoryId, PublicationDate)
                                        VALUES(:title,:imagePath,:description,:text,:categoryId,:publicationDate)");
            $query->execute([
                'title' => $title, 
                'imagePath' => $imagePath, 
                'description' => $description, 
                'text' => $text, 
                'categoryId' => $categoryId, 
                'publicationDate' => $publicationDate, 
            ]);
        }
    }
}