<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Portal Berita'); ?> — Portal Berita Sederhana</title>
    <style>
        :root {
            --bg-page: #090d16;
            --bg-surface: #0f172a;
            --bg-card-item: #131d33;
            --bg-subtle: #1e293b;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --border-color: #1e293b;
            --border-hover: #38bdf8;
            --accent: #38bdf8;
            --accent-hover: #7dd3fc;
            --hero-grad: linear-gradient(135deg, #050811 0%, #0b192c 55%, #102a43 100%);
            --btn-grad: linear-gradient(135deg, #0284c7 0%, #0f172a 100%);
            --danger-bg: #2a1215;
            --danger-text: #fca5a5;
            --success-bg: #0c291d;
            --success-text: #6ee7b7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            line-height: 1.65;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            color: var(--accent);
            text-decoration: none;
        }

        a:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        .container {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
            padding: 0 1.25rem;
        }

        .topbar {
            background-color: rgba(9, 13, 22, 0.94);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.9rem 0;
            flex-wrap: wrap;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            flex-wrap: wrap;
        }

        .brand {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        .brand:hover {
            text-decoration: none;
            color: var(--accent);
        }

        .nav-link {
            font-size: 0.92rem;
            font-weight: 500;
            color: var(--text-muted);
            padding: 0.25rem 0;
        }

        .nav-link.active,
        .nav-link:hover {
            color: var(--text-main);
            text-decoration: none;
            border-bottom: 2px solid var(--accent);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.88rem;
            flex-wrap: wrap;
        }

        .user-badge {
            color: var(--text-main);
            background-color: var(--bg-subtle);
            border: 1px solid #29384e;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.48rem 0.95rem;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn:hover {
            text-decoration: none;
        }

        .btn-primary {
            background: var(--btn-grad);
            color: #ffffff;
            border-color: #0369a1;
        }

        .btn-primary:hover {
            border-color: var(--accent);
        }

        .btn-outline {
            background-color: var(--bg-surface);
            color: var(--text-main);
            border-color: #2c3b52;
        }

        .btn-outline:hover {
            background-color: var(--bg-subtle);
            border-color: var(--accent);
        }

        .btn-danger-outline {
            background-color: var(--danger-bg);
            color: var(--danger-text);
            border-color: #7f1d1d;
        }

        .btn-danger-outline:hover {
            background-color: #3b161b;
            border-color: #f87171;
        }

        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.82rem;
        }

        main {
            flex: 1;
            padding: 1.75rem 0 2.5rem;
        }

        .card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.5rem;
        }

        .hero-card {
            background: var(--hero-grad);
            border: 1px solid #1e3a5f;
        }

        .muted {
            color: var(--text-muted);
        }

        code {
            background-color: var(--bg-subtle);
            border: 1px solid #2c3b52;
            padding: 0.15rem 0.45rem;
            border-radius: 5px;
            font-size: 0.85em;
            color: #bae6fd;
        }

        .alert-success {
            background-color: var(--success-bg);
            color: var(--success-text);
            border: 1px solid #065f46;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.92rem;
            font-weight: 500;
        }

        .alert-error {
            background-color: var(--danger-bg);
            color: var(--danger-text);
            border: 1px solid #7f1d1d;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.92rem;
        }

        .news-item {
            display: flex;
            gap: 1.25rem;
            align-items: flex-start;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            background-color: var(--bg-card-item);
            transition: border-color 0.18s ease, transform 0.18s ease;
        }

        .news-item:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .news-thumb {
            width: 240px;
            height: 142px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
            background-color: var(--bg-subtle);
            border: 1px solid #26354d;
        }

        .news-body {
            flex: 1;
            min-width: 230px;
        }

        .news-title {
            margin: 0 0 0.25rem;
            font-size: 1.22rem;
            line-height: 1.3;
            font-weight: 700;
        }

        .news-title a {
            color: var(--text-main);
        }

        .news-title a:hover {
            color: var(--accent);
            text-decoration: none;
        }

        .news-meta {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .news-excerpt {
            margin: 0;
            color: #cbd5e1;
            font-size: 0.94rem;
        }

        .read-more {
            display: inline-block;
            margin-top: 0.55rem;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1rem;
            margin: 1.25rem 0;
        }

        .stat-box {
            background: var(--hero-grad);
            border: 1px solid #1e3a5f;
            border-radius: 12px;
            padding: 1.15rem 1.25rem;
        }

        .stat-label {
            font-size: 0.82rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stat-value {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin-top: 0.2rem;
            line-height: 1.2;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border-radius: 8px;
            border: 1px solid #2c3b52;
            background-color: var(--bg-card-item);
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.94rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
        }

        textarea.form-control {
            min-height: 180px;
            resize: vertical;
        }

        .form-help {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .field-error {
            font-size: 0.82rem;
            color: var(--danger-text);
            margin-top: 0.35rem;
        }

        .action-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .pagination-wrap {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        .pagination-wrap nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrap svg {
            width: 1rem;
            height: 1rem;
            display: inline-block;
            vertical-align: middle;
        }

        .pagination-wrap .flex,
        .pagination-wrap div[class*="justify-between"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .pagination-wrap a,
        .pagination-wrap span[aria-current="page"] span,
        .pagination-wrap span[aria-disabled="true"] span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.1rem;
            height: 2.1rem;
            padding: 0 0.65rem;
            border-radius: 8px;
            font-size: 0.86rem;
            border: 1px solid #2c3b52;
            background-color: var(--bg-card-item);
            color: var(--text-main);
        }

        .pagination-wrap span[aria-current="page"] span {
            background: var(--btn-grad);
            border-color: var(--accent);
            color: #ffffff;
            font-weight: 700;
        }

        .pagination-wrap span[aria-disabled="true"] span {
            color: #64748b;
            opacity: 0.65;
        }

        .pagination-wrap a:hover {
            border-color: var(--accent);
            text-decoration: none;
        }

        .footer {
            background-color: var(--bg-surface);
            border-top: 1px solid var(--border-color);
            padding: 1rem 0;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        @media (max-width: 640px) {
            .news-item {
                flex-direction: column;
            }
            .news-thumb {
                width: 100%;
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="container topbar-inner">
            <div class="nav-left">
                <a href="<?php echo e(route('home')); ?>" class="brand">Portal Berita</a>
                <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">Home</a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">Dashboard</a>
                    <?php if(\Illuminate\Support\Facades\Route::has('articles.index')): ?>
                        <a href="<?php echo e(route('articles.index')); ?>" class="nav-link <?php echo e(request()->routeIs('articles.*') ? 'active' : ''); ?>">Artikel</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="nav-right">
                <?php if(auth()->guard()->check()): ?>
                    <span class="user-badge">Hi, <strong><?php echo e(auth()->user()->name); ?></strong></span>
                    <?php if(\Illuminate\Support\Facades\Route::has('logout')): ?>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(\Illuminate\Support\Facades\Route::has('login')): ?>
                        <a href="<?php echo e(route('login')); ?>" class="nav-link <?php echo e(request()->routeIs('login') ? 'active' : ''); ?>">Login</a>
                    <?php endif; ?>
                    <?php if(\Illuminate\Support\Facades\Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-sm">Register</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if(session('status')): ?>
                <div class="alert-success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert-error">
                    <strong>Periksa kembali isian form:</strong>
                    <ul style="margin: 0.4rem 0 0 1.2rem; padding: 0;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            Portal Berita Sederhana &bull; Laravel Praktikum
        </div>
    </footer>
</body>
</html><?php /**PATH C:\Users\belajar-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>