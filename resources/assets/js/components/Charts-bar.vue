<template>
    <canvas id="myBar" width="400" height="400">
    </canvas>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            time: 0,
            duration: 5000,
            customers: [],
            myChart: '',
            sumaries: [],
            outcome: {
                name: '',
            }
        }
    },
    methods: {
        createChart() {
            setTimeout(function() {
                var ctx = document.getElementById("myBar").getContext('2d');
                app5.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: app5.labels,
                        datasets: [{
                            data: app5.barincomes,
                            label: 'Τζίρος',
                            backgroundColor: '#3A4656',
                        },
                        {
                            data: app5.barpayments,
                            label: 'Πληρωμές',
                            type: 'bar',
                            backgroundColor: '#E73D4A',
                        },
                        {
                            data: app5.baroutfunds,
                            label: 'Έξοδα',
                            type: 'bar',
                            backgroundColor: '#000',
                        },
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                    }
                });
            }, 300);
        },
        updateChart(date) {
            app5.myBar.data.labels = app5.labels;
            app5.myBar.data.datasets[0].data = app5.barincomes;
            app5.myBar.data.datasets[1].data = app5.barpayments;
            app5.myBar.data.datasets[2].data = app5.baroutfunds;
            app5.myBar.update();
        }
    },


    mounted() {

    },
}
</script>
