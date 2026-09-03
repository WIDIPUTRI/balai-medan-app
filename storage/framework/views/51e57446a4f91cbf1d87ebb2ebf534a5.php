

<?php $__env->startSection('title', 'Laporan Transaksi'); ?>
<?php $__env->startSection('page-title', 'Laporan Transaksi Realisasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-6">
        <div class="bg-white shadow rounded-xl p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice-dollar text-blue-600"></i>
                    Riwayat Transaksi Realisasi
                </h2>

                <div class="flex items-center gap-2">
                    <form action="<?php echo e(route('anggaran.laporan')); ?>" method="GET" class="flex items-center gap-2">
                        <label class="text-sm font-medium text-gray-600">Periode:</label>
                        <input type="month" name="bulan" value="<?php echo e(request('bulan')); ?>" onchange="this.form.submit()"
                            class="rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                        <?php if(request('bulan')): ?>
                            <a href="<?php echo e(route('anggaran.laporan')); ?>"
                                class="text-xs text-red-500 hover:text-red-700 underline">Reset</a>
                        <?php endif; ?>
                    </form>

                    <div class="h-6 w-px bg-gray-300 mx-2"></div>

                    <a href="<?php echo e(route('anggaran.laporan.pdf', request()->all())); ?>" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition shadow-sm gap-2">
                        <i class="fa-solid fa-file-pdf"></i>
                        Export PDF
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-left uppercase tracking-wider text-xs">
                            <th class="p-4 rounded-tl-lg">Tanggal</th>
                            <th class="p-4">Program / Kegiatan</th>
                            <th class="p-4">Akun Belanja</th>
                            <th class="p-4">Keterangan</th>
                            <th class="p-4 text-right">Jumlah (Rp)</th>
                            <th class="p-4 text-center rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 whitespace-nowrap text-gray-600 font-medium">
                                    <?php echo e($trx->tanggal->format('d M Y')); ?>

                                </td>
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800 text-xs mb-1">
                                        <?php echo e($trx->anggaran->parent->parent->parent->kode ?? '-'); ?>

                                    </div>
                                    <div class="text-gray-500 text-xs">
                                        <?php echo e($trx->anggaran->parent->uraian ?? '-'); ?>

                                    </div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="inline-block px-2 py-1 rounded bg-blue-50 text-blue-700 font-mono text-xs mb-1">
                                        <?php echo e($trx->anggaran->kode); ?>

                                    </span>
                                    <div class="text-gray-900 font-medium">
                                        <?php echo e($trx->anggaran->uraian); ?>

                                    </div>
                                </td>
                                <td class="p-4 text-gray-600 italic">
                                    <?php echo e($trx->keterangan ?? '-'); ?>

                                </td>
                                <td class="p-4 text-right font-bold text-gray-800">
                                    <?php echo e(number_format($trx->jumlah, 0, ',', '.')); ?>

                                </td>
                                <td class="p-4 text-center">
                                    <button
                                        onclick="openEditModal('<?php echo e($trx->id); ?>', '<?php echo e($trx->tanggal->format('Y-m-d')); ?>', '<?php echo e($trx->jumlah); ?>', '<?php echo e(addslashes($trx->keterangan)); ?>')"
                                        class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                        title="Edit Transaksi">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400">
                                    <i class="fa-solid fa-folder-open text-4xl mb-3 block"></i>
                                    Belum ada data transaksi yang ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if($transactions->isNotEmpty()): ?>
                        <tfoot class="bg-gray-50 font-bold text-gray-800">
                            <tr>
                                <td colspan="4" class="p-4 text-right transform uppercase text-xs tracking-wide">Total Halaman
                                    Ini</td>
                                <td class="p-4 text-right text-blue-700">
                                    <?php echo e(number_format($transactions->sum('jumlah'), 0, ',', '.')); ?>

                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>

            <div class="mt-4">
                <?php echo e($transactions->withQueryString()->links()); ?>

            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-[999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4" id="modal-title">Edit Transaksi
                            Realisasi</h3>

                        <form id="editForm" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                    <input type="date" name="tanggal" id="editTanggal" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                                    <input type="number" name="jumlah" id="editJumlah" required min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                    <textarea name="keterangan" id="editKeterangan" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2">Simpan
                                    Perubahan</button>
                                <button type="button" onclick="closeEditModal()"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, tanggal, jumlah, keterangan) {
            document.getElementById('editForm').action = "/realisasi/update/" + id;
            document.getElementById('editTanggal').value = tanggal;
            document.getElementById('editJumlah').value = jumlah;
            document.getElementById('editKeterangan').value = keterangan;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2025\PROJECT\balai\resources\views/anggaran/laporan.blade.php ENDPATH**/ ?>