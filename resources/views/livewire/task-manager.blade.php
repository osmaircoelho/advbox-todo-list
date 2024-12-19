
<div>

    <h2 class="text-2xl font-bold mb-4">Task Manager</h2>

    <div class="mb-4">
        <input type="text" wire:model="newTaskTitle" placeholder="Task title" class="border rounded px-2 py-1 mr-2">
        <input type="text" wire:model="newTaskDescription" placeholder="Task description" class="border rounded px-2 py-1 mr-2">

        <select wire:model="newTaskCategory" class="border rounded px-2 py-1 mr-2 w-52">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button wire:click="addTask" class="bg-blue-500 text-white px-4 py-1 rounded">Add Task</button>

        @foreach(['newTaskCategory', 'newTaskDescription', 'newTaskTitle'] as $field)
            @error($field)
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        @endforeach

    </div>

    <div class="dark:text-gray-400 space-y-4">

        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th class="w-auto">#</x-table.th>
                    <x-table.th>Task completed</x-table.th>
                    <x-table.th>Task title</x-table.th>
                    <x-table.th>Task description</x-table.th>
                    <x-table.th>Category name</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>


            <tbody>
            @foreach ($tasks->sortByDesc('id') as $task)
                <x-table.tr>
                    <x-table.td class="w-auto">{{ $task->id }}</x-table.td>
                    <x-table.td class="w-auto"><input type="checkbox" wire:click="toggleComplete({{ $task->id }})" {{ $task->completed ? 'checked' : '' }} class="mr-auto"></x-table.td>
                    <x-table.td class="w-auto"><span class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->title }}</span></x-table.td>
                    <x-table.td><span title="{{ $task->description }}">{{ mb_strimwidth($task->description, 0, 55, '...') }}</span></x-table.td>
                    <x-table.td><span class="text-sm text-gray-500 ml-2">({{ $task->category->name ?? 'No Category' }})</span></x-table.td>
                    <x-table.td>
                        <button wire:click="editTask({{ $task->id }})" class="ml-2 text-blue-500">Edit</button>
                        <button wire:click="confirmDelete({{ $task->id }})" class="ml-2 text-red-500">Delete</button>
                    </x-table.td>
                </x-table.tr>
            @endforeach
            </tbody>

        </x-table>

        @if($showDeleteModal)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="delete-modal">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Deletion</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete the task "{{ $taskToDelete->title }}"? This action cannot be undone.
                            </p>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button wire:click="deleteTask" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                                Delete Task
                            </button>
                            <button wire:click="cancelDelete" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


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
                                        <h3 class="text-base font-semibold dark:text-white mb-5" id="modal-title">Edit task </h3>

                                        <div class="flex flex-col space-y-4">
                                            <div class="w-full">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task title</label>
                                                <input type="text" wire:model="editTaskTitle" placeholder="Task title" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @error('editTaskTitle')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="w-full">
                                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category name</label>
                                                <select wire:model="editTaskCategory" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('editTaskCategory') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>

                                            <div>
                                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                <textarea wire:model="editTaskDescription" id="description" rows="5" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description...">{{ $editTaskDescription }}</textarea>
                                                @error('editTaskDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button wire:click="updateTask" type="button" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Update Task</button>
                                <button wire:click="closeEditModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
