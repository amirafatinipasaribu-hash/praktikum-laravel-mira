@extends('layouts.app')

@section('title', 'Tulis Artikel')

@section('content')
<section class="card">
    <h1 style="margin: 0 0 0.35rem; font-size: 1.5rem;">Tulis Artikel Baru</h1>
    <p class="muted" style="margin: 0 0 1.25rem; font-size: 0.9rem;">Lengkapi judul, isi berita, dan URL gambar (opsional).</p>

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">Judul Artikel</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required>
            @error('title')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image" class="form-label">URL Gambar (Opsional)</label>
            <input type="text" id="image" name="image" value="{{ old('image') }}" class="form-control" placeholder="https://contoh.com/gambar.jpg">
            <div class="form-help">Biarkan kosong untuk menggunakan gambar placeholder otomatis.</div>
            @error('image')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="body" class="form-label">Isi Artikel</label>
            <textarea id="body" name="body" class="form-control" required>{{ old('body') }}</textarea>
            @error('body')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="action-row">
            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
            <a href="{{ route('articles.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</section>
@endsection