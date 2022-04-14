{{-- Home se ke thua view master --}}
@extends('layout.master')

{{-- section se thay doi
    phan yield trong master
    voi ten tuong ung --}}
@section('title', 'Product page')

@section('content-title', 'User page')

@section('content')
    <div>
        <a href="{{route('users.create')}}">
            <button class="btn btn-primary">Create</button>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->date }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>
                        <a
                            href="{{route('users.edit', $user->id)}}"
                            class="btn btn-warning"
                        >Edit</a>

                        @if (auth()->user()->id !== $user->id)
                        <form
                            action="{{route('users.delete', $user->id)}}"
                            method="POST"
                        >
                            @method('DELETE')
                            {{-- <input type="text" name="_method" value="DELETE"> --}}
                            @csrf
                            {{-- <input type="text" name="csrf_token" value="asdadasd"> --}}
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection