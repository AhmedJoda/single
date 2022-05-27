@props(['title','labels','datasets','type'=>'line'])
@php($key = "chart_".\Illuminate\Support\Str::random(6))
<div
    class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
>
    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
        {{$title}}
    </h4>
    <div style="height: 25rem">
        <canvas id="{{$key}}"></canvas>
    </div>
    <div
        class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
    >
        <!-- Chart legend -->
        @foreach($datasets as $dataset)
        <div class="flex items-center">
                    <span
                        style="background-color: {{$dataset['color']}}"
                        class="inline-block w-3 h-3 mr-1  rounded-full"
                    ></span>
            <span>{{$dataset['label']}}</span>
        </div>
        @endforeach
    </div>
</div>
@push('page-scripts')
    <script>
        var labels = [];
        var datasets = [];
        @foreach($labels as $label)
        labels.push('{{$label}}');
        @endforeach
        @foreach($datasets as $dataset)
        datasets.push({
            label:'{{$dataset['label']}}',
            data: JSON.parse('{{json_encode($dataset['data'])}}'),
            fill: false,
            backgroundColor: '{{$dataset['color']}}',
            borderColor: '{{$dataset['color']}}',
        });
        @endforeach
        const lineConfig{{$key}} = {
            type: '{{$type}}',
            data: {
                labels:labels,
                datasets: datasets,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                /**
                 * Default legends are ugly and impossible to style.
                 * See examples in charts.html to add your own legends
                 *  */
                legend: {
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true,
                },
                scales: {
                    x: {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month',
                        },
                    },
                    y: {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value',
                        },
                    },
                },
            },
        }

        // change this to the id of your chart element in HMTL
        const lineCtx{{$key}} = document.getElementById('{{$key}}')
        window.myLine = new Chart(lineCtx{{$key}}, lineConfig{{$key}})
    </script>
@endpush
