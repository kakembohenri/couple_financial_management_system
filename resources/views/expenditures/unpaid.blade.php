<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav')
<body>
    @if(!empty(session('status')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
    
    <div class='dashboard-main-container'>
        @extends('layout.navbar')
       
        <div class='dashboard-activity'>
            <h3>Unpaid expenditures</h3>
            <div class='pie-chart'>
                <div class='pie-chart-container'>
                    <h3>Total Paid</h3>

                    <div class="chart-container">
                        <div class="pie-chart-container">
                          <canvas id="pie-chart1"></canvas>
                        </div>
                      </div>
                </div>
                <div>
                    <div>
                        <p>Total:</p>
                        <span style='font-weight: bolder; font-size: 2rem;'>{{ $total }} shs</span>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</body>
    
<script src="{{ asset('js/node_modules/chart.js/dist/chart.js') }}"></script>
<script>
    let rent = '<?php echo $rent; ?>';
    let elec = '<?php echo $elec; ?>';
    let fuel = '<?php echo $fuel; ?>';
    let medic = '<?php echo $medic; ?>';
    let food = '<?php echo $food; ?>';
    let water = '<?php echo $water; ?>'

    let myChart1 = document.querySelector('#pie-chart1').getContext('2d')

    let massPopChart1 = new Chart(myChart1, {
        type: 'pie',
        data: {
            labels: ['Rent', 'Electricity', 'Fuel', 'Medical', 'Food', 'Water'],
            datasets: [{
                label: 'Amount',
                data: [
                    rent,
                    elec,
                    fuel,
                    medic,
                    food,
                    water,
                    
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

</html>