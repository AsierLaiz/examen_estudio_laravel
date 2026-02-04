<?php

namespace Tests;


use Tests\TestCase;

class StaticPagesTest extends TestCase
{
    public function testHomePage()
    {
        $respose = $this->get(uri: route('home'));
        $respose->assertStatus(200);
        $respose->assertSee('Gure Ikastetxea');
        $respose->assertSee('Ongi etorri');
    }
    public function testHistoriaPage()
    {
        $respose = $this->get(route('historia'));
        $respose->assertStatus(200);
        $respose->assertSee('FP Santurtzi LH');
    }
    public function test_menu()
    {
        $pages = ['home', 'historia'];
        
        foreach($pages as $page) {
            $response = $this->get(route($page));
            $response->assertStatus(200);
            $response->assertSee('Hasiera');
            $response->assertSee('Historia');

        }
    }
}