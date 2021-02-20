<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

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

    public function test_a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        $this->be(User::factory()->create());

        $project = Project::factory()->create(
            ['owner_id' => auth()->id()]
        );

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_auth_user_cannot_view_the_projects_of_others()
    {
        //$this->withoutExceptionHandling();

        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
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

    public function test_guests_may_not_manage_projects()
    {
        $project = Project::factory()->create();
 
        $this->post('/projects', $project->toArray())
            ->assertRedirect('login');
            
        $this->get('/projects')
            ->assertRedirect('login');

        $this->get($project->path())
            ->assertRedirect('login');

        $this->get('/projects/create')
            ->assertRedirect('login');
    }
}
