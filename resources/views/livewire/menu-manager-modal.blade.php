<div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" wire:click="closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-900 sm:max-w-lg sm:w-full">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white" id="modal-title">
                    {{ $menu_id ? 'Edit Menu' : 'Tambah Menu Baru' }}
                </h3>
                <div class="mt-4">
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Menu</label>
                                <input type="text" wire:model.defer="name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="route" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Route</label>
                                <input type="text" wire:model.defer="route" id="route" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('route') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Ikon</label>
                                <input type="text" wire:model.defer="icon" id="icon" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('icon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Urutan</label>
                                <input type="number" wire:model.defer="order" id="order" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('order') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-zinc-700 dark:text-gray-200 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>