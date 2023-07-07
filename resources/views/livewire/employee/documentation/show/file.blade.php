<div class="flex justify-center">
    <img wire:click="showFile({{$documentation->id}})" src="{{ asset($documentation->file_url) ?? null }}" class="border rounded-sm min-w-full" alt="...">
</div>
