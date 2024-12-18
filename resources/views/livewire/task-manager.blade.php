
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

        @error('newTaskCategory') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        @error('newTaskDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        @error('newTaskTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                        <button wire:click="deleteTask({{ $task->id }})" class="ml-2 text-red-500">Delete</button>
                    </x-table.td>
                </x-table.tr>
            @endforeach

            </tbody>

        </x-table>
    </div>
</div>
