@extends('layouts.app')

@section('title', 'Daftar Artikel')

@section('content')
<section class="card">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
        <div>
            <h1 style="margin: 0 0 0.25rem; font-size: 1.5rem;">Daftar Artikel</h1>
            <p class="muted" style="margin: 0; font-size: 0.9rem;">Seluruh arsip berita yang tersimpan di portal.</p>
        </div>

        @auth
            @if (\Illuminate\Support\Facades\Route::has('articles.create'))
                <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tulis Artikel</a>
            @endif
        @endauth
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
                    $isOwner = auth()->check() && (int) $article->user_id === (int) auth()->id();
                @endphp

                <article class="news-item">
                    <img src="{{ $gambarTampil }}"
                         alt="Gambar {{ $article->title }}"
                         class="news-thumb">

                    <div class="news-body">
                        <h2 class="news-title">
                            @if (\Illuminate\Support\Facades\Route::has('articles.show'))
                                <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                            @else
                                {{ $article->title }}
                            @endif
                        </h2>

                        <div class="news-meta">
                            Dipublikasikan pada {{ $tanggalTampil }} oleh {{ $penulisTampil }}
                        </div>

                        <p class="news-excerpt">
                            {{ \Illuminate\Support\Str::limit($isiTampil, 150) }}
                        </p>

                        <div class="action-row" style="margin-top: 0.7rem;">
                            @if (\Illuminate\Support\Facades\Route::has('articles.show'))
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline btn-sm">Baca</a>
                            @endif

                            @if ($isOwner)
                                @if (\Illuminate\Support\Facades\Route::has('articles.edit'))
                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline btn-sm">Edit</a>
                                @endif
                                @if (\Illuminate\Support\Facades\Route::has('articles.destroy'))
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger-outline btn-sm">Hapus</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        @if (method_exists($articles, 'links'))
            <div class="pagination-wrap">
                {{ $articles->links() }}
            </div>
        @endif
    @else
        <p class="muted" style="margin: 0;">Belum ada artikel tersedia.</p>
    @endif
</section>
@endsection