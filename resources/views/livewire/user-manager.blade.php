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

    @if($showEditModal)

        <div class="relative z-10 " aria-labelledby="modal-title" role="dialog" aria-modal="true" id="edit-modal">

            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div class="relative transform overflow-hidden rounded-lg dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg ">
                        <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none" aria-label="Close" wire:click="closeEditModal">
                            <span class="sr-only">Close</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:ml-0 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-base font-semibold dark:text-white mb-5" id="modal-title">Edit User</h3>

                                    <div class="flex flex-col space-y-4">

                                            <div>
                                                <x-label for="username" value="Name"></x-label>
                                                <x-input id="username" class="block mt-1 mr-2 w-full" type="text" wire:model="editName" />
                                                @error('editName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <div>
                                                <x-label for="useremail" value="E-mail"></x-label>
                                                <x-input id="useremail" class="block mt-1 mr-2 w-full" type="text" wire:model="editEmail" />
                                                @error('editEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <div>
                                                <x-label for="userpassword" value="Password"></x-label>
                                                <x-input id="userpassword" class="block mt-1 mr-2 w-full" type="text" wire:model="editPassword" />
                                                @error('editPassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <div>
                                                <x-label for="userpassword_confirmation" value="Confirm Password:"></x-label>
                                                <x-input id="userpassword_confirmation" class="block mt-1 w-full" type="text" wire:model="editPassword_confirmation" />
                                            </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button wire:click="updateUser" type="button" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Update User</button>
                            <button wire:click="closeEditModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showDeleteModal)
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Delete User
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this user? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="deleteUser" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                        <button wire:click="cancelDelete" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
