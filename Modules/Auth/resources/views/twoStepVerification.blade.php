@extends('auth::layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 space-y-6">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                İki Adımlı Doğrulama
            </h2>

            <form action="{{ route('auth.verifyTwoStepVerificationCode') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Doğrulama kodunu giriniz
                    </label>
                    <input type="text" name="code" id="code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium
                    rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Onayla
                </button>
            </form>

            <div class="text-center">
                <button id="btnSendCode"
                    class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                    Kod Gönder
                </button>
            </div>
        </div>
    </div>
@endsection

@push('javascripts')
    <script>
        $('#btnSendCode').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('auth.sendTwoStepVerificationCode') }}",
                success: function (response) {
                    toastr.success(response.success);
                },
                error: function (xhr) {
                    const errorMsg = xhr.responseJSON?.error || 'Something went wrong.';
                    toastr.error(errorMsg);
                }
            });
        });
    </script>
@endpush
