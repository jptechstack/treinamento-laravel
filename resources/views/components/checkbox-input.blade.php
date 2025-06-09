@props([
    'id' => null,
    'name',
    'value' => '',
    'label' => '',
    'checked' => false,
])

@php
    $inputId = $id ?? $name . '-' . $value;
@endphp

<div class="flex items-center mb-4">
    <input
        id="{{ $inputId }}"
        type="checkbox"
        name="{{ $name }}[]"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded-md focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
    >
    <label for="{{ $inputId }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
        {{ $label }}
    </label>
</div>
