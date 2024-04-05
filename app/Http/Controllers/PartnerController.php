<?php

namespace App\Http\Controllers;

use App\Services\PartnerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    protected $partnerService;

    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userType = $user->type;

        if ($userType === 'silver') {
            $partners = $this->partnerService->getSilverPartners();
        } elseif ($userType === 'gold') {
            $partners = $this->partnerService->getAllPartners();
        }

        return view('home', compact('partners'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'cep' => 'required|string|max:255',
                'logradouro' => 'nullable|string|max:255',
                'complemento' => 'nullable|string|max:255',
                'bairro' => 'nullable|string|max:255',
                'localidade' => 'nullable|string|max:255',
                'uf' => 'nullable|string|max:255',
            ]);

            $type = $request->input('type', 'silver');
            $validatedData['type'] = $type;

            $this->partnerService->createPartner($validatedData);

            return redirect()->route('home')->with('status', 'Partner created successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $partner = $this->partnerService->findPartnerById($id);
        return response()->json($partner);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'localidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:255',
        ]);

        $this->partnerService->updatePartner($id, $validatedData);

        return redirect()->route('home')->with('status', 'Partner updated successfully!');
    }

    public function destroy($id)
    {
        $this->partnerService->deletePartner($id);

        return redirect()->route('home')->with('status', 'Partner deleted successfully!');
    }

}
