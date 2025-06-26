@extends('plant::layouts.master')

@section('content')
    @can('can_create_data')
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <form action="{{ route('plant.plant-status.index') }}" method="GET" class="flex w-full max-w-sm mx-auto sm:mx-0">
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
                        placeholder="Search..." />
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
            <button data-modal-target="create-plant-status-modal" data-modal-toggle="create-plant-status-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Create Plant Status
            </button>
        </div>

        <!-- Main modal -->
        <div id="create-plant-status-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Create Plant Status
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="create-plant-status-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('plant.plant-status.store') }}" method="POST" class="p-4 md:p-5">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="accesion_notebook_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plant</label>
                                <select id="accesion_notebook_id" name="accesion_notebook_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected disabled>Select Plant</option>
                                    @foreach ($accesionNotebooks as $plant)
                                        <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                                    @endforeach
                                </select>
                                @error('accesion_notebook_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="observation_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observation
                                    Date</label>
                                <input type="date" id="observation_date" name="observation_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @error('observation_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="garden_location_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Garden
                                    Location</label>
                                <select id="garden_location_id" name="garden_location_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected disabled>Select Garden Location</option>
                                    @foreach ($gardenLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->code }}</option>
                                    @endforeach
                                </select>
                                @error('garden_location_id')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="plant_status"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plant
                                    Status</label>
                                <select id="plant_status" name="plant_status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected disabled>Select Plant Status</option>
                                    <option value="1">Mükemmel</option>
                                    <option value="2">İyi</option>
                                    <option value="3">Orta</option>
                                    <option value="4">Kötü</option>
                                </select>
                                @error('plant_status')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="vegetation_status"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vegetation
                                    Status</label>
                                <input type="text" name="vegetation_status" id="vegetation_status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Material name" required="">
                                @error('vegetation_status')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="observation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observation</label>
                                <textarea id="observation" rows="4" name="observation"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write product description here"></textarea>
                                @error('observation')
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
                            Add new plant status
                        </button>
                    </form>
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
                        Accesion Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Plant Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Observation Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Garden Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Garden Location Code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Plant Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vegetation Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Observation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plantStatuses as $status)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $status->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $status->accesionNotebook->accesion_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $status->accesionNotebook->plant_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $status->observation_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $status->gardeLocation->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $status->gardeLocation->code }}
                        </td>
                        <td class="px-6 py-4">
                            {{ match ($status->plant_status) {
                                '1' => 'Mükemmel',
                                '2' => 'İyi',
                                '3' => 'Orta',
                                '4' => 'Kötü',
                                default => '-',
                            } }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $status->vegetation_status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $status->observation }}
                        </td>
                        <td class="flex items-center px-6 py-4">
                            @can('can_update_data')
                                {{-- edit product material --}}
                                <a href="#" data-modal-target="edit-plant-status-modal-{{ $status->id }}"
                                    data-modal-toggle="edit-plant-status-modal-{{ $status->id }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                                <div id="edit-plant-status-modal-{{ $status->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Create Plant Status
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="edit-plant-status-modal-{{ $status->id }}">
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
                                            <form action="{{ route('plant.plant-status.update', ['id' => $status->id]) }}"
                                                method="POST" class="p-4 md:p-5">
                                                @csrf
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="accesion_notebook_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plant</label>
                                                        <select id="accesion_notebook_id" name="accesion_notebook_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected disabled>Select Plant</option>
                                                            @foreach ($accesionNotebooks as $plant)
                                                                <option value="{{ $plant->id }}"
                                                                    @if ($plant->id == $status->accesion_notebook_id) selected @endif>
                                                                    {{ $plant->plant_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('accesion_notebook_id')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="observation_date"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observation
                                                            Date</label>
                                                        <input type="date" id="observation_date" name="observation_date"
                                                            value="{{ $status->observation_date }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        @error('observation_date')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="garden_location_id"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Garden
                                                            Location</label>
                                                        <select id="garden_location_id" name="garden_location_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected disabled>Select Garden Location</option>
                                                            @foreach ($gardenLocations as $location)
                                                                <option value="{{ $location->id }}"
                                                                    @if ($location->id == $status->garden_location_id) selected @endif>
                                                                    {{ $location->code }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('garden_location_id')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="plant_status"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plant
                                                            Status</label>
                                                        <select id="plant_status" name="plant_status"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected disabled>Select Plant Status</option>
                                                            <option value="1"
                                                                @if ($status->plant_status == 1) selected @endif>
                                                                Mükemmel
                                                            </option>
                                                            <option value="2"
                                                                @if ($status->plant_status == 2) selected @endif>
                                                                İyi
                                                            </option>
                                                            <option value="3"
                                                                @if ($status->plant_status == 3) selected @endif>
                                                                Orta
                                                            </option>
                                                            <option value="4"
                                                                @if ($status->plant_status == 4) selected @endif>
                                                                Kötü
                                                            </option>
                                                        </select>
                                                        @error('plant_status')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2 sm:col-span-1">
                                                        <label for="vegetation_status"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vegetation
                                                            Status</label>
                                                        <input type="text" name="vegetation_status" id="vegetation_status"
                                                            value="{{ $status->vegetation_status }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Material name" required="">
                                                        @error('vegetation_status')
                                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="observation"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observation</label>
                                                        <textarea id="observation" rows="4" name="observation"
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Write product description here">{{ $status->observation }}</textarea>
                                                        @error('observation')
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
                                                    Add new plant status
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @can('can_delete_data')
                                {{-- delete product material --}}
                                <a href="#" data-modal-target="delete-plant-status-modal-{{ $status->id }}"
                                    data-modal-toggle="delete-plant-status-modal-{{ $status->id }}"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>

                                <div id="delete-plant-status-modal-{{ $status->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="delete-plant-status-modal-{{ $status->id }}">
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
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you
                                                    sure you want to delete this plant material?</h3>
                                                <form id="delete-plant-status-form-{{ $status->id }}"
                                                    action="{{ route('plant.plant-status.destroy', ['id' => $status->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                </form>
                                                <button form="delete-plant-status-form-{{ $status->id }}" type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                                <button data-modal-hide="delete-plant-status-modal-{{ $status->id }}"
                                                    type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                                    cancel</button>
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
        {{ $plantStatuses->links('vendor.pagination.tailwind') }}
    </div>
@endsection
