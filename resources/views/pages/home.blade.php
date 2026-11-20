@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="card hero-card">
    <h1 style="margin: 0 0 0.4rem; font-size: 1.65rem; letter-spacing: -0.02em;">Portal Berita Sederhana</h1>
    <p class="muted" style="margin: 0 0 0.85rem;">
        Selamat datang di portal berita sederhana berbasis Laravel. Berita di bawah ini diambil dari tabel <code>articles</code>.
    </p>

    @auth
        <div style="font-size: 0.9rem; color: var(--text-muted);">
            Kamu login sebagai <strong style="color: var(--text-main);">{{ auth()->user()->name }}</strong>.
            @if (\Illuminate\Support\Facades\Route::has('articles.index'))
                Kelola berita melalui menu <a href="{{ route('articles.index') }}">Artikel</a>.
            @endif
        </div>
    @else
        <div style="font-size: 0.9rem; color: var(--text-muted);">
            Silakan
            @if (\Illuminate\Support\Facades\Route::has('login'))
                <a href="{{ route('login') }}">Login</a>
            @endif
            @if (\Illuminate\Support\Facades\Route::has('login') && \Illuminate\Support\Facades\Route::has('register'))
                atau
            @endif
            @if (\Illuminate\Support\Facades\Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
            untuk menulis dan mengelola artikel.
        </div>
    @endauth
</section>

<section class="card" style="margin-top: 1.25rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; margin-bottom: 1.1rem; flex-wrap: wrap;">
        <h2 style="margin: 0; font-size: 1.2rem;">Berita Terbaru</h2>
        @if (\Illuminate\Support\Facades\Route::has('articles.index'))
            <a href="{{ route('articles.index') }}" style="font-size: 0.88rem; font-weight: 600;">Lihat semua artikel &rarr;</a>
        @endif
    </div>

    @if (isset($articles) && $articles->isNotEmpty())
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach ($articles as $article)
                @php
                    $tanggalTampil = optional($article->created_at)->format('d M Y') ?? now()->format('d M Y');
                    $penulisTampil = optional($article->user)->name ?? 'Praktikan';
                    $gambarTampil = $article->image_url
                        ?? ($article->image ?: 'https://picsum.photos/seed/' . urlencode($article->slug ?? $article->id ?? $loop->index) . '/800/450');
                    $isiTampil = $article->body ?? $article->content ?? '';
                @endphp

                <article class="news-item">
                    <img src="{{ $gambarTampil }}"
                         alt="Gambar {{ $article->title }}"
                         class="news-thumb">

                    <div class="news-body">
                        <h3 class="news-title">
                            @if (\Illuminate\Support\Facades\Route::has('articles.show'))
                                <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                            @else
                                {{ $article->title }}
                            @endif
                        </h3>

                        <div class="news-meta">
                            Dipublikasikan pada {{ $tanggalTampil }} oleh {{ $penulisTampil }}
                        </div>

                        <p class="news-excerpt">
                            {{ \Illuminate\Support\Str::limit($isiTampil, 165) }}
                        </p>

                        @if (\Illuminate\Support\Facades\Route::has('articles.show'))
                            <a href="{{ route('articles.show', $article) }}" class="read-more">Baca selengkapnya &rarr;</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="muted" style="margin: 0;">Belum ada artikel.</p>
    @endif
</section>
@endsection