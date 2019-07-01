<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PlayersTest extends TestCase
{
    public function testIndex()
    {
        $this->get('api/v1/players')
        ->seeStatusCode(200)
        ->seeJsonStructure([
            '*' => [
                'id',
                'name',
                'age',
                'nationality',
                'club',
                'gender',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function testShowSuccess()
    {
        $this->get('api/v1/players/1')
        ->seeStatusCode(200)
        ->seeJsonStructure([
                'id',
                'name',
                'age',
                'nationality',
                'club',
                'gender',
                'created_at',
                'updated_at',
        ])
        ->seeJsonContains([
            'name' => 'Anthony Martial'
        ]);
    }

    public function testShowNoDataFound()
    {
        $this->get('api/v1/players/1000000');

        $this->assertEquals(
            'No data found.', $this->response->getContent()
        );
    }

    public function testStoreSuccess()
    {
        $data = [
            "name" => "Eden Hazard",
            "age" => 27,
            "nationality" => "Belgian",
            "club" => "Chelsea",
            "gender" => "male" 
        ];

        $this->post('api/v1/players', $data)
        ->seeStatusCode(200)
        ->seeJsonStructure([
                'id',
                'name',
                'age',
                'nationality',
                'club',
                'gender',
                'created_at',
                'updated_at',
        ])
        ->seeJsonContains([
            'name' => 'Eden Hazard'
        ]);
    }

    public function testUpdateSuccess()
    {
        $data = [
            "name" => "Test",
            "age" => 27,
            "nationality" => "Belgian",
            "club" => "Chelsea",
            "gender" => "male" 
        ];

        $this->patch('api/v1/players/2', $data)
        ->seeStatusCode(200)
        ->seeJsonStructure([
                'id',
                'name',
                'age',
                'nationality',
                'club',
                'gender',
                'created_at',
                'updated_at',
        ])
        ->seeJsonContains([
            'name' => 'Test'
        ]);
    }

    public function testUpdateNoDataFound()
    {
        $data = [
            "name" => "Test",
            "age" => 27,
            "nationality" => "Belgian",
            "club" => "Chelsea",
            "gender" => "male" 
        ];

        $this->patch('api/v1/players/100000', $data);

        $this->assertEquals(
            'No data found.', $this->response->getContent()
        );
    }

    public function testDestroySuccess()
    {
        $this->delete('api/v1/players/2')
        ->seeStatusCode(200);
    }

    public function testDeleteNoDataFound()
    {
        $this->delete('api/v1/players/100000');

        $this->assertEquals(
            'No data found.', $this->response->getContent()
        );
    }
}
