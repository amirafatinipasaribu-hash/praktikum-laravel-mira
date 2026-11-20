@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<section class="card">
    <h1 style="margin: 0 0 0.35rem; font-size: 1.5rem;">Edit Artikel</h1>
    <p class="muted" style="margin: 0 0 1.25rem; font-size: 0.9rem;">Perubahan judul dan isi akan tersimpan tanpa mengubah alamat slug artikel.</p>

    <form action="{{ route('articles.update', $article) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title" class="form-label">Judul Artikel</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" class="form-control" required>
            @error('title')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image" class="form-label">URL Gambar (Opsional)</label>
            <input type="text" id="image" name="image" value="{{ old('image', $article->image) }}" class="form-control" placeholder="https://contoh.com/gambar.jpg">
            <div class="form-help">Kosongkan kolom ini lalu simpan jika ingin mengembalikan gambar ke placeholder.</div>
            @error('image')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="body" class="form-label">Isi Artikel</label>
            <textarea id="body" name="body" class="form-control" required>{{ old('body', $article->body) }}</textarea>
            @error('body')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="action-row">
            <button type="submit" class="btn btn-primary">Perbarui Artikel</button>
            <a href="{{ route('articles.show', $article) }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</section>
@endsection