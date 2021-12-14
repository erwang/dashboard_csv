<x-card :title="__('Settings')" id="settings" class="menu-panel">
    <x-form.form method="POST" action="{{route('dashboard')}}">
        <x-form.hidden name="next" value="dashboard" action="{{route('dashboard')}}"></x-form.hidden>

        <x-form.select-row class="cols" value="{{$data['columnDescription'] ??''}}" name="columnDescription" label="Select the column containing the activity description" :options="$sheet->cols"></x-form.select-row>

        <x-form.select-row class="cols" value="{{$data['columnDuration'] ??''}}" name="columnDuration" label="Select the column containing the duration" :options="$sheet->cols"></x-form.select-row>

        <x-form.select-row class="cols" value="{{$data['column1'] ??''}}" name="column1" label="Select the column used to generate the axis of the timeline" :options="$sheet->cols"></x-form.select-row>
    </x-form.form>
</x-card>
