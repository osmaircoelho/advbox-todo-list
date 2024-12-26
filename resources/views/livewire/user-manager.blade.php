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
                    <div class="mb-4 flex flex-row">
                        <div>
                            <x-label for="username" value="Name"></x-label>
                            <x-input id="username" class="block mt-1 mr-2" type="text" wire:model="name" />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <x-label for="useremail" value="E-mail"></x-label>
                            <x-input id="useremail" class="block mt-1 mr-2" type="text" wire:model="email" />
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <x-label for="userpassword" value="Password"></x-label>
                            <x-input id="userpassword" class="block mt-1 mr-2" type="text" wire:model="password" />
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <x-label for="userpassword_confirmation" value="Confirm Password:"></x-label>
                            <x-input id="userpassword_confirmation" class="block mt-1" type="text" wire:model="password_confirmation" />
                        </div>

                        <div class="items-center content-end">
                            <x-button wire:click="adduser" class="ms-3">Add User</x-button>

                        </div>
                    </div>
                </div>

                <div>
                    @if ($message)
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ $message }}</span>
                            <button wire:click="closeAlert" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                                </svg>
                            </button>
                        </div>
                    @endif
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
