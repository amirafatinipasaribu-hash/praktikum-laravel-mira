<?php $__env->startSection('title', 'Daftar Artikel'); ?>

<?php $__env->startSection('content'); ?>
<section class="card">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
        <div>
            <h1 style="margin: 0 0 0.25rem; font-size: 1.5rem;">Daftar Artikel</h1>
            <p class="muted" style="margin: 0; font-size: 0.9rem;">Seluruh arsip berita yang tersimpan di portal.</p>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <?php if(\Illuminate\Support\Facades\Route::has('articles.create')): ?>
                <a href="<?php echo e(route('articles.create')); ?>" class="btn btn-primary">+ Tulis Artikel</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if(isset($articles) && $articles->isNotEmpty()): ?>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $tanggalTampil = optional($article->created_at)->format('d M Y') ?? now()->format('d M Y');
                    $penulisTampil = optional($article->user)->name ?? 'Praktikan';
                    $gambarTampil = $article->image_url
                        ?? ($article->image ?: 'https://picsum.photos/seed/' . urlencode($article->slug ?? $article->id ?? $loop->index) . '/800/450');
                    $isiTampil = $article->body ?? $article->content ?? '';
                    $isOwner = auth()->check() && (int) $article->user_id === (int) auth()->id();
                ?>

                <article class="news-item">
                    <img src="<?php echo e($gambarTampil); ?>"
                         alt="Gambar <?php echo e($article->title); ?>"
                         class="news-thumb">

                    <div class="news-body">
                        <h2 class="news-title">
                            <?php if(\Illuminate\Support\Facades\Route::has('articles.show')): ?>
                                <a href="<?php echo e(route('articles.show', $article)); ?>"><?php echo e($article->title); ?></a>
                            <?php else: ?>
                                <?php echo e($article->title); ?>

                            <?php endif; ?>
                        </h2>

                        <div class="news-meta">
                            Dipublikasikan pada <?php echo e($tanggalTampil); ?> oleh <?php echo e($penulisTampil); ?>

                        </div>

                        <p class="news-excerpt">
                            <?php echo e(\Illuminate\Support\Str::limit($isiTampil, 150)); ?>

                        </p>

                        <div class="action-row" style="margin-top: 0.7rem;">
                            <?php if(\Illuminate\Support\Facades\Route::has('articles.show')): ?>
                                <a href="<?php echo e(route('articles.show', $article)); ?>" class="btn btn-outline btn-sm">Baca</a>
                            <?php endif; ?>

                            <?php if($isOwner): ?>
                                <?php if(\Illuminate\Support\Facades\Route::has('articles.edit')): ?>
                                    <a href="<?php echo e(route('articles.edit', $article)); ?>" class="btn btn-outline btn-sm">Edit</a>
                                <?php endif; ?>
                                <?php if(\Illuminate\Support\Facades\Route::has('articles.destroy')): ?>
                                    <form action="<?php echo e(route('articles.destroy', $article)); ?>" method="POST" style="margin: 0;" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger-outline btn-sm">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if(method_exists($articles, 'links')): ?>
            <div class="pagination-wrap">
                <?php echo e($articles->links()); ?>

            </div>
        <?php endif; ?>
    <?php else: ?>
        <p class="muted" style="margin: 0;">Belum ada artikel tersedia.</p>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\belajar-laravel\resources\views/articles/index.blade.php ENDPATH**/ ?>