<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">
</head>

<body>
    @extends('layouts.LOAdmin.app')
    @section('content')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>

        <div style="margin-top: 2rem;" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                @include('profile.partials.update-profile-information-form')

        </div>
        <hr>
        {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                @include('profile.partials.valid-identity')

        </div> --}}
        <hr>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                @include('profile.partials.update-password-form')

        </div>
    </body>

    </html>
@endsection
