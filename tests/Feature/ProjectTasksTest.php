<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Task;
use Facades\Tests\Setup\ProjectsFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_guests_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('/login');
    }

    public function test_only_the_project_owner_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function test_a_project_can_have_tasks()
    {
        $project = ProjectsFactory::ownedBy($this->signIn())
            ->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())->assertSee('Test Task');
    }

    public function test_a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $project = ProjectsFactory::ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'changed', 'completed' => true]);

        $this->assertDatabaseHas('tasks', ['body' => 'changed', 'completed' => true]);
    }

    public function test_only_the_project_owner_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectsFactory::withTasks(1)
            ->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'changed', 'completed' => true])
            ->assertStatus(403);

            $this->assertDatabaseMissing('tasks', ['body' => 'changed', 'completed' => true]);
    }

    public function test_a_task_requires_a_body()
    {
        $project = ProjectsFactory::ownedBy($this->signIn())
            ->create();

        $task = Task::factory()
        ->raw([
            'body' => ''
        ]);

        $this->post($project->path() . '/tasks', $task)->assertSessionHasErrors('body');    
    }
}
