@extends('layouts.app')

@section('title','status')

@section('content')

<h3>{{ $relation_info['status'] }}</h3>

<ul>
    @foreach ($relation_info['users'] as $relation_user)
        <li>
            <ul>
                <li>
                    <a href="/users/show?id={{ $relation_user->id }}">
                        {{ $relation_user->name }}
                    </a>
                </li>
            </ul>
        </li>
    @endforeach
</ul>
<br>
<a href="/">戻る</a>

@endsection
