<ul
    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    @php unset($list_comment['employee_id']); @endphp
    @foreach ($list_comment as $k => $v)
        <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
            <div for="{{ $k }}" class="font-semibold block text-sm text-gray-900 dark:text-white">
                {{ $v }}</div>
            <p id="{{ $k }}" class="text-lg text-gray-500">
                {{ $previous_works->{$k} ?? null }}
            </p>
        </li>
    @endforeach
</ul>
