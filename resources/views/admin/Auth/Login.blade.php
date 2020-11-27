@extends('layouts.auth')

@section('content')
@component('components.Auth.login')
@slot('url', url('admin/login'))
@slot('auth', 'admin')
@endcomponent

@endsection
