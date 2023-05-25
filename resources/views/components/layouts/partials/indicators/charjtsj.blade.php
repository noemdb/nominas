

<canvas id="{{$chartjs ?? null}}"></canvas>
{{$chartjs ?? null}}
    <script>
        var ctx = document.getElementById('{{$chartjs ?? null}}').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Doc. 1', 'oc. 2', 'oc. 3', 'oc. 4'],
                datasets: [{
                    label: 'Employee Documentations',
                    data: [{{$data ?? null}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
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
                maintainAspectRatio: true
            }
        });


    </script>