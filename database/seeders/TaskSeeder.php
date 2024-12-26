<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();

        $categories = Category::where('user_id', $user->id)->get();

        if ($categories->isEmpty()) {
            print('Nenhuma categoria encontrada para o usuário "test@example.com".').PHP_EOL;
            return;
        }

        $tasks = [
            [
                'title' => 'Preparar relatório mensal',
                'description' => 'Compilar dados e criar apresentação para a reunião de equipe',
                'category' => 'Trabalho',
                'completed' => false,
            ],
            [
                'title' => 'Fazer compras no supermercado',
                'description' => 'Comprar itens essenciais para a semana',
                'category' => 'Pessoal',
                'completed' => true,
            ],
            [
                'title' => 'Estudar para o exame de certificação',
                'description' => 'Revisar capítulos 5-8 do material de estudo',
                'category' => 'Estudo',
                'completed' => false,
            ],
            [
                'title' => 'Iniciar projeto de site pessoal',
                'description' => 'Criar wireframes e escolher tecnologias',
                'category' => 'Projetos',
                'completed' => false,
            ],
            [
                'title' => 'Agendar check-up anual',
                'description' => 'Marcar consulta com médico para exames de rotina',
                'category' => 'Saúde',
                'completed' => false,
            ],
            [
                'title' => 'Revisar orçamento mensal',
                'description' => 'Atualizar planilha de gastos e definir metas de economia',
                'category' => 'Finanças',
                'completed' => false,
            ],
            [
                'title' => 'Planejar viagem de férias',
                'description' => 'Pesquisar destinos, acomodações e atividades',
                'category' => 'Lazer',
                'completed' => false,
            ],
        ];

        foreach ($tasks as $taskData) {
            $category = $categories->firstWhere('name', $taskData['category']);

            if (!$category) {
                print('Categoria "' . $taskData['category'] . '" não encontrada. Tarefa ignorada.').PHP_EOL;
                continue;
            }

            Task::create([
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'category_id' => $category->id,
                'user_id' => $user->id,
                'completed' => $taskData['completed'],
                'completed_at' => $taskData['completed'] ? Carbon::now() : null,
            ]);
        }

    }
}
