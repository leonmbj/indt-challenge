<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * List Authors Test.
     *
     * @return void
     */
    public function testListAuthors()
    {
        $response = $this->get('listauthors');

        $response->assertStatus(200);
    }


    /**
     * List Books Test.
     *
     * @return void
     */
    public function testListBooks()
    {
        $response = $this->get('listbooks');

        $response->assertStatus(200);
    }
}
