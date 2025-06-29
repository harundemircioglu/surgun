@extends('dashboard::layouts.master')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @role(['super-admin'])
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.5 20a8.38 8.38 0 0113 0M12 12a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Kullanıcılar</p>
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $users }}</h5>
                <a href="{{ route('user.index') }}" class="inline-flex font-medium items-center text-blue-600 hover:underline">
                    Tümünü gör
                    <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                    </svg>
                </a>
            </div>
        @endrole

        @role(['super-admin', 'admin'])
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 22s8-4 8-10V5a4 4 0 00-8 0 4 4 0 00-8 0v7c0 6 8 10 8 10z" />
                </svg>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Bitki materyalleri</p>
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $materials }}</h5>
                <a href="{{ route('plant.material.index') }}"
                    class="inline-flex font-medium items-center text-blue-600 hover:underline">
                    Tümünü gör
                    <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                    </svg>
                </a>
            </div>
        @endrole

        @role(['super-admin', 'admin', 'guest'])
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V10z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22V12h6v10" />
                </svg>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Tohum bankası</p>
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $seedBanks }}</h5>
                <a href="{{ route('plant.seed-bank.index') }}"
                    class="inline-flex font-medium items-center text-blue-600 hover:underline">
                    Tümünü gör
                    <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                    </svg>
                </a>
            </div>
        @endrole

        @role(['super-admin', 'admin', 'guest'])
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-500 dark:text-gray-400 mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6a1 1 0 011-1h4a1 1 0 011 1v6m-6 0H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-4m-6 0v2a1 1 0 001 1h2a1 1 0 001-1v-2" />
                </svg>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Bitki durumları</p>
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $plantStatuses }}</h5>
                <a href="{{ route('plant.plant-status.index') }}"
                    class="inline-flex font-medium items-center text-blue-600 hover:underline">
                    Tümünü gör
                    <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                    </svg>
                </a>
            </div>
        @endrole
    </div>
@endsection
