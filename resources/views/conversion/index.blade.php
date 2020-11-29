@extends('layouts.app')

@section('title', 'Roman Numeral Converter')

@section('content')
    <h1>Roman Numeral Converter</h1>

    <p>Please enter a number to convert</p>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/">
        @csrf
        <input type="number" name="integer">
        <input type="submit" value="Submit">
    </form>
@endsection
