<?php

namespace Tests\Feature\users;

use App\Models\Comments;
use App\User;
use Tests\TestCase;
use App\Models\Items;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;


class ItemsTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $data;

    public function setup():void
    {
        parent::setUp();
        Session::start();

        $this->user=factory(User::class)->create();

        $file=UploadedFile::fake()->image('avatar.jpg');
        $this->data=[
            '_token'      => csrf_token(),
            'name'        => 'apple',
            'price'       => '1212',
            'condition'   => 'new',
            'description' => 'bad',
            'category_id' => 1,
            'brand_id'    => 1,
            'users_id'    => 4,
            'photo'       => $file,
            'slug'        => 'apple',
            'date'        => now(),
            'id'          => 30
        ];
        
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
#########################################      get create     ###########################    
    public function test_get_create()
    {
        $user=$this->user;
        $this->actingAs($user);

        $response=$this->get('items/create');

        $response->assertSee('condition');
        $response->assertStatus(200);
    }

#########################################      post create     ###########################
    public function test_post_create()
    {
        $user=$this->user;
        $this->actingAs($user);

        $data=$this->data;

        $response=$this->post('items/post',$data);

        $this->assertDatabaseHas('items',['name'=>'apple']);
        $response->assertSessionHas('success','you created item successfully');
    }

#########################################      get     ####################################
    public function test_get()
    {
        for ($i=0; $i < 3 ; $i++) { 
            factory(Items::class)->create([
                'name'=>'iphone '.$i,
                'slug'=>'iphone '.$i
            ]);
        }

        $data=[
            '_token' => csrf_token(),
            'search' => 'iphone',
            'brands' => [1],
            'agax'   => 1
        ];

        $response=$this->post('items/get?page=2',$data);
        
        $response->assertJson(['html'=>true]);
        $response->assertSee('iphone 11');
    }

#########################################      get details     ###########################
    public function test_get_details()
    {
        $user=$this->user;
        $this->actingAs($user);

        for ($i=0; $i < 3 ; $i++) { 
            factory(Comments::class)->create([
                'comment'=>'good '.$i,
            ]);
        }

        $response=$this->call('GET','items/details/iphone-12-1?page=2',['agax'=>1]);
        
        $response->assertJson(['html'=>true]);
        $response->assertSee('bad');
    }

#########################################      get checkout     #########################
    public function test_checkout()
    {
        $user=$this->user;
        $this->actingAs($user);

        $data=$this->data;

        $response=$this->call('GET','items/get/checkout',$data);
        
        $response->assertJson(['form'=>true]);
    }

#########################################      delete     ###############################
    public function test_delete()
    {
        $user=$this->user;
        $this->actingAs($user);

        $data=[
            '_token' => csrf_token(),
            'id'     => 30,
        ];

        $response=$this->call('delete','items/delete',$data);

        $this->assertDatabaseMissing('items',['id'=>30]);
        $response->assertJson(['success'=>true]);
    }


#########################################      edit     ###############################
    public function test_edit()
    {
        $user=$this->user;
        $this->actingAs($user);

        $response=$this->call('get','items/edit',['id'=>30]);

        $response->assertJson(['item'=>true]);
    }

#########################################      update     ###############################
    public function test_update()
    {
        $user=$this->user;
        $this->actingAs($user);

        $data=$this->data;
        
        $response=$this->call('post','items/update',$data);

        $this->assertDatabaseHas('items',['name'=>'apple']);
        $response->assertJson(['item'=>true]);
    }

#########################################      show results     ###############################
    public function test_show_results()
    {
        $data=[
            'search'=>'iphone 12',
            '_token'=>csrf_token()
        ];

        $response=$this->call('post','items/show/results',$data);

        $response->assertJson(['search'=>true]);
    }

    #########################################      rate     ###############################
    public function test_rate()
    {
        $user=$this->user;
        $this->actingAs($user);

        $data=[
            'order_id' => 12,
            'item_id'  => 30,
            'rate'     => 4.5,
            '_token'   => csrf_token()
        ];

        $response=$this->call('post','items/rate',$data);
        
        $this->assertDatabaseHas('review',['rate'=>4.5]);
        $response->assertSessionHas('success','thank you for review');
        $response->assertRedirect('orders/show');
    }
    
}
