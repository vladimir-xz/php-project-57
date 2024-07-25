<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Create label') }}</h1>
    </x-slot>

    {{  html()->form('POST', route('labels.store'))->class('flex flex-col w-50')->open() }}
        @include('labels.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    {{  html()->form()->close() }}
</x-app-layout>