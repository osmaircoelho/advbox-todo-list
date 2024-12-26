<div>
    <h2 class="text-2xl font-bold mb-4 text-white">Category Manager</h2>

    <div class="mb-4 flex flex-row">

        <div>
            <x-label for="categoryname" value="Category name"></x-label>
            <x-input id="categoryname" class="block mt-1" type="text" wire:model="newCategoryName" />
        </div>


        <div class="items-center content-end">
            <x-button class="ms-3" wire:click="addCategory">Add Category</x-button>
        </div>

        </br>

        <div class="items-center content-end ml-2">
            @error('newCategoryName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

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
                           <button wire:click="confirmDelete({{ $category->id }})" class="ml-2 text-red-500">Delete</button>
                       </x-table.td>
                   </x-table.tr>
               @endforeach

               </tbody>


           </x-table>

           @if($showEditModal)
               <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="edit-modal">
                   <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                       <div class="mt-3 text-center">
                           <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Category</h3>
                           <div class="mt-2 px-7 py-3">
                               <input type="text" wire:model="editCategoryName" placeholder="Category name" class="border rounded px-2 py-1 mb-2 w-full">
                               @error('editCategoryName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                           </div>
                           <div class="items-center px-4 py-3">
                               <button wire:click="updateCategory" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                   Update Category
                               </button>
                               <button wire:click="closeEditModal" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                   Cancel
                               </button>
                           </div>
                       </div>
                   </div>
               </div>
           @endif

           @if($showDeleteModal)
               <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="delete-modal">
                   <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                       <div class="mt-3 text-center">
                           <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Deletion</h3>
                           <div class="mt-2 px-7 py-3">
                               <p class="text-sm text-gray-500">
                                   Are you sure you want to delete the category "{{ $categoryToDelete->name }}"? This action cannot be undone.
                               </p>
                           </div>
                           <div class="items-center px-4 py-3">
                               <button wire:click="deleteCategory" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                                   Delete Category
                               </button>
                               <button wire:click="cancelDelete" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                   Cancel
                               </button>
                           </div>
                       </div>
                   </div>
               </div>
           @endif

       </div>

</div>
