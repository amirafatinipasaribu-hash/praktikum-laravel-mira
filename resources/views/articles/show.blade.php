@extends('layouts.app')

@section('title', $article->title ?? 'Detail Artikel')

@section('content')
@php
    $tanggalTampil = optional($article->created_at)->format('d M Y') ?? now()->format('d M Y');
    $penulisTampil = optional($article->user)->name ?? 'Praktikan';
    $gambarTampil = $article->image_url
        ?? ($article->image ?: 'https://picsum.photos/seed/' . urlencode($article->slug ?? $article->id ?? 'detail') . '/800/450');
    $isiTampil = $article->body ?? $article->content ?? '';
    $isOwner = auth()->check() && (int) $article->user_id === (int) auth()->id();
@endphp

<article class="card">
    <div style="margin-bottom: 1rem;">
        <a href="{{ url()->previous() }}" style="font-size: 0.88rem; font-weight: 600;">&larr; Kembali</a>
    </div>

    <h1 style="margin: 0 0 0.45rem; font-size: 1.75rem; line-height: 1.25;">{{ $article->title }}</h1>

    <div class="news-meta" style="margin-bottom: 1.25rem; font-size: 0.86rem;">
        Dipublikasikan pada {{ $tanggalTampil }} oleh <strong style="color: var(--text-main);">{{ $penulisTampil }}</strong>
    </div>

    <img src="{{ $gambarTampil }}"
         alt="Gambar {{ $article->title }}"
         style="width: 100%; max-height: 420px; object-fit: cover; border-radius: 10px; border: 1px solid #26354d; margin-bottom: 1.35rem;">

    <div style="color: #e2e8f0; font-size: 1rem; line-height: 1.75;">
        {!! nl2br(e($isiTampil)) !!}
    </div>

    @if ($isOwner)
        <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 1.5rem 0;">
        <div class="action-row">
            @if (\Illuminate\Support\Facades\Route::has('articles.edit'))
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline btn-sm">Edit Artikel</a>
            @endif
            @if (\Illuminate\Support\Facades\Route::has('articles.destroy'))
                <form action="{{ route('articles.destroy', $article) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-outline btn-sm">Hapus Artikel</button>
                </form>
            @endif
        </div>
    @endif
</article>
@endsection