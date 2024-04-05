<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        DB::table('partners')->insert([
            [
                'nome' => 'Fulano',
                'type' => 'gold',
                'cep' => '12345-678',
                'logradouro' => 'Rua Exemplo',
                'complemento' => 'APTO 101',
                'bairro' => 'Centro',
                'localidade' => 'Cidade',
                'uf' => 'UF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Ciclano',
                'type' => 'silver',
                'cep' => '54321-876',
                'logradouro' => 'Avenida Teste',
                'complemento' => 'CASA 2',
                'bairro' => 'Bairro',
                'localidade' => 'Cidade',
                'uf' => 'UF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Beltrano',
                'type' => 'gold ',
                'cep' => '98765-432',
                'logradouro' => 'Praça Modelo',
                'complemento' => 'SALA 3',
                'bairro' => 'Centro',
                'localidade' => 'Cidade',
                'uf' => 'UF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
