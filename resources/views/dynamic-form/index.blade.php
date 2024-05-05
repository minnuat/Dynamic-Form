<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Forms') }}
            </h2>
            <!-- <a href="{{ route('dynamic-form.create') }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-500">Create Form</a> -->
        
            <x-primary-button>                <a href="{{ route('dynamic-form.create') }}" class="text-white">Create Form</a>
</x-primary-button>
            
           
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-5">
                    <h1>Forms fefe</h1>
                    <ul>
                        @foreach ($forms as $form)
                            <li><a href="{{ route('forms.show', $form->id) }}">{{ $form->form_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
