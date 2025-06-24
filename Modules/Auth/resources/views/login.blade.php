@extends('auth::layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4">
        <form action="{{ route('auth.login') }}" method="POST"
            class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 space-y-6">
            @csrf

            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Login</h2>

            <div>
                <label for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="email" id="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="name@domain.com" required />
            </div>

            <div>
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required />
            </div>

            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Login
            </button>

            @if ($errors->any())
                <div class="space-y-2">
                    @foreach ($errors->all() as $error)
                        <div class="flex items-center p-3 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400 dark:border-red-800"
                            role="alert">
                            <svg class="w-4 h-4 me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-7-4a1 1 0 1 0-2 0v4a1 1 0 1 0 2 0V6Zm-1 8a1.25 1.25 0 1 0 0-2.5A1.25 1.25 0 0 0 10 14Z" />
                            </svg>
                            <span>{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
@endsection
