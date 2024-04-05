<?php 

namespace App\Services;

use App\Models\Partner;

class PartnerService
{
    public function getAllPartners()
    {
        return Partner::all();
    }

    public function getSilverPartners()
    {
        return Partner::where('type', 'silver')->get();
    }

    public function createPartner(array $data)
    {
        return Partner::create($data);
    }

    public function findPartnerById($id)
    {
        return Partner::findOrFail($id);
    }

    public function updatePartner($id, array $data)
    {
        $partner = Partner::findOrFail($id);
        $partner->update($data);
        return $partner;
    }

    public function deletePartner($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return $partner;
    }
}
