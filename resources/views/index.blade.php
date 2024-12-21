@extends('layouts.main')
@section('title', 'Главная')

@section('content')

    <h1 class="mb-3 text-primary">Главная</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Категории</a>
    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Товары</a>

@endsection
