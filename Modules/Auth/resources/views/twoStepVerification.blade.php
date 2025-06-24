@extends('auth::layouts.master')

@section('content')
    <form action="{{ route('auth.verifyTwoStepVerificationCode') }}" method="POST">
        @csrf
        <input type="text" name="code">
        @error('code')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <button>Verify</button>
    </form>

    <button id="btnSendCode">Send Code</button>
@endsection

@push('javascripts')
    <script>
        $('#btnSendCode').click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('auth.sendTwoStepVerificationCode') }}",
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });

        });
    </script>
@endpush
