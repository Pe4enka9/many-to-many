@extends('layouts.main')
@section('title', 'Товары')

@section('content')

    <a href="{{ route('index') }}" class="btn btn-outline-secondary">Назад</a>
    <h1 class="my-3 text-primary">Товары</h1>
    <a href="{{ route('products.create') }}" class="mb-3 btn btn-primary">Добавить</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Slug</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->slug }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Изменить</a>
                </td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Удалить" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
