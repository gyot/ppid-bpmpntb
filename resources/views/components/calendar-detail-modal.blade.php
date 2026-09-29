<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" @click.self="showModal = false" x-transition>
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full max-h-[80vh] overflow-y-auto" @click.stop x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Detail Program</h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-4 space-y-4" x-show="selectedProgram">
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500 text-xs">Tahun</p>
                    <p class="font-medium" x-text="selectedProgram?.tahun"></p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Status</p>
                    <p class="font-medium" x-text="selectedProgram?.status ? selectedProgram.status.charAt(0).toUpperCase() + selectedProgram.status.slice(1) : ''"></p>
                </div>
            </div>
            <div>
                <p class="text-gray-500 text-xs">Penanggung Jawab</p>
                <p class="font-medium" x-text="selectedProgram?.penanggung_jawab"></p>
            </div>
            <div>
                <p class="text-gray-500 text-xs">Uraian Kegiatan</p>
                <p class="font-medium" x-text="selectedProgram?.uraian_kegiatan"></p>
            </div>
            <div x-show="selectedProgram?.deskripsi">
                <p class="text-gray-500 text-xs">Deskripsi</p>
                <p class="text-sm text-gray-700" x-text="selectedProgram?.deskripsi"></p>
            </div>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500 text-xs">Anggaran</p>
                    <p class="font-medium" x-text="selectedProgram?.formatted_anggaran ?? 'Rp 0'"></p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Urutan</p>
                    <p class="font-medium" x-text="selectedProgram?.urutan"></p>
                </div>
            </div>
            <div>
                <p class="text-gray-500 text-xs mb-2">Bulan Pelaksanaan</p>
                <div class="flex flex-wrap gap-1">
                    <template x-for="b in (selectedProgram?.bulan_array ?? [])" :key="b">
                        <span class="inline-block text-xs px-2 py-1 rounded font-medium text-white" :style="'background-color:' + (selectedProgram?.pj_color ?? '#2563eb')" x-text="['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'][b-1]"></span>
                    </template>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-2 p-4 border-t">
            <button @click="showModal = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Tutup</button>
        </div>
    </div>
</div>
