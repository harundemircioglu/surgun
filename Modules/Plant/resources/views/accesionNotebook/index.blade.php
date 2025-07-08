@extends('plant::layouts.master')

@section('content')
    @can('can_create_data')
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex justify-between sm:justify-between gap-2">
                <button data-modal-target="data-excel-export-modal" data-modal-toggle="data-excel-export-modal"
                    class="cursor-pointer" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16" />
                    </svg>
                </button>

                <button data-modal-target="data-excel-import-modal" data-modal-toggle="data-excel-import-modal"
                    class="cursor-pointer" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 20V8m0 0l-4 4m4-4l4 4M20 4H4" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('plant.accession-notebook.index') }}" method="GET"
                class="flex w-full max-w-sm mx-auto sm:mx-0">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value="{{ request()->search ?? '' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ara..." />
                </div>
                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>

            <!-- Modal toggle -->
            <button data-modal-target="create-data-modal" data-modal-toggle="create-data-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Ekle
            </button>
        </div>

        <!-- Main modal -->
        <div id="create-data-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Ekle
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="create-data-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('plant.accession-notebook.store') }}" method="POST" class="p-4 md:p-5">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="plant_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bitki Adı</label>
                                <input type="text" name="plant_name" id="plant_name" value="{{ old('plant_name') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Bitki Adı" required="">
                                @error('plant_name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="plant_material_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Materyal</label>
                                <select id="plant_material_id" name="plant_material_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected disabled>Seçiniz</option>
                                    @foreach ($plantMaterials as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                    @endforeach
                                </select>
                                @error('plant_material_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="plant_origin_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Köken</label>
                                <select id="plant_origin_id" name="plant_origin_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected disabled>Seçiniz</option>
                                    @foreach ($plantOrigins as $origin)
                                        <option value="{{ $origin->id }}">{{ $origin->name }}</option>
                                    @endforeach
                                </select>
                                @error('plant_origin_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="location"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasyon</label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Lokasyon" required="">
                                @error('location')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="coordinate"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Koordinat</label>
                                <input type="text" name="coordinate" id="coordinate" value="{{ old('coordinate') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Koordinat" required="">
                                @error('coordinate')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="convening_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Toplanma
                                    Tarihi</label>
                                <input type="date" id="convening_date" name="convening_date"
                                    value="{{ old('convening_date') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('convening_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Ekle
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="data-excel-export-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="data-excel-export-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <form id="export-form" action="{{ route('plant.accession-notebook.export') }}" method="POST">
                            @csrf
                            <input type="hidden" name="search" value="{{ request()->search ?? null }}">
                        </form>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Dışa aktarma işlemini onaylıyor
                            musunuz?</h3>
                        <button type="submit" form="export-form"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Evet</button>
                        <button data-modal-hide="data-excel-export-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Hayır</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="data-excel-import-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="data-excel-import-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <form id="import-form" action="{{ route('plant.accession-notebook.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-span-2">
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Dosyayı seçin</span> ya da sürükleyip bırakın</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">XLSX dosya formatı kabul
                                                edilmektedir
                                            </p>
                                        </div>
                                        <input id="dropzone-file" type="file" class="hidden" name="file"
                                            accept=".xlsx" required />
                                    </label>
                                </div>
                            </div>
                        </form>
                        <h3 class="mb-5 mt-5 text-lg font-normal text-gray-500 dark:text-gray-400">İçe aktarma işlemini
                            onaylıyor
                            musunuz?</h3>
                        <button type="submit" form="import-form"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Evet</button>
                        <button data-modal-hide="data-excel-import-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Hayır</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        AKSESYON NUMARASI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        BİTKİ ADI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        MATERYAL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        KÖKEN
                    </th>
                    <th scope="col" class="px-6 py-3">
                        LOKASYON
                    </th>
                    <th scope="col" class="px-6 py-3">
                        KOORDİNAT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TOPLANMA TARİHİ
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TOPLAYICI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        İŞLEM
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesionNotebooks as $notebook)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $notebook->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $notebook->accesion_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->plant_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->material->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->origin->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->location }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->coordinate }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->convening_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notebook->user->name }}
                        </td>
                        <td class="flex items-center px-6 py-4">
                            @can('can_update_data')
                                {{-- edit product material --}}
                                <a href="#" data-modal-target="edit-data-modal-{{ $notebook->id }}"
                                    data-modal-toggle="edit-data-modal-{{ $notebook->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Düzenle</a>

                                <div id="edit-data-modal-{{ $notebook->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Düzenle
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="edit-data-modal-{{ $notebook->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form
                                                action="{{ route('plant.accession-notebook.update', ['id' => $notebook->id]) }}"
                                                method="POST" class="p-4 md:p-5">
                                                @csrf
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="plant_name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bitki
                                                            Adı</label>
                                                        <input type="text" name="plant_name" id="plant_name"
                                                            value="{{ $notebook->plant_name }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Bitki Adı" required="">
                                                        @error('plant_name')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="plant_material_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Materyal</label>
                                                        <select id="plant_material_id" name="plant_material_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach ($plantMaterials as $material)
                                                                <option value="{{ $material->id }}"
                                                                    @if ($notebook->plant_material_id == $material->id) selected @endif>
                                                                    {{ $material->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('plant_material_id')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="plant_origin_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Köken</label>
                                                        <select id="plant_origin_id" name="plant_origin_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected disabled>Seçiniz</option>
                                                            @foreach ($plantOrigins as $origin)
                                                                <option value="{{ $origin->id }}"
                                                                    @if ($notebook->plant_origin_id == $origin->id) selected @endif>
                                                                    {{ $origin->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('plant_origin_id')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="location"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasyon</label>
                                                        <input type="text" name="location" id="location"
                                                            value="{{ $notebook->location }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Lokasyon" required="">
                                                        @error('location')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="coordinate"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Koordinat</label>
                                                        <input type="text" name="coordinate" id="coordinate"
                                                            value="{{ $notebook->coordinate }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Koordinat" required="">
                                                        @error('coordinate')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="convening_date"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Toplanma
                                                            Tarihi</label>
                                                        <input type="date" id="convening_date" name="convening_date"
                                                            value="{{ $notebook->convening_date }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        @error('convening_date')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm2 2h8v4H6V4zm0 6h8v6H6v-6zm2-4h4v2H8V6z"
                                                            clip-rule="evenodd">
                                                        </path>
                                                    </svg>
                                                    Kaydet
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('can_delete_data')
                                {{-- delete product material --}}
                                <a href="#" data-modal-target="delete-data-modal-{{ $notebook->id }}"
                                    data-modal-toggle="delete-data-modal-{{ $notebook->id }}"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Sil</a>

                                <div id="delete-data-modal-{{ $notebook->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="delete-data-modal-{{ $notebook->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Silme
                                                    işlemini onaylıyor musunuz?</h3>
                                                <form id="delete-data-form-{{ $notebook->id }}"
                                                    action="{{ route('plant.accession-notebook.destroy', ['id' => $notebook->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                </form>
                                                <button form="delete-data-form-{{ $notebook->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Evet
                                                </button>
                                                <button data-modal-hide="delete-data-modal-{{ $notebook->id }}"
                                                    type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Hayır</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $accesionNotebooks->links('vendor.pagination.tailwind') }}
    </div>
@endsection
