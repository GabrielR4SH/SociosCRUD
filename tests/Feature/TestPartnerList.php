<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Partner;

class TestPartnerList extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testPartnerList()
    {
        // Criar usuário silver
        $userSilver = User::factory()->create(['type' => 'silver']);

        // Criar usuários gold (que não devem receber parceiros silver)
        $userGold1 = User::factory()->create(['type' => 'gold']);
        $userGold2 = User::factory()->create(['type' => 'gold']);

        // Criar parceiros silver
        Partner::factory()->create(['type' => 'silver']);
        Partner::factory()->create(['type' => 'silver']);

        // Criar parceiros gold (que não devem ser vistos pelos usuários silver)
        Partner::factory()->create(['type' => 'gold']);
        Partner::factory()->create(['type' => 'gold']);

        // Obter o token CSRF da página de login
        $responseLogin = $this->get('/login');
        $csrfToken = $this->extractCsrfToken($responseLogin->getContent());

        // Realizar a requisição como usuário silver
        $responseSilver = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->actingAs($userSilver)->get('/home');
        $responseSilver->assertStatus(200);
        $responseSilver->assertSee('Silver Partner');
        $responseSilver->assertDontSee('Gold Partner');

        // Realizar a requisição como usuário gold
        $responseGold1 = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->actingAs($userGold1)->get('/home');
        $responseGold1->assertStatus(200);
        $responseGold1->assertSee('Gold Partner');
        $responseGold1->assertDontSee('Silver Partner');

        $responseGold2 = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->actingAs($userGold2)->get('/home');
        $responseGold2->assertStatus(200);
        $responseGold2->assertSee('Gold Partner');
        $responseGold2->assertDontSee('Silver Partner');
    }

}
