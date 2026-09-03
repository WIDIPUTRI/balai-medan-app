

<?php $__env->startSection('title', 'Anggaran'); ?>
<?php $__env->startSection('page-title', 'Data Anggaran'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-6">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Tabel Anggaran</h2>
            <a href="<?php echo e(route('anggaran.create')); ?>"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Tambah Data
            </a>
        </div>

        
        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-800 text-white text-center">
                        <th class="p-3 text-left min-w-[400px]">Uraian</th>
                        <th class="p-3 min-w-[140px]">Pagu Revisi</th>
                        <th class="p-3 min-w-[140px]">Limit Pagu</th>
                        <th colspan="4" class="p-2 border-l border-gray-600">Realisasi TA 2024</th>
                        <th class="p-3 min-w-[140px] border-l border-gray-600">Sisa Anggaran</th>
                        <th class="p-3 min-w-[80px]">Aksi</th>
                    </tr>
                    <tr class="bg-gray-700 text-white text-center text-xs">
                        <th class="p-2"></th>
                        <th class="p-2"></th>
                        <th class="p-2"></th>
                        <th class="p-2 border-l border-gray-600">Realisasi Lalu</th>
                        <th class="p-2">Realisasi Ini</th>
                        <th class="p-2">s.d. Periode</th>
                        <th class="p-2">%</th>
                        <th class="p-2 border-l border-gray-600"></th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                
                <?php if($anggarans->count() > 0): ?>
                <tr class="font-bold text-black border-b border-gray-300" style="background-color: #00FFFF;">
                    <td class="p-3 text-center">JUMLAH SELURUHNYA</td>
                    <td class="p-3 text-right"><?php echo e(number_format($totals['pagu_revisi'], 0, ',', '.')); ?></td>
                    <td class="p-3 text-right"><?php echo e(number_format($totals['limit_pagu'], 0, ',', '.')); ?></td>
                    <td class="p-3 text-right border-l border-gray-400"><?php echo e(number_format($totals['realisasi_lalu'], 0, ',', '.',)); ?></td>
                    <td class="p-3 text-right"><?php echo e(number_format($totals['realisasi_ini'], 0, ',', '.')); ?></td>
                    <td class="p-3 text-right"><?php echo e(number_format($totals['realisasi_total'], 0, ',', '.')); ?></td>
                    <td class="p-3 text-center"><?php echo e($totals['persen']); ?> %</td>
                    <td class="p-3 text-right border-l border-gray-400"><?php echo e(number_format($totals['sisa'], 0, ',', '.')); ?></td>
                    <td class="p-3"></td>
                </tr>
                <?php endif; ?>

                    <?php $__empty_1 = true; $__currentLoopData = $anggarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="<?php echo e($item->level_color); ?> border-b hover:bg-opacity-80 transition-colors"
                                    data-id="<?php echo e($item->id); ?>">
                                    
                                    <td class="p-3">
                                        <div style="padding-left: <?php echo e($item->indent_level * 24); ?>px" class="flex items-center gap-2">
                                            <?php if($item->level == 'program'): ?>
                                                <i class="fa-solid fa-folder text-cyan-600"></i>
                                            <?php elseif($item->level == 'kegiatan'): ?>
                                                <i class="fa-solid fa-list-check text-blue-600"></i>
                                            <?php elseif($item->level == 'sub_kegiatan'): ?>
                                                <i class="fa-solid fa-clipboard-list text-green-600"></i>
                                            <?php else: ?>
                                                <i class="fa-solid fa-wallet text-orange-500"></i>
                                            <?php endif; ?>
                                            <span>
                                                <strong><?php echo e($item->kode); ?></strong>
                                                <?php echo e($item->uraian); ?>

                                            </span>
                                        </div>
                                    </td>

                                    
                                    <td class="p-2 text-right">
                                        <?php if($item->level == 'akun'): ?>
                                            <input type="text"
                                                class="w-full text-right px-2 py-1 border rounded focus:ring-2 focus:ring-blue-500 editable-field"
                                                data-field="pagu_revisi" value="<?php echo e(number_format($item->pagu_revisi, 0, ',', '.')); ?>"
                                                data-raw="<?php echo e($item->pagu_revisi); ?>">
                                        <?php else: ?>
                                            <span class="font-medium"><?php echo e(number_format($item->pagu_revisi, 0, ',', '.')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-2 text-right">
                                        <?php if($item->level == 'akun'): ?>
                                            <input type="text"
                                                class="w-full text-right px-2 py-1 border rounded focus:ring-2 focus:ring-blue-500 editable-field"
                                                data-field="limit_pagu" value="<?php echo e(number_format($item->limit_pagu, 0, ',', '.')); ?>"
                                                data-raw="<?php echo e($item->limit_pagu); ?>">
                                        <?php else: ?>
                                            <span><?php echo e(number_format($item->limit_pagu, 0, ',', '.')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-2 text-right border-l">
                                        <?php if($item->level == 'akun'): ?>
                                            <input type="text"
                                                class="w-full text-right px-2 py-1 border rounded focus:ring-2 focus:ring-green-500 editable-field"
                                                data-field="realisasi_lalu" value="<?php echo e(number_format($item->realisasi_lalu, 0, ',', '.')); ?>"
                                                data-raw="<?php echo e($item->realisasi_lalu); ?>">
                                        <?php else: ?>
                                            <span><?php echo e(number_format($item->realisasi_lalu, 0, ',', '.')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-2 text-right">
                                        <?php if($item->level == 'akun'): ?>
                                            <input type="text"
                                                class="w-full text-right px-2 py-1 border rounded focus:ring-2 focus:ring-green-500 editable-field"
                                                data-field="realisasi_ini" value="<?php echo e(number_format($item->realisasi_ini, 0, ',', '.')); ?>"
                                                data-raw="<?php echo e($item->realisasi_ini); ?>">
                                        <?php else: ?>
                                            <span><?php echo e(number_format($item->realisasi_ini, 0, ',', '.')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    
                                    <td class="p-2 text-right font-medium realisasi-total">
                                        <?php echo e(number_format($item->realisasi_total, 0, ',', '.')); ?>

                                    </td>

                                    
                                    <td class="p-2 text-center persen-cell">
                                        <span
                                            class="px-2 py-1 rounded text-xs font-medium
                                            <?php echo e($item->persen_realisasi >= 80 ? 'bg-green-100 text-green-700' :
                        ($item->persen_realisasi >= 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')); ?>">
                                            <?php echo e($item->persen_realisasi); ?>%
                                        </span>
                                    </td>

                                    
                                    <td
                                        class="p-2 text-right border-l sisa-cell <?php echo e($item->sisa_anggaran < 0 ? 'text-red-600' : 'text-gray-700'); ?>">
                                        <?php echo e(number_format($item->sisa_anggaran, 0, ',', '.')); ?>

                                    </td>

                                    
                                    <td class="p-2 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="<?php echo e(route('anggaran.edit', $item->id)); ?>" class="text-blue-500 hover:text-blue-700"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form id="delete-form-<?php echo e($item->id); ?>" action="<?php echo e(route('anggaran.destroy', $item->id)); ?>"
                                                method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" onclick="confirmDelete('delete-form-<?php echo e($item->id); ?>')"
                                                    class="text-red-500 hover:text-red-700" title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="p-8 text-center text-gray-500">
                                <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                                <p>Belum ada data anggaran.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>


            </table>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            document.querySelectorAll('.editable-field').forEach(input => {
                input.addEventListener('blur', function () {
                    const row = this.closest('tr');
                    const id = row.dataset.id;
                    const field = this.dataset.field;
                    const rawValue = this.value.replace(/\./g, '').replace(/,/g, '');
                    const value = parseFloat(rawValue) || 0;

                    // Update via AJAX
                    fetch(`/anggaran/${id}/quick-update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ field, value })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // Update calculated fields
                                row.querySelector('.realisasi-total').textContent = new Intl.NumberFormat('id-ID').format(data.realisasi_total);
                                row.querySelector('.sisa-cell').textContent = new Intl.NumberFormat('id-ID').format(data.sisa);

                                const persenCell = row.querySelector('.persen-cell span');
                                persenCell.textContent = data.persen + '%';
                            }
                        });

                    // Format input value
                    this.value = new Intl.NumberFormat('id-ID').format(value);
                    this.dataset.raw = value;
                });

                input.addEventListener('focus', function () {
                    this.value = this.dataset.raw || '0';
                    this.select();
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2025\PROJECT\balai\resources\views/anggaran/index.blade.php ENDPATH**/ ?>