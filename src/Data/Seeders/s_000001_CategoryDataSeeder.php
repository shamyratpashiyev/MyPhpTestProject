<?php
namespace App\Data\Seeders;

use App\Data\DbContext;
use App\Models\Category;

class s_000001_CategoryDataSeeder extends BaseDataSeeder {

    public function Seed(): void {
        $context = DbContext::Get();
        $tableName = Category::GetTableName();
        $categoriesArray = [
                                ['name' => 'Technology', 'description' => 'Latest trends in software, gadgets, and computing innovations.'],
                                ['name' => 'Health & Wellness', 'description' => 'Tips and expert advice on fitness, nutrition, and mental health.'],
                                ['name' => 'Finance', 'description' => 'Personal finance management, investing, and global economic updates.'],
                                ['name' => 'Travel', 'description' => 'Destination guides, travel tips, and cultural experiences worldwide.'],
                                ['name' => 'Education', 'description' => 'Resources, learning methodologies, and updates on academic systems.'],
                                ['name' => 'Science', 'description' => 'Explorations into physics, space, biology, and groundbreaking discoveries.'],
                                ['name' => 'Lifestyle', 'description' => 'Daily routines, home decor, personal development, and relationships.'],
                                ['name' => 'Business', 'description' => 'Entrepreneurship strategies, corporate management, and market insights.'],
                                ['name' => 'Entertainment', 'description' => 'Reviews and news about movies, television shows, music, and pop culture.'],
                                ['name' => 'Food & Drink', 'description' => 'Recipes, culinary techniques, restaurant reviews, and beverage guides.'],
                                ['name' => 'Sports', 'description' => 'Game analysis, athlete profiles, and news across major sports leagues.'],
                                ['name' => 'Environment', 'description' => 'Climate change, conservation efforts, sustainability, and green tech.'],
                                ['name' => 'Politics', 'description' => 'Local and international government updates, policy changes, and analysis.'],
                                ['name' => 'Arts & Culture', 'description' => 'Insights into literature, visual arts, theater, and historical movements.'],
                                ['name' => 'Real Estate', 'description' => 'Property investment, housing market trends, and architectural design.'],
                                ['name' => 'Parenting', 'description' => 'Child development guidance, family activities, and advice for parents.'],
                                ['name' => 'Automotive', 'description' => 'Car reviews, vehicle industry shifts, and maintenance tips.'],
                                ['name' => 'Fashion', 'description' => 'Style updates, designer showcases, and historical trends in clothing.'],
                                ['name' => 'Marketing', 'description' => 'Digital advertising strategies, branding concepts, and consumer behavior.'],
                                ['name' => 'Gaming', 'description' => 'Video game releases, esports news, industry developments, and reviews.']
                            ];

        foreach ($categoriesArray as $category) {
            $context->exec("INSERT INTO {$tableName}(Name, Description) VALUES('{$category['name']}', '{$category['description']}')");
        }
    }
}