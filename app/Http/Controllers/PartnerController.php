<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            // Usuário não autenticado, redirecione para a página de login ou faça o que for adequado
            return redirect()->route('login');
        }

        $userType = $user->type;

        if ($userType === 'silver') {
            $partners = Partner::where('type', 'silver')->get();
        } elseif ($userType === 'gold') {
            $partners = Partner::all();
        }

        if ($request->wantsJson()) {
            return response()->json(['partners' => $partners]);
        }

        return view('home', compact('partners'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'type' => 'required|in:silver,gold',
            'cep' => 'required|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'localidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:255',
        ]);

        // Criação do novo registro de Partner
        $partner = new Partner();
        $partner->nome = $validatedData['nome'];
        $partner->type = $validatedData['type'];
        $partner->cep = $validatedData['cep'];
        $partner->logradouro = $validatedData['logradouro'];
        $partner->complemento = $validatedData['complemento'];
        $partner->bairro = $validatedData['bairro'];
        $partner->localidade = $validatedData['localidade'];
        $partner->uf = $validatedData['uf'];
        $partner->save();

        // Redirecionamento ou resposta adequada após a criação
        return redirect()->route('home')->with('status', 'Partner created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
