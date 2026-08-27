@extends('layouts.app')

@section('content')
<h1>User Dashboard</h1>
<p>Halo {{ Auth::user()->name }}</p>
@endsection