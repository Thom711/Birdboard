<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectsFactory;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker()->sentence(),
            'description' => $this->faker()->sentence(),
            'notes' => 'General notes here.',
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    public function test_a_user_can_update_a_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectsFactory::ownedBy($this->signIn())
            ->create();
            
        $this->patch($project->path(), $attributes = ['notes' => 'Changed']);

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectsFactory::ownedBy($this->signIn())
            ->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_auth_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_an_auth_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->patch($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        $this->signIn();

        $project = Project::factory()
            ->raw([
                'title' => ''
            ]);

        $this->post('/projects', $project)
            ->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signIn();

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
