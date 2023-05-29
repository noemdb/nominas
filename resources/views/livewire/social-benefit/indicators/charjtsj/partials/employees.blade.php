<canvas id="{{ $chartjs ?? null }}"></canvas>

@push('scripts')
    <script>
        var ctx = document.getElementById('{{ $chartjs ?? null }}').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Frecuencia. 1', 'Frecuencia. 2', 'Frecuencia. 3', 'Frecuencia. 4'],
                datasets: [{
                    label: 'Employee Documentations',
                    data: [{{ $data ?? null }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Employee Documentations'
                },
                responsive: true,
                maintainAspectRatio: true,
                // scales: {
                //     xAxes: [
                //     {
                //     ticks: {
                //             autoSkip: false,
                //             maxRotation: 90,
                //             minRotation: 90
                //         }
                //     }
                //     ]
                // }
            }
        });
    </script>
@endpush
