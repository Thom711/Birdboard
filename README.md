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


    



 

