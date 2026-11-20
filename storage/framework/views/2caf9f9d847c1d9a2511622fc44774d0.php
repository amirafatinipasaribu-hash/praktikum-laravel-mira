<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<section class="card hero-card">
    <h1 style="margin: 0 0 0.4rem; font-size: 1.65rem; letter-spacing: -0.02em;">Portal Berita Sederhana</h1>
    <p class="muted" style="margin: 0 0 0.85rem;">
        Selamat datang di portal berita sederhana berbasis Laravel. Berita di bawah ini diambil dari tabel <code>articles</code>.
    </p>

    <?php if(auth()->guard()->check()): ?>
        <div style="font-size: 0.9rem; color: var(--text-muted);">
            Kamu login sebagai <strong style="color: var(--text-main);"><?php echo e(auth()->user()->name); ?></strong>.
            <?php if(\Illuminate\Support\Facades\Route::has('articles.index')): ?>
                Kelola berita melalui menu <a href="<?php echo e(route('articles.index')); ?>">Artikel</a>.
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div style="font-size: 0.9rem; color: var(--text-muted);">
            Silakan
            <?php if(\Illuminate\Support\Facades\Route::has('login')): ?>
                <a href="<?php echo e(route('login')); ?>">Login</a>
            <?php endif; ?>
            <?php if(\Illuminate\Support\Facades\Route::has('login') && \Illuminate\Support\Facades\Route::has('register')): ?>
                atau
            <?php endif; ?>
            <?php if(\Illuminate\Support\Facades\Route::has('register')): ?>
                <a href="<?php echo e(route('register')); ?>">Register</a>
            <?php endif; ?>
            untuk menulis dan mengelola artikel.
        </div>
    <?php endif; ?>
</section>

<section class="card" style="margin-top: 1.25rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; margin-bottom: 1.1rem; flex-wrap: wrap;">
        <h2 style="margin: 0; font-size: 1.2rem;">Berita Terbaru</h2>
        <?php if(\Illuminate\Support\Facades\Route::has('articles.index')): ?>
            <a href="<?php echo e(route('articles.index')); ?>" style="font-size: 0.88rem; font-weight: 600;">Lihat semua artikel &rarr;</a>
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
                ?>

                <article class="news-item">
                    <img src="<?php echo e($gambarTampil); ?>"
                         alt="Gambar <?php echo e($article->title); ?>"
                         class="news-thumb">

                    <div class="news-body">
                        <h3 class="news-title">
                            <?php if(\Illuminate\Support\Facades\Route::has('articles.show')): ?>
                                <a href="<?php echo e(route('articles.show', $article)); ?>"><?php echo e($article->title); ?></a>
                            <?php else: ?>
                                <?php echo e($article->title); ?>

                            <?php endif; ?>
                        </h3>

                        <div class="news-meta">
                            Dipublikasikan pada <?php echo e($tanggalTampil); ?> oleh <?php echo e($penulisTampil); ?>

                        </div>

                        <p class="news-excerpt">
                            <?php echo e(\Illuminate\Support\Str::limit($isiTampil, 165)); ?>

                        </p>

                        <?php if(\Illuminate\Support\Facades\Route::has('articles.show')): ?>
                            <a href="<?php echo e(route('articles.show', $article)); ?>" class="read-more">Baca selengkapnya &rarr;</a>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="muted" style="margin: 0;">Belum ada artikel.</p>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\belajar-laravel\resources\views/pages/home.blade.php ENDPATH**/ ?>