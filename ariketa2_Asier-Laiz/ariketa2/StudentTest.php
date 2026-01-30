<?php

namespace Tests\Feature;

use Tests\TestCase;

class StudentTest extends TestCase
{

    public function test_students_index_loads()
    {
        $response = $this->get('/ikasleak');

        $response->assertStatus(200);
        $response->assertSee('Ikasleen zerrenda'); 
        $response->assertSee('Ane'); 
        $response->assertSee('Jon'); 
    }


    public function test_student_show_loads()
    {
        $response = $this->get('/ikasleak/1');

        $response->assertStatus(200);
        $response->assertSee('Ikaslearen datuak');
        $response->assertSee('Ane');
        $response->assertSee('20');
    }


    public function test_students_index_filters_by_adinmax()
    {
        $response = $this->get('/ikasleak?adinMax=20');

        $response->assertStatus(200);

        $response->assertSee('Ane');
        $response->assertSee('Maite');
        $response->assertSee('Iker');

        $response->assertDontSee('Unai'); 
        $response->assertDontSee('Gorka'); 
        $response->assertDontSee('Leire'); 
        $response->assertDontSee('Amaia'); 
        $response->assertDontSee('Eneko'); 
        $response->assertDontSee('Jon');  

    }


    public function test_student_show_not_found()
    {
        $response = $this->get('/ikasleak/999'); 
        $response->assertStatus(404);
    }
}
