<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $project = [
            'title' => $this->faker()->sentence(),
            'description' => $this->faker()->paragraph(),
        ];

        $this->post('/projects', $project)
            ->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $project);

        $this->get('/projects')
            ->assertSee($project['title']);
    }

    public function test_a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_a_project_requires_a_title()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()
            ->raw([
                'title' => ''
            ]);

        $this->post('/projects', $project)
            ->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->actingAs(User::factory()->create());

        $project = Project::factory()
            ->raw([
                'description' => ''
            ]);

        $this->post('/projects', $project)
            ->assertSessionHasErrors('description');
    }

    public function test_only_auth_users_can_create_a_project()
    {
        $project = Project::factory()
            ->raw();

        $this->post('/projects', $project)
            ->assertRedirect('login');
    }
}
