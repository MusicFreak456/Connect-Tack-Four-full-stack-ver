@extends('layouts.app')

@section('content')
    <div class="container">
        <App user='{{$user}}'></App>
    </div>
@endsection
