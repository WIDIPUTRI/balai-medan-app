

<?php $__env->startSection('title', 'Update Realisasi'); ?>
<?php $__env->startSection('page-title', 'Update Realisasi Anggaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="bg-gradient-to-br from-white to-cyan-50 shadow-lg rounded-xl p-6 border border-cyan-100">
        <h2 class="text-xl font-bold mb-6 text-cyan-800 flex items-center gap-2">
            <span class="bg-cyan-100 p-2 rounded-lg">
                <i class="fa-solid fa-pen-to-square text-cyan-600"></i>
            </span>
            Input Realisasi Bulanan
        </h2>

        <div class="space-y-6">
            <?php $__empty_1 = true; $__currentLoopData = $groupedAnggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programName => $akuns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border rounded-xl overflow-hidden border-cyan-200 shadow-sm bg-white" x-data="{ open: false }">
                <!-- Program Header (Accordion) -->
                <button @click="open = !open" 
                    class="w-full text-left px-5 py-4 bg-gradient-to-r from-cyan-50 to-white hover:from-cyan-100 hover:to-cyan-50 transition-all flex justify-between items-center border-b border-cyan-100">
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-cyan-900 text-sm md:text-base"><?php echo e($programName); ?></span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-cyan-500 text-white shadow-sm">
                            <?php echo e($akuns->count()); ?> Akun
                        </span>
                    </div>
                    <div class="bg-white p-1.5 rounded-full shadow-sm">
                        <i class="fa-solid fa-chevron-down text-cyan-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                    </div>
                </button>

                <!-- Items List -->
                <div x-show="open" x-transition class="bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-sky-50 text-sky-700 font-bold uppercase text-xs tracking-wider">
                            <tr>
                                <th class="p-3 text-left w-24 border-b border-sky-100">Kode</th>
                                <th class="p-3 text-left border-b border-sky-100">Nama Akun & Sub Kegiatan</th>
                                <th class="p-3 text-right border-b border-sky-100">Pagu</th>
                                <th class="p-3 text-right border-b border-sky-100">Realisasi</th>
                                <th class="p-3 text-right border-b border-sky-100">Sisa</th>
                                <th class="p-3 text-center w-24 border-b border-sky-100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sky-50">
                            <?php $__currentLoopData = $akuns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-cyan-50/60 transition relative group">
                                <td class="p-4 font-mono text-cyan-600 font-medium"><?php echo e($akun->kode); ?></td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-800"><?php echo e($akun->uraian); ?></div>
                                    <div class="text-xs text-cyan-600 mt-1 flex items-center gap-1">
                                        <i class="fa-solid fa-turn-up rotate-90 text-[10px] opacity-50"></i>
                                        <span><?php echo e($akun->parent->uraian); ?></span>
                                    </div>
                                </td>
                                <td class="p-4 text-right whitespace-nowrap text-gray-600"><?php echo e(number_format($akun->pagu_revisi, 0, ',', '.')); ?></td>
                                <td class="p-4 text-right whitespace-nowrap font-bold text-blue-600 bg-blue-50/50 rounded-l-lg my-1"><?php echo e(number_format($akun->realisasi_ini, 0, ',', '.')); ?></td>
                                <td class="p-4 text-right whitespace-nowrap <?php echo e($akun->sisa_anggaran < 0 ? 'text-red-600 font-bold' : 'text-emerald-600 font-semibold'); ?>">
                                    <?php echo e(number_format($akun->sisa_anggaran, 0, ',', '.')); ?>

                                </td>
                                <td class="p-4 text-center">
                                    <button type="button" onclick="event.stopPropagation(); openModal('<?php echo e($akun->id); ?>', '<?php echo e($akun->uraian); ?>')" 
                                        class="px-3 py-1.5 bg-gradient-to-r from-cyan-400 to-blue-500 text-white rounded-lg hover:from-cyan-500 hover:to-blue-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 z-10 relative text-xs font-bold tracking-wide"
                                        title="Tambah Realisasi">
                                        Input
                                    </button>
                                </td>
                            </tr>
                            <!-- Mini History for Context -->
                            <?php if($akun->realisasiDetails->count() > 0): ?>
                            <tr class="bg-amber-50/50 hidden group-hover:table-row transition-all border-l-4 border-amber-300">
                                <td colspan="6" class="px-12 py-3 text-xs text-amber-800">
                                    <span class="font-bold"><i class="fa-solid fa-clock-rotate-left mr-1"></i> Terakhir:</span> 
                                    <?php echo e($akun->realisasiDetails->first()->tanggal->format('d M Y')); ?> 
                                    — <span class="font-mono font-bold">Rp <?php echo e(number_format($akun->realisasiDetails->first()->jumlah, 0, ',', '.')); ?></span>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-200">
                <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-folder-open text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum Ada Data</h3>
                <p class="text-gray-500">Silakan tambahkan data anggaran terlebih dahulu.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Input -->
<div id="realisasiModal" class="fixed inset-0 z-[999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-cyan-900/80 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-white/20">
                
                <!-- Close Button -->
                <button type="button" onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition z-20">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <!-- Content -->
                <div class="bg-gradient-to-br from-white to-cyan-50 px-6 py-6">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 text-white shadow-lg">
                            <i class="fa-solid fa-hand-holding-dollar text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Input Realisasi</h3>
                            <p class="text-sm text-cyan-600 font-medium" id="modalAkunName">Pilih Akun...</p>
                        </div>
                    </div>

                    <form id="realisasiForm" action="<?php echo e(route('anggaran.storeRealisasi')); ?>" method="POST" class="space-y-5">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="anggaran_id" id="modalAnggaranId">
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Transaksi</label>
                            <input type="date" name="tanggal" required 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Realisasi (Rp)</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="jumlah" required min="0" 
                                    class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition py-2" placeholder="0">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan" rows="3" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 transition" 
                                placeholder="Contoh: Pembayaran Honor Bulan Januari"></textarea>
                        </div>
                        
                        <!-- Footer Buttons -->
                        <div class="mt-8 pt-5 border-t border-gray-200/60 flex flex-col sm:flex-row-reverse gap-3">
                            <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold rounded-lg hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 transition shadow-lg shadow-cyan-500/30 transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-save mr-2"></i> Simpan
                            </button>
                            <button type="button" onclick="closeModal()" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-100 transition shadow-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Make functions global
    window.openModal = function(id, name) {
        document.getElementById('modalAnggaranId').value = id;
        document.getElementById('modalAkunName').innerText = name;
        document.getElementById('realisasiModal').classList.remove('hidden');
        
        const today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="tanggal"]').value = today;
    };

    window.closeModal = function() {
        document.getElementById('realisasiModal').classList.add('hidden');
    };
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2025\PROJECT\balai\resources\views/anggaran/realisasi.blade.php ENDPATH**/ ?>