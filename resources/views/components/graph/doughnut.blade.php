<x-graph.default :graph="$graph" :sheet="$sheet">
    <x-slot name="formSettings">
        <div class="row">
            <div class="col-10">
                <x-form.select-row class="cols" :value="$graph->columns ?? []" name="column"
                                   label="Add a column"
                                   :options="$sheet->cols"></x-form.select-row>
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-primary float-right" value="{{__('Actualiser')}}"></input>
            </div>

        </div>
    </x-slot>
    <div class="border bg-light p-2 mt-2">
        <canvas id="{{$graph->uuid}}" width="{{$width}}" height="{{$height}}px"></canvas>
        <script>
            window.addEventListener("load", function () {
                const ctx = document.getElementById('{{$graph->uuid}}').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($labels)  !!},
                        datasets: {!! json_encode(array_values($datasets)) !!}
                    },

                });
            })
        </script>

    </div>
</x-graph.default>