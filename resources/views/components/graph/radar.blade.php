<x-graph.default :graph="$graph" :sheet="$sheet">
    <x-slot name="formSettings">
        <div class="row">
            <div class="col-10">
                <x-form.select-row class="cols" :value="$graph->column ?? 0 " name="column"
                                   label="Select a column"
                                   :options="$sheet->cols"></x-form.select-row>
            </div>
        </div>
    </x-slot>
    <div class="border bg-light p-2 mt-2">
        <h2>{{ $sheet->cols[$graph->column] ??'' }}
        </h2>
            <canvas id="{{$graph->uuid}}"></canvas>
        <script>
            window.addEventListener("load", function () {
                const ctx = document.getElementById('{{$graph->uuid}}').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: {!! json_encode($labels)  !!},
                        datasets: {!! json_encode(array_values($datasets)) !!}
                    },


                });
            })
        </script>

    </div>
</x-graph.default>
