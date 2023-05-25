{{-- <div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-center text-xl text-gray-400 font-semibold mb-2">{{$title ?? null}}</h3>
        <div class="text-blue-400 text-5xl font-medium block text-center p-4">
            <span class="rounded-full border p-2 m-4 w-16 h-16">{{$count ?? null}}</span>
        </div>
        <p class="text-sm text-gray-400">{{$description ?? null}}</p>
        <div class="w-full bg-gray-200 rounded-full mt-2">
            <div class="bg-green-500 h-1 rounded-full sm:w-3/4 md:w-1/2 lg:w-1/4" style="width: {{$porc ?? null}}%;"></div>
        </div>
    </div>

</div> --}}

<div class="bg-white p-4 rounded-lg shadow">
    <h3 class="text-center text-xl text-gray-400 font-semibold mb-2">
        {{$title ?? null}}
    </h3>
    <div class="text-blue-400 text-5xl font-medium block text-center p-4">
        <span class="rounded-full border p-2 m-4 w-16 h-16">
            {{$count ?? null}}
        </span>
    </div>
    <p class="text-sm text-gray-400">
        {{$description ?? null}}
    </p>
    <div class="w-full bg-gray-200 rounded-full mt-2">
        <div class="bg-green-500 h-1 rounded-full sm:w-3/4 md:w-1/2 lg:w-1/4" style="width: {{$porc ?? null}}%;"></div>
    </div>
</div>


