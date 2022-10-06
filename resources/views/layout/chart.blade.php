    
    <script src="{{ asset('js/node_modules/chart.js/dist/chart.js') }}"></script>
    <script>
        let myChart1 = document.querySelector('#pie-chart1').getContext('2d')

        let massPopChart1 = new Chart(myChart1, {
            type: 'pie',
            data: {
                labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Amount',
                    data: [
                        1200000,
                        1100000,
                        3000000,
                        2500000,
                        2700000,
                        2800000,
                        2900000
                    ],
                    backgroundColor: [
                        'red',
                        'orange',
                        'yellow',
                        'green',
                        'blue',
                        'indigo'
                    ],
                    borderWidth: 1,
                    borderColor: '#777',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Rent Collected',
                    fontSize: 25
                },
                legend: {
                    display: false,
                    position: 'right',
                    labels: {
                        fontColor: '#000'
                    }                    
                },
                // rotation: '180deg',
                layout: {
                    padding: {
                        left: 50,
                        right: 0,
                        bottom: 0,
                        top: 0
                    }
                },
                tooltips: {
                    enabled: true
                }

            }
        })
    </script>
    <script>
        let myChart = document.querySelector('#pie-chart').getContext('2d')

        let massPopChart = new Chart(myChart, {
            type: 'pie',
            data: {
                labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Amount',
                    data: [
                        1200000,
                        1100000,
                        3000000,
                        2500000,
                        2700000,
                        2800000,
                        2900000
                    ],
                    backgroundColor: [
                        'red',
                        'orange',
                        'yellow',
                        'green',
                        'blue',
                        'indigo'
                    ],
                    borderWidth: 1,
                    borderColor: '#777',
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#000'
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Rent Collected',
                    fontSize: 25
                },
                legend: {
                    display: false,
                    position: 'left',
                    labels: {
                        fontColor: '#000'
                    }                    
                },
                layout: {
                    padding: {
                        left: 50,
                        right: 0,
                        bottom: 0,
                        top: 0
                    }
                },
                tooltips: {
                    enabled: true
                }

            }
        })
    </script>