<?php

namespace Tests\Unit;

use App\Models\Partner;
use App\Services\PartnerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartnerServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetSilverPartners()
    {
        
        Partner::factory()->create(['type' => 'silver']);
        Partner::factory()->create(['type' => 'gold']);
        $partnerService = new PartnerService();
        $silverPartners = $partnerService->getSilverPartners();

        $this->assertEquals(1, $silverPartners->count());
        $this->assertEquals('silver', $silverPartners->first()->type);
    }

}
