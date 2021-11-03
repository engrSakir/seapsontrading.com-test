@php
    $statisticsCaption = getContent('statistics.caption',true);
@endphp

@if($statisticsCaption)
    @php
        $collection['day'] = collect([]);
        $collection['trx'] = collect([]);
        \App\Invest::where('created_at', '>', \Carbon\Carbon::now()->subDays(7))
            ->selectRaw('SUM(amount) as totalTransaction ')
            ->selectRaw("DATE_FORMAT(created_at, '%W') day")
            ->groupBy(\Illuminate\Support\Facades\DB::raw('DATE(created_at)'))
            ->get()->map(function ($v, $key) use ($collection) {
                if ($v->totalTransaction == null) {
                    $collection['trx']->push(round($v->totalTransaction, 2));
                } else {
                    $collection['trx']->push(round($v->totalTransaction, 2));
                }
                $collection['day']->push($v->day);
                return $collection;
            });

    @endphp

    <!-- ========Investetor-Section Starts Here ========-->
    <section class="statistics-section py-5">
        <div class="container">

            <div class="row justify-content-center ">
                <div class="col-10 text-center">
                    <div class="section-header mb-5">
                        <h2 class="title">{{__(@$statisticsCaption->data_values->title)}} </h2>
                        <p class="section-para">{{__(@$statisticsCaption->data_values->short_details)}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xl-12">

                    <div class="chart-scroll">
                        <div class="chart-wrapper">
                            <canvas id="myChart" width="400" height="160"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========Investetor-Section Ends Here ========-->

    <div class="sec-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec"></div>
                </div>
            </div>
        </div>
    </div>
@endif


@section('load-js')
    <script src="{{asset('assets/templates/minimul/js/chart.js')}}"></script>
@stop
@push('js')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($collection['day']),
                datasets: [{
                    label: '# Weekly Revenue',
                    data: @json($collection['trx']),
                    backgroundColor: [
                        'rgba(92, 147, 219, 0.71)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(58, 248, 93, 0.26)'
                    ],
                    borderColor: [
                        'rgba(126, 174, 236, 0.66)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(58, 248, 80, 0.65)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endpush

