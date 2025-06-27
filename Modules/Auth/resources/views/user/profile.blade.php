@extends('dashboard::layouts.master')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">
                Profil Bilgilerini Güncelle
            </h2>

            <form action="{{ route('user.profile.updateProfile') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Ad
                    </label>
                    <input type="text" name="name" id="name" required value="{{ $user->name }}"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="surname" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Soyad
                    </label>
                    <input type="text" name="surname" id="surname" value="{{ $user->surname }}"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('surname')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="text" name="email" id="email" required value="{{ $user->email }}"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Telefon
                    </label>
                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Kaydet
                </button>
            </form>
        </div>

        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">
                Şifreni Güncelle
            </h2>

            <form action="{{ route('user.profile.updatePassword') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="current_password" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Aktif Şifre
                    </label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Şifre
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Şifreyi Onayla
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Kaydet
                </button>
            </form>
        </div>

        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="inline-flex items-center me-5 cursor-pointer">
                <input id="two_step_verification_toggle" type="checkbox" class="sr-only peer"
                    @if ($user->two_step_verification) checked @endif>
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">İki Adımlı Doğrulama</span>
            </label>
        </div>
    </div>
@endsection

@push('javascripts')
    <script>
        $('#two_step_verification_toggle').on('change', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('user.profile.changeTwoStepVerificationStatus') }}",
                success: function(response) {
                    toastr.success(response.success);
                },
            });
        });
    </script>
@endpush
