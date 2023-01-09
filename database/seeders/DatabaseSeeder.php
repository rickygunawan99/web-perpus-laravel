<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        // \App\Models\User::factory(10)->create();
        $this->call(AuthorSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(MemberSeeder::class);
        foreach (Book::all() as $book) {
            for ($i=1 ; $i <= rand(1,5) ; $i++){
                $number = $faker->unique()->numberBetween(1, Author::count());
                $book->author()->syncWithoutDetaching(Author::find($number));
            }
            $faker->unique(true);
        }
    }
}
