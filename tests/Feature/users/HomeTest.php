<?php

namespace Tests\Feature\users;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    public function setup():void
    {
        parent::setUp();
        Session::start();
        $this->user=factory(User::class)->create();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
#############################       home       ##########################################
    public function test_home()
    {
        $user=$this->user;
        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertSee('Dashboard');
        $response->assertStatus(200);
    }

#############################       get login        #####################################
    public function test_get_login()
    {
        $response = $this->get('/login');

        $response->assertsee('login');
    }

#############################       post login       #####################################
    public function test_post_login()
    {
        $data=[
            '_token'   => csrf_token(),
            'login'    => 'ziyad1995@yahoo.com',
            'password' => '12121212',
        ];
        
        $response = $this->post('/login',$data);

        $response->assertSessionMissing('errors');
        $response->assertRedirect('/');
    }

#############################       get sign up      #####################################
    public function test_get_signUp()
    {
        $response = $this->call('get', '/register');

        $response->assertSee('register');
    }

#############################       post sign up      #####################################
    public function test_post_signUp()
    {
        $data=[
            '_token'                 => csrf_token(),
            'email'                  => 'ziyad1212@yahoo.com',
            'password'               => '12121212',
            'password_confirmation'  => '12121212',
            'name'                   => 'ali'
        ];
        
        $response = $this->call('POST', '/register',$data);

        $this->assertDatabaseHas('users',['email'=>'ziyad1212@yahoo.com']);
        $response->assertRedirect('/');
    }
}
