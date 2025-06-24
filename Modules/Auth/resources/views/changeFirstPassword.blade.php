@extends('auth::layouts.master')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">
                Change Temporary Password
            </h2>

            <form action="{{ route('auth.changeFirstPassword') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        New Password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save
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

            <form action="{{ route('auth.logout') }}" method="POST" class="mt-4 text-center">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:underline dark:text-red-400">
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection
