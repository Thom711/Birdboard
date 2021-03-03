<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TaskTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_it_belongs_to_a_project()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }
    public function test_it_has_a_path()
    {
        $task = Task::factory()->create();

        $this->assertEquals($task->path(), '/projects/' . $task->project->id . '/tasks/' . $task->id);
    }
}
