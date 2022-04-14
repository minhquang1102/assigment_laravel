{{-- Neu edit thi se co bien $product truyen vao --}}
@extends('layout.master')

@section('title', 'User page')

@section(
    'content-title',
    isset($user) ? 'User Edit' : 'User Create'
)

@section('content')
    <form
        action="{{isset($user)
            ? route('users.update', $user->id)
            : route('users.store')}}"
        class="form"
        method="POST"
    >
        {{-- Neu co du lieu $product thi se là update, ép kiểu method
            về PUT --}}
        @if (isset($product))
            @method('PUT')
        @endif
        {{-- Bat buoc trong form se phai co token bang @csrf --}}
        @csrf

        {{-- Sau khi validate co loi, redirect kem $errors
            Kiem tra neu co loi bang ->any()
            Lay ra danh sach loi ->all() va foreach de hien thi
        --}}
        @if ($errors->any())
            <ul class="text-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input
                name="name"
                class="form-control"
                id="name"
                value="{{isset($user) ? $user->name : ''}}"
            />
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input
                name="date"
                class="form-control"
                id="date"
                value="{{isset($user) ? $user->date : ''}}"
            />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input
                name="email"
                class="form-control"
                id="email"
                value="{{isset($user) ? $user->email : ''}}"
            />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input
                name="password"
                class="form-control"
                id="password"
                value="{{isset($user) ? $user->password : ''}}"
            />
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('users.index')}}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>

@endsection