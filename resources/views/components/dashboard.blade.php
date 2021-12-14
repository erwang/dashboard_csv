<x-card :title="__('Dashboard')" id="dashboard" class="menu-panel">
   <x-cardGraph id="timeline" :sheet="$sheet" :data="$data">
        <x-slot name="settings">
            Settings
        </x-slot>
   </x-cardGraph>
</x-card>
