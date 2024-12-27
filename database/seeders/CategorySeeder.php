<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Trabalho',
            'Pessoal',
            'Estudo',
            'Projetos',
            'Saúde',
            'Finanças',
            'Lazer',
        ];

        $users = User::all();

        if ($users->isEmpty()) {
            print('Nenhum usuário encontrado. As categorias não foram criadas.').PHP_EOL;
            return;
        }

        foreach ($categories as $categoryName) {

            $randomUser = $users->random();

            Category::create([
                'name' => $categoryName,
                'user_id' => $randomUser->id
            ]);
        }
        print('Categoria "' . $categoryName . '" criada para o usuário: ' . $randomUser->email).PHP_EOL;
    }
}
