<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userType = $user->type;

        if ($userType === 'silver') {
            $partners = Partner::where('type', 'silver')->get();
        } elseif ($userType === 'gold') {
            $partners = Partner::all();
        }

        return view('home', compact('partners'));
    }

    public function create()
    {
        //
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

        $partner = new Partner();
        $partner->fill($validatedData);
        $partner->save();

        return redirect()->route('home')->with('status', 'Partner created successfully!');
    } catch (\Exception $e) {
        // Exibir mensagem de erro ou logar o erro para investigação
        dd($e->getMessage());
    }
}

    

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update($request->all());
        return redirect()->route('home')->with('status', 'Partner updated successfully!');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return redirect()->route('home')->with('status', 'Partner deleted successfully!');
    }
}
