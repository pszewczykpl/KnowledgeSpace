@extends('layouts.auth')

@section('desc')
<p class="mb-10 text-muted font-weight-bold">Jeśli już posiadasz konto w serwisie Baza Wiedzy - <a href="{{ route('login') }}">Zaloguj się</a>. Możesz również <a href="{{ route('home.index') }}">Wejść jako użytkownik niezalogowany</a>.</p>
<a href="{{ route('login') }}" class="btn btn-outline-primary btn-pill py-4 px-9 font-weight-bold mr-3">Zaloguj się</a>
<a href="{{ route('home.index') }}" class="btn btn-outline-primary btn-pill py-4 px-9 font-weight-bold">Wejdź bez logowania</a>
@stop

@section('content')
<div class="text-center mb-10">
	<h2 class="font-weight-bold">Zarejestruj się</h2>
	<p class="text-muted font-weight-bold">Stwórz własne konto w Bazie Wiedzy</p>
</div>
<form method="POST" action="{{ route('register') }}" class="form text-left">
    @csrf
    <div class="form-group py-2 m-0">
		<input class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('username') is-invalid @enderror" placeholder="Nazwa użytkownika" id="username" type="username" name="username" value="{{ old('username') }}" required autocomplete="username">
        @error('username')
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">{{ $message }}</div>
            </div>
        @enderror
    </div>
    <div class="form-group py-2 m-0 border-top m-0">
		<input class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('first_name') is-invalid @enderror" placeholder="Imię" id="first_name" type="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
        @error('first_name')
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">{{ $message }}</div>
            </div>
        @enderror
    </div>
    <div class="form-group py-2 m-0 border-top m-0">
		<input class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('last_name') is-invalid @enderror" placeholder="Nazwisko" id="last_name" type="last_name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
        @error('last_name')
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">{{ $message }}</div>
            </div>
        @enderror
    </div>
    <div class="form-group py-2 m-0 border-top m-0">
        <select class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('department_id') is-invalid @enderror" name="department_id" id="department_id" value="{{ old('department_id') }}">
            @foreach(App\Models\Department::all() as $department)
            <option value="{{ $department->id }}">{{ $department->code }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group py-2 m-0 border-top m-0">
		<input class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('email') is-invalid @enderror" placeholder="E-mail (firmowy)" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">{{ $message }}</div>
            </div>
        @enderror
    </div>
	<div class="form-group py-2 border-top m-0">
        <input class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('password') is-invalid @enderror" type="password" placeholder="Hasło" id="password" type="password" name="password" required autocomplete="new-password">
        @error('password')
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">{{ $message }}</div>
            </div>
        @enderror
    </div>
    <div class="form-group py-2 border-top m-0">
        <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Powtórz hasło" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
    </div>
	<div class="text-center mt-10">
		<button type="submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Zarejestruj</button>
	</div>
</form>
@stop