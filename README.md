# Aplicação de Lista de Tarefas Laravel

Esta aplicação de Lista de Tarefas baseada em Laravel oferece recursos de gerenciamento de tarefas e administração de usuários. É construída com Laravel 11 e usa Livewire para interfaces de usuário dinâmicas e responsivas.

## Índice

1. [Instalação](#instalação)
2. [Principais Funcionalidades](#principais-funcionalidades)
3. [Testando Filtros e Ações Automáticas](#testando-filtros-e-ações-automáticas)

## Instalação

Siga estes passos para configurar e executar o projeto:

1. Clone o repositório:
   ```
   git clone https://github.com/osmaircoelho/advbox-todo-list.git
   cd advbox-todo-list
   ```

2. Instale as dependências PHP:
   ```
   composer install
   ```

3. Instale e compile as dependências do frontend:
   ```
   npm install
   npm run dev
   ```

4. O arquivo .env já está incluído no repositório para facilitar a instalação. Você pode ajustá-lo conforme necessário.


6. Gere uma chave de aplicação:
   ```
   php artisan key:generate
   ```

7. Configure o banco de dados SQLite no arquivo .env:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/caminho/absoluto/para/seu/arquivo/database.sqlite
   ```

   Certifique-se de criar o arquivo database.sqlite no diretório database/ do seu projeto.

8. Execute as migrações do banco de dados e os seeders:
   ```
   php artisan migrate --seed
   ```

   Ao executar o seeder, um usuário de teste será criado automaticamente:
    - Nome: Test User
    - Email: test@example.com
    - Senha: password

   Este usuário já estará configurado na tela de login, com email e senha preenchidos para facilitar o acesso.

9. Inicie o servidor de desenvolvimento:
   ```
   php artisan serve
   ```

10. Visite `http://localhost:8000` no seu navegador para acessar a aplicação.

## Principais Funcionalidades

1. **Gerenciamento de Tarefas**
    - Criar, editar e excluir tarefas
    - Marcar tarefas como concluídas ou não concluídas
    - Atribuir tarefas a categorias
    - Visualizar detalhes da tarefa, incluindo título, descrição e status

2. **Gerenciamento de Categorias**
    - Criar, editar e excluir categorias de tarefas
    - Atribuir tarefas a categorias específicas
    - Filtrar tarefas por categoria

3. **Gerenciamento de Usuários**
    - Registro e autenticação de usuários
    - Gerenciamento de perfil de usuário
    - Qualquer usuário logado pode gerenciar contas de usuários (criar, editar, excluir)

4. **Filtragem e Ordenação de Tarefas**
    - Filtrar tarefas por categoria
    - Filtrar tarefas por status de conclusão
    - Limpar todos os filtros para visualizar todas as tarefas

5. **Integração com Livewire**
    - Atualizações em tempo real sem recarregar a página
    - Experiência do usuário aprimorada com conteúdo dinâmico

## Testando Filtros e Ações Automáticas

Para testar os filtros e ações na aplicação de Lista de Tarefas, siga estes passos:

1. **Testando Filtros de Tarefas**
    - Faça login na aplicação
    - Crie várias tarefas com diferentes categorias e status de conclusão
    - Use o menu suspenso de categorias para filtrar tarefas por uma categoria específica
    - Use o botão "Mostrar Concluídas" para filtrar tarefas concluídas ou não concluídas
    - Clique no botão "Limpar Filtros" para redefinir todos os filtros

2. **Testando Ações de Tarefas**
    - **Criar uma Tarefa**:
        - Preencha o título da tarefa, descrição e selecione uma categoria
        - Clique em "Adicionar Tarefa" e verifique se ela aparece na lista de tarefas

    - **Editar uma Tarefa**:
        - Clique no botão "Editar" ao lado de uma tarefa
        - Modifique os detalhes da tarefa no modal
        - Clique em "Atualizar Tarefa" e verifique se as alterações são refletidas

    - **Concluir uma Tarefa**:
        - Clique na caixa de seleção ao lado de uma tarefa
        - Verifique se a tarefa é marcada como concluída e se sua aparência muda

    - **Excluir uma Tarefa**:
        - Clique no botão "Excluir" ao lado de uma tarefa
        - Confirme a exclusão no modal
        - Verifique se a tarefa é removida da lista

3. **Testando Gerenciamento de Categorias**
    - Navegue até a seção de Gerenciador de Categorias
    - Crie uma nova categoria
    - Edite uma categoria existente
    - Exclua uma categoria
    - Verifique se as alterações nas categorias são refletidas nas opções de criação e filtragem de tarefas

4. **Testando Gerenciamento de Usuários**
    - Faça login na aplicação
    - Navegue até a seção de Gerenciamento de Usuários
    - Crie uma nova conta de usuário
    - Edite os detalhes de um usuário existente
    - Exclua uma conta de usuário
    - Verifique se os usuários excluídos não podem mais fazer login

5. **Testando Atualizações em Tempo Real do Livewire**
    - Abra a aplicação em duas janelas ou abas diferentes do navegador
    - Em uma janela, crie ou atualize uma tarefa ou categoria
    - Verifique se a alteração aparece em tempo real na outra janela sem atualizar


## Mensagem Final

Foi um grande prazer realizar este desafio técnico para a AdvBox, apesar da correria de fim de ano. Gostaria muito de receber um feedback, seja ele positivo ou negativo, pois isso me ajudará a crescer como profissional.

Este projeto foi feito com muito amor, graças ao TALL stack (Tailwind, Alpine.js, Laravel, Livewire) 💖

Espero que gostem do resultado! 🚀

