@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="{{ auth()->user()->username }}"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                        text-center"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-10">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png, .webp, .avif"
                    />
                </div>

                <fieldset class="mb-5 p-5 border-2 border-red-700 rounded">

                    <legend class="text-red-700 uppercase font-mono font-bold">danger zone</legend>

                    <div class="mb-5">
                        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                            Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="{{ auth()->user()->email }}"
                            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}"
                        />
                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                            text-center"> {{ $message }} </p>
                        @enderror
                    </div>
    
                    <div class="mb-5">
                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Debe contener al menos 6 caracteres"
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        />
                        @error('password')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                            text-center"> {{ $message }} </p>
                        @enderror
                    </div>
    
                    <div class="mb-5">
                        <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                            Confirmar Password
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Confirma tu Nuevo Password"
                            class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        />
                        @error('password_confirmation')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                            text-center"> {{ $message }} </p>
                        @enderror
                    </div>
                </fieldset>

                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection