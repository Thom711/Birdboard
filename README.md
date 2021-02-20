Birdboard in Laravel 8

- My setup uses Laragon, not Laravel Valet

Lesson 01, Setup:
 - Install Laravel
 - Migrate databases
 - Install Laravel Breeze (this installs auth, ui, and tailwind)
 - npm install & npm run watch

Lesson 02 
    PhpUnit on windows: Always prepend a test with test_

    To run the tests:
    vendor\bin\phpunit tests\Feature\ProjectsTest.php

    This link guided me in getting sqlite :memory: working
https://candokendo.wordpress.com/2020/08/13/could-not-find-driver-sql-pragma-foreign_keys-on-laravel-7-test-configure-issue-fix/

Lesson 03
    Laravel 8 factory works quite different
        $project = Project::factory()->raw(['title' => '']);

Lesson 04
    Fresh made unit tests cannot handle tests because they run in the wrong namespace
    Comment out : use PHPUnit\Framework\TestCase;
    Instead use : use Tests\TestCase;

    Correct syntax for whipping up some factories in Tinker:
        App\Models\Project::factory()->count(5)->create();

Lesson 05
    Owner_Id on laravel 8 migrations:
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

    Setting the owner_id in the Project Factory:
            public function definition()
            {
                return [
                    'owner_id' => User::factory()->create()->id,
                    'title' => $this->faker->sentence(),
                    'description' => $this->faker->paragraph()
                ];
            }

Lesson 06
    Group middleware syntax on the routes file is also writeable as:
        Route::middleware(['auth'])->group(function () {
            Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
            Route::get('/projects/{project}', [ProjectsController::class, 'show']);
            Route::post('/projects', [ProjectsController::class, 'store']);
        });

Tussendoor:
    Blog ideetje over hoe laravel functies zoals tap! touch! of is! isNot! je een slechtere developer maken

Lesson 07
    -- No comments -- 

Lesson 08
    Mostly skippable, fixed by initializing with Breeze

Lesson 09
    -- No comments --
    



 

