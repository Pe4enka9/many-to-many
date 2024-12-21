@extends('layouts.main')
@section('title', 'Категории')

@section('content')

    <a href="{{ route('index') }}" class="btn btn-outline-secondary">Назад</a>
    <h1 class="my-3 text-primary">Категории</h1>
    <a href="{{ route('categories.create') }}" class="mb-3 btn btn-primary">Добавить</a>

    @if($errors->has('msg'))
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Изменить</a>
                </td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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
