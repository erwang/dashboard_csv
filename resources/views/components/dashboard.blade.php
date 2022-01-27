<x-card :title="__('Dashboard')" id="dashboard" class="menu-panel">
    <x-slot name="tools">
        <a class="btn btn-default">
            <i class="fa fa-plus-circle"></i>
        </a>
    </x-slot>
   <x-cardGraph id="timeline" :sheet="$sheet" :data="$data">
       <x-slot name="settings">
            Settings
        </x-slot>

   </x-cardGraph>
</x-card>
