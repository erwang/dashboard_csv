<x-card :title="$title" id="file" class="menu-panel">
    <x-form.form method="POST" action="{{route('settings')}}">
        <x-form.hidden name="next" value="settings"></x-form.hidden>
        <x-form.input label="{{__('URL')}}" name="url" :value="$data->url ?? ''"></x-form.input>
        <x-form.input label="{{__('Indicate the line number corresponding to the column headers')}}" name="rowTitle" :value="$data->rowTitle ?? ''"></x-form.input>
    </x-form.form>
</x-card>



