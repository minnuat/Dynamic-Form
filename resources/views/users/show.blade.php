<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-5">
                    
                    <h1>{{ $form->form_name }}</h1>
                    <form action="{{ route('forms.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="formId" name="formId" value="{{$formId}}">
                        <ul>
                            @foreach ($form->fields as $field)
                                <li>
                                    <strong>{{ $field->label }}:</strong>
                                    @if ($field->field === 'select')
                                        <select name="{{ $field->label }}">
                                            <option value="option1">Option 1</option>
                                            <option value="option2">Option 2</option>
                                        </select>
                                        @elseif ($field->html_field === 'number')
                                        <input type="number" name="{{ $field->label }}" value="{{ $field->field }}">
                                    @else
                                        <input type="text" name="{{ $field->label }}" value="{{ $field->field }}">
                                    @endif
                                    <br>
                                    <em>{{ $field->comment }}</em>
                                </li>
                            @endforeach
                        </ul>
                        <x-primary-button>Submit</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

