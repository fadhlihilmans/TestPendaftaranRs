<div>

@if ($formAdd || $formEdit)
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg mx-4">
        <button wire:click="resetForm" 
                type="button" 
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            <i class="mdi mdi-close text-2xl"></i>
        </button>
        <div class="p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-xl font-semibold">{{ $formAdd ? 'Tambah' : 'Edit' }} Data Poli</h4>
            </div>
            
            <form wire:submit.prevent="{{ $formAdd ? 'add' : 'update' }}" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium mb-1">Nama Poli</label>
                    <input wire:model="nama_poli" type="text" class="w-full px-3 py-2  rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/20 focus:border-gray-300 @error('nama_poli') invalid @enderror">
                    @error('nama_poli') 
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-1">Kuota</label>
                    <input wire:model="kuota" type="text" class="w-full px-3 py-2  rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/20 focus:border-gray-300 @error('kuota') invalid @enderror">
                    @error('kuota') 
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-6">
                    <button wire:click="resetForm" 
                            type="button" 
                            class="px-4 py-2 border border-gray-200 text-sm font-medium rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button wire:loading.remove wire:target="add, update" 
                            type="submit" 
                            class="px-5 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800">
                        Simpan
                    </button>
                    <button wire:loading wire:target="add, update" 
                            type="button" 
                            class="px-5 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800">
                        <i class="mdi mdi-loading mdi-spin"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if ($confirmingDelete)
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-sm">
        <div class="p-6">
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="mdi mdi-alert-octagon-outline text-red-600 text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Hapus Data</h3>
                <p class="text-sm mb-6">Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
                
                <div class="flex space-x-3 w-full">
                    <button wire:click="$set('confirmingDelete', false)" class="flex-1 px-4 py-2 border border-gray-200 bg-white text-sm font-medium rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button wire:loading.remove wire:target="deleteConfirmed" wire:click="deleteConfirmed" class="flex-1 px-4 py-2 bg-red-600 text-sm font-medium rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                    <button wire:loading wire:target="deleteConfirmed" class="flex-1 px-4 py-2 bg-red-600 text-sm font-medium rounded-lg hover:bg-red-700">
                        <i class="mdi mdi-loading mdi-spin"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="bg-white border border-gray-200 rounded-lg">
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <h3 class="text-lg font-semibold">Poli</h3>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <button wire:target="formAdd" wire:loading.remove type="button" wire:click="$set('formAdd', true)" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800">
                    <i class="mdi mdi-plus w-4 h-4 inline mr-2"></i>
                    Tambah Data
                </button>
                <button wire:target="formAdd" wire:loading type="button" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800">
                    <i class="mdi mdi-loading mdi-spin"></i>
                </button>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-light">
                <thead class="">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Poli</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kuota</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Opsi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-light">
                    @forelse ($listPoli as $item)
                        <tr class="divide-light">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $loop->iteration }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $item->nama_poli }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $item->kuota }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $item->id }})" class="hover bg-white mr-1">
                                    <i class="bx bx-pencil text-base"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $item->id }})" class="hover bg-white">
                                    <i  class="bx bx-trash-alt text-base"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>