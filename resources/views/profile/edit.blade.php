@extends('layouts.LOUser.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @if (auth()->user()->involvement == 'uploader')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('profile.IDupdate') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <x-input-label for="id_img" :value="__('Add ID Image')" class="text-black dark:text-black" />
                        <input type="file" name="id_img" id="id_img" class="mt-1 block w-full" required accept=".jpg, .jpeg, .png" onchange="previewImage()">
                        @if (auth()->user()->id_img)
                            <img id="frame" src="{{ asset('storage/' . auth()->user()->id_img) }}" class="mt-2" />
                        @else
                            <img id="frame" src="" class="mt-2" />
                        @endif
                        <x-input-error :messages="$errors->get('id_img')" class="mt-2" />
                        <x-primary-button class="mt-4 bg-black text-black">
                            {{ __('Save') }}
                        </x-primary-button>
                    </form>
                    <script>
                        function previewImage() {
                            const inputElement = document.getElementById('id_img');
                            const preview = document.getElementById('frame');
                            const file = inputElement.files[0];
                            const reader = new FileReader();

                            reader.onloadend = function() {
                                preview.src = reader.result;
                            }

                            if (file) {
                                reader.readAsDataURL(file);
                            } else {
                                preview.src = "";
                            }
                        }
                    </script>
                </div>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


        </div>
    </div>
    @endsection

