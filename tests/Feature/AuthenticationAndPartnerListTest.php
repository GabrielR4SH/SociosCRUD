<?php 

namespace Tests\Feature;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationAndPartnerListTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthentication()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }
}
