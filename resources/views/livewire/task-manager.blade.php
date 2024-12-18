
<div>

    <h2 class="text-2xl font-bold mb-4">Category Manager</h2>

    <div class="dark:text-gray-400 space-y-4">

        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>#</x-table.th>
                    <x-table.th></x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>


            <tbody>
            @foreach ($tasks->sortByDesc('id') as $task)
                <x-table.tr>
                    <x-table.td>{{ $task->id }}</x-table.td>
                    <x-table.td></x-table.td>
                    <x-table.td><span class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->title }}</span></x-table.td>
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
