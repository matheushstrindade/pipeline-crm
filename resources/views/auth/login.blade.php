@extends('layouts.app')

@section('title', 'CRM - Login')

@section('content')
    <div class="w-full max-w-lg bg-gray-800 rounded-3xl shadow-2xl p-8 sm:p-10 md:p-12 border border-gray-700 transform hover:shadow-3xl transition duration-500 ease-in-out">

        <h2 class="text-4xl font-extrabold text-center text-white mb-10 tracking-tight">
            Acesse sua conta
        </h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-900 text-green-100 rounded-xl border border-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-900 text-red-100 rounded-xl border border-red-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('auth.authenticate') }}" class="space-y-8 flex flex-col">
            @csrf

            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-gray-300">E-mail</label>
                <input type="email" name="email" id="email" required autofocus
                       placeholder="seu.email@empresa.com"
                       class="w-full bg-gray-900 border-2 border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:ring-1 focus:outline-none rounded-xl px-5 py-3 text-white transition duration-300 ease-in-out shadow-sm placeholder:text-gray-500">
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-semibold text-gray-300">Senha</label>
                <input type="password" name="password" id="password" required
                       placeholder="••••••••"
                       class="w-full bg-gray-900 border-2 border-gray-600 focus:border-orange-500 focus:ring-orange-500 focus:ring-1 focus:outline-none rounded-xl px-5 py-3 text-white transition duration-300 ease-in-out shadow-sm">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-400 hover:text-orange-500 transition cursor-pointer">
                    <input type="checkbox" name="remember" class="mr-2 rounded bg-gray-700 border-gray-600 text-orange-600 focus:ring-orange-500">
                    Lembrar-me
                </label>

                <a href="{{ route('auth.reset.password') }}" class="text-orange-500 font-medium hover:text-orange-400 hover:underline transition duration-300 ease-in-out">
                    Esqueci minha senha
                </a>
            </div>

            <button type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-900/20 transition duration-300 ease-in-out transform hover:scale-[1.01]">
                Entrar no Sistema
            </button>
        </form>
    </div>
@endsection
