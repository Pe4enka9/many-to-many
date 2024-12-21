@extends('layouts.main')
@section('title', 'Добавить товар')

@section('content')

    <h1 class="mb-3 text-primary">Добавить товар</h1>

    <div class="row">
        <div class="col-4">
            <form action="{{ route('products.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" name="name" id="name"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" name="price" id="price"
                           class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                           value="{{ old('price') }}">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Категории</label>
                    <select name="categories[]" id="categories" class="form-select" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" value="Добавить" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
