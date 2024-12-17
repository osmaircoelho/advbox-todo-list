<div >
    <h2 class="text-2xl font-bold mb-4">Category Manager</h2>

    <div class="mb-4">
        <input type="text" wire:model="newCategoryName" placeholder="Category name" class="border rounded px-2 py-1 mr-2">
        <button wire:click="addCategory" class="bg-green-500 text-white px-4 py-1 rounded">Add Category</button>
    </div>


       <div class="dark:text-gray-400 space-y-4">

           <x-table>
               <x-table.thead>
                   <tr>
                       <x-table.th>#</x-table.th>
                       <x-table.th>Name</x-table.th>
                       <x-table.th>Actions</x-table.th>
                   </tr>
               </x-table.thead>
               <tbody>
               @foreach ($categories->sortByDesc('id') as $category)
                   <x-table.tr>
                       <x-table.td>{{ $category->id }}</x-table.td>
                       <x-table.td>{{ $category->name }}</x-table.td>
                       <x-table.td>
                           <button wire:click="editCategory({{ $category->id }})" class="ml-2 text-blue-500">Edit</button>
                           <button wire:click="deleteCategory({{ $category->id }})" class="ml-2 text-red-500">Delete</button>
                       </x-table.td>
                   </x-table.tr>
               @endforeach
               </tbody>
           </x-table>

       </div>

</div>
