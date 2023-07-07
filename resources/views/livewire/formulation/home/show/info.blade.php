<ul
    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    @foreach ($list_comment as $k => $v)
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
            <h6 for="{{ $k }}" class="font-semibold block text-sm text-gray-900 dark:text-white">
                {{ $v }}</h6>
            @if ($k == 'latex')
                <math-field read-only class="text-lg">
                    {{ $formulation->{$k} ?? 'null' }}
                </math-field>
            @else
                <p id="{{ $k }}" class="text-lg text-gray-500">
                    {{ $formulation->{$k} ?? null }}
                </p>
            @endif
        </li>
    @endforeach
</ul>
