@extends('dashboard::layouts.master')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        KULLANICI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        AKTİVİTE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        IP ADRES
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TARAYICI / CİHAZ BİLGİSİ
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TARİH
                    </th>
                    <th scope="col" class="px-6 py-3">
                        BAŞARI DURUMU
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $activity->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $activity->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($activity->activity_type == 'login')
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">Giriş</span>
                            @elseif($activity->activity_type == 'logout')
                                <span
                                    class="bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-pink-900 dark:text-pink-300">Çıkış</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Hata</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $activity->ip_address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $activity->user_agent }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $activity->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($activity->is_successful)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Başarılı</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Başarısız</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $activities->links('vendor.pagination.tailwind') }}
    </div>
@endsection
