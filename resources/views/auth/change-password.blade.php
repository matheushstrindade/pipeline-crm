@extends('layouts.app')

@section('title', 'CRM - Alterar Senha')

@section('content')
    <div class="w-full max-w-lg mx-auto bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
        <h2 class="text-3xl font-extrabold text-center text-white mb-10">Alterar Senha</h2>

        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.change.password.update') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Nova Senha</label>
                <input type="password" name="password" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3">
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Confirme a Nova Senha</label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3">
            </div>

            <button type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg transition">
                Alterar Senha
            </button>
        </form>
    </div>
@endsection
