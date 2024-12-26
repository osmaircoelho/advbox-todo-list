<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>


    {{--<div class="dark:text-gray-400 space-y-4">

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

        </x-table>--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">User List</h3>
                        <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New User
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

