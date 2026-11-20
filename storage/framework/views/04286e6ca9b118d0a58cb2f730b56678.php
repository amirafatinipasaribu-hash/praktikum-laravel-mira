<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $currentUser = $user ?? auth()->user();
    $totalAll = $totalArticles ?? \App\Models\Article::count();
    $totalMine = $myArticlesCount ?? ($currentUser ? \App\Models\Article::where('user_id', $currentUser->id)->count() : 0);
    $mineList = $recentArticles ?? ($currentUser ? \App\Models\Article::where('user_id', $currentUser->id)->latest()->take(5)->get() : collect());
?>

<section class="card hero-card">
    <h1 style="margin: 0 0 0.35rem; font-size: 1.55rem;">Dashboard Penulis</h1>
    <p class="muted" style="margin: 0;">
        Selamat datang kembali, <strong style="color: var(--text-main);"><?php echo e(optional($currentUser)->name ?? 'Pengguna'); ?></strong>. Pantau ringkasan artikel dan kelola kontenmu di sini.
    </p>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-label">Total Artikel</div>
            <div class="stat-value"><?php echo e($totalAll); ?></div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Artikel Kamu</div>
            <div class="stat-value"><?php echo e($totalMine); ?></div>
        </div>
    </div>

    <div class="action-row">
        <?php if(\Illuminate\Support\Facades\Route::has('articles.create')): ?>
            <a href="<?php echo e(route('articles.create')); ?>" class="btn btn-primary">+ Tulis Artikel Baru</a>
        <?php endif; ?>
        <?php if(\Illuminate\Support\Facades\Route::has('articles.index')): ?>
            <a href="<?php echo e(route('articles.index')); ?>" class="btn btn-outline">Kelola Semua Artikel</a>
        <?php endif; ?>
    </div>
</section>

<section class="card" style="margin-top: 1.25rem;">
    <h2 style="margin: 0 0 0.9rem; font-size: 1.15rem;">Artikel Terakhir Kamu</h2>

    <?php if($mineList->isNotEmpty()): ?>
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
            <?php $__currentLoopData = $mineList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.85rem 1rem; border-radius: 10px; background: var(--bg-card-item); border: 1px solid var(--border-color); flex-wrap: wrap;">
                    <div>
                        <div style="font-weight: 600;">
                            <?php if(\Illuminate\Support\Facades\Route::has('articles.show')): ?>
                                <a href="<?php echo e(route('articles.show', $item)); ?>"><?php echo e($item->title); ?></a>
                            <?php else: ?>
                                <?php echo e($item->title); ?>

                            <?php endif; ?>
                        </div>
                        <div class="muted" style="font-size: 0.8rem;">
                            <?php echo e(optional($item->created_at)->format('d M Y') ?? now()->format('d M Y')); ?>

                        </div>
                    </div>

                    <div class="action-row">
                        <?php if(\Illuminate\Support\Facades\Route::has('articles.edit')): ?>
                            <a href="<?php echo e(route('articles.edit', $item)); ?>" class="btn btn-outline btn-sm">Edit</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="muted" style="margin: 0;">Kamu belum menulis artikel. Klik <strong>+ Tulis Artikel Baru</strong> untuk memulai.</p>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\belajar-laravel\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>