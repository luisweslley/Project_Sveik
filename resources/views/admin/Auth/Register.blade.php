@extends('layouts.auth')

@section('content')
@component('components.Auth.register')
@slot('url', url('admin/register'))
@slot('auth', 'admin')
@slot('estados', $estados)
@endcomponent

@endsection
