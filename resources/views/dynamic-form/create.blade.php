<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Dynamic Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-5">
                    
                    <form method="POST" action="{{ route('dynamic-form.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="form_name" :value="__('Form Name')" />
                            <x-text-input wire:model="form_name" id="form_name" name="form_name" type="text" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('form_name')" />
                        </div>

                        <div id="dynamicFields">
                            <div class="flex flex-wrap items-center gap-4">
                                <div class="w-1/3">
                                    <x-input-label for="label" :value="__('Label')" />
                                    <x-text-input wire:model="label" name="label[]" type="text" class="mt-1 block w-full" />
                                </div>
                                <div class="w-1/3">
                                    <x-input-label for="field" :value="__('HTML Field')" />
                                    <x-text-input wire:model="field" name="field[]" type="text" class="mt-1 block w-full" />
                                </div>
                                <div class="w-1/3">
                                    <x-input-label for="comment" :value="__('Comment')" />
                                    <x-text-input wire:model="comment" name="comment[]" type="text" class="mt-1 block w-full" />
                                </div>
                                <button type="button" onclick="addFields()" class="px-2 py-1 bg-green-500 text-white rounded-md">+</button>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function addFields() {
        var dynamicFields = document.getElementById('dynamicFields');
        var newFields = document.createElement('div');
        newFields.innerHTML = `
            <div class="flex flex-wrap items-center gap-4">
                <div class="w-1/3">
                    <x-input-label for="label" :value="__('Label')" />
                    <x-text-input name="label[]" type="text" class="mt-1 block w-full" />
                </div>
                <div class="w-1/3">
                    <x-input-label for="field" :value="__('HTML Field')" />
                    <x-text-input name="field[]" type="text" class="mt-1 block w-full" />
                </div>
                <div class="w-1/3">
                    <x-input-label for="comment" :value="__('Comment')" />
                    <x-text-input name="comment[]" type="text" class="mt-1 block w-full" />
                </div>
                <button type="button" onclick="removeFields(this)" class="px-2 py-1 bg-red-500 text-white rounded-md">-</button>
            </div>
        `;
        dynamicFields.appendChild(newFields);
    }

    function removeFields(button) {
        button.parentNode.parentNode.removeChild(button.parentNode);
    }
</script>
