<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Set up test database
        $this->artisan('migrate');
    }

    /**
     * Create a user for testing
     */
    protected function createUser(array $attributes = [])
    {
        return \App\Models\User::factory()->create($attributes);
    }

    /**
     * Create a project for testing
     */
    protected function createProject(array $attributes = [])
    {
        return \App\Models\Project::factory()->create($attributes);
    }

    /**
     * Act as authenticated user
     */
    protected function actingAsUser($user = null)
    {
        $user = $user ?: $this->createUser();
        return $this->actingAs($user);
    }
}
