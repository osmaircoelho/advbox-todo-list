<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 mb-2 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center mb-0">
                    <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add New User
                    </a>
                </div>
            </div>
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th class="w-auto">#</x-table.th>
                        <x-table.th>Name</x-table.th>
                        <x-table.th>E-mail</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>

                <tbody>
                @foreach ($users->sortByDesc('id') as $user)
                    <x-table.tr>
                        <x-table.td class="w-auto">{{ $user->id }}</x-table.td>
                        <x-table.td class="w-auto">{{ $user->name }}</x-table.td>
                        <x-table.td class="w-auto">{{ $user->email }}</span></x-table.td>
                        <x-table.td>
                            <button wire:click="editUser({{ $user->id }})" class="ml-2 text-blue-500">Edit</button>
                            <button wire:click="confirmDelete({{ $user->id }})" class="ml-2 text-red-500">Delete
                            </button>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
                </tbody>
            </x-table>

        </div>
        <div class="mt-4 ml-1">
            {{ $users->links() }}
        </div>
    </div>
</div>
