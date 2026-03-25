@extends('layouts.app')

@section('title', 'CRM - Novo Usuário')

@section('content')
    <div class="w-full max-w-lg mx-auto bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
        <h2 class="text-3xl font-extrabold text-center text-white mb-10">Cadastrar Novo Usuário</h2>

        {{-- Mensagens --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-100 px-5 py-3 rounded-xl mb-6 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="text-red-400 mb-4 bg-red-900/20 p-4 rounded-xl border border-red-800">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Nome</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 placeholder-gray-500">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 placeholder-gray-500">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Perfil</label>
                <select name="role_id" required
                        class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm">
                    <option value="" class="text-gray-500">Selecione o perfil</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-900/20 transition cursor-pointer transform hover:scale-[1.01]">
                Cadastrar Usuário
            </button>
        </form>
    </div>
@endsection
