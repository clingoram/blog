{{-- 網站設定 --}}
@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    @if(count($service) > 0)
        @foreach ($service as $item)
            <p> {{ $item }}</p>
        @endforeach
    @endif
@endsection