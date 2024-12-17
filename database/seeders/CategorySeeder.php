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

        $user = User::first();

        if (!$user) {
            Log::warning('Nenhum usuário encontrado. As categorias não foram criadas.');
            return;
        }

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'user_id' => $user->id
            ]);
        }
        $this->command->info('Categorias criadas com sucesso para o usuário: ' . $user->email);
    }
}
