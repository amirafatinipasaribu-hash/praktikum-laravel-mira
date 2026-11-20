@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $currentUser = $user ?? auth()->user();
    $totalAll = $totalArticles ?? \App\Models\Article::count();
    $totalMine = $myArticlesCount ?? ($currentUser ? \App\Models\Article::where('user_id', $currentUser->id)->count() : 0);
    $mineList = $recentArticles ?? ($currentUser ? \App\Models\Article::where('user_id', $currentUser->id)->latest()->take(5)->get() : collect());
@endphp

<section class="card hero-card">
    <h1 style="margin: 0 0 0.35rem; font-size: 1.55rem;">Dashboard Penulis</h1>
    <p class="muted" style="margin: 0;">
        Selamat datang kembali, <strong style="color: var(--text-main);">{{ optional($currentUser)->name ?? 'Pengguna' }}</strong>. Pantau ringkasan artikel dan kelola kontenmu di sini.
    </p>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-label">Total Artikel</div>
            <div class="stat-value">{{ $totalAll }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Artikel Kamu</div>
            <div class="stat-value">{{ $totalMine }}</div>
        </div>
    </div>

    <div class="action-row">
        @if (\Illuminate\Support\Facades\Route::has('articles.create'))
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Artikel Baru</a>
        @endif
        @if (\Illuminate\Support\Facades\Route::has('articles.index'))
            <a href="{{ route('articles.index') }}" class="btn btn-outline">Kelola Semua Artikel</a>
        @endif
    </div>
</section>

<section class="card" style="margin-top: 1.25rem;">
    <h2 style="margin: 0 0 0.9rem; font-size: 1.15rem;">Artikel Terakhir Kamu</h2>

    @if ($mineList->isNotEmpty())
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
            @foreach ($mineList as $item)
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.85rem 1rem; border-radius: 10px; background: var(--bg-card-item); border: 1px solid var(--border-color); flex-wrap: wrap;">
                    <div>
                        <div style="font-weight: 600;">
                            @if (\Illuminate\Support\Facades\Route::has('articles.show'))
                                <a href="{{ route('articles.show', $item) }}">{{ $item->title }}</a>
                            @else
                                {{ $item->title }}
                            @endif
                        </div>
                        <div class="muted" style="font-size: 0.8rem;">
                            {{ optional($item->created_at)->format('d M Y') ?? now()->format('d M Y') }}
                        </div>
                    </div>

                    <div class="action-row">
                        @if (\Illuminate\Support\Facades\Route::has('articles.edit'))
                            <a href="{{ route('articles.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="muted" style="margin: 0;">Kamu belum menulis artikel. Klik <strong>+ Tulis Artikel Baru</strong> untuk memulai.</p>
    @endif
</section>
@endsection