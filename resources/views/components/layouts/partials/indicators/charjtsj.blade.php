<canvas id="{{ $chartjs ?? null }}"></canvas>

@push('scripts')
    <script>
        var ctx = document.getElementById('{{ $chartjs ?? null }}').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Doc. 1', 'Doc. 2', 'Doc. 3', 'Doc. 4'],
                datasets: [{
                    label: 'Employee Documentations',
                    data: [{{ $data ?? null }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    //     'rgba(255, 206, 86, 1)',
                    //     'rgba(75, 192, 192, 1)'
                    // ],
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
                maintainAspectRatio: true
            }
        });
    </script>
@endpush
