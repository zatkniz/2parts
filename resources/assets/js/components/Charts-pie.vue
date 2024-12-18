<template>
    <canvas id="myChart" width="400" height="400">
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
            dateFrom: '',
            outcome: {
                name: '',
            }
        }
    },
    methods: {
        createChart() {
            axios.get(api + 'month-statistics')
                .then(response => {
                    this.sumaries.push(response.data[2].toFixed(2))
                    this.sumaries.push(response.data[3])
                    this.sumaries.push(response.data[4].toFixed(2))
                    this.sumaries.push(response.data[5].toFixed(2))
                })
                .catch(e => {
                    // this.errors.push(e)
                })
            setTimeout(function() {
                var ctx = document.getElementById("myChart").getContext('2d');
                app5.myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Τζίρος", "Πληρωμές", "Έξοδα"],
                        datasets: [{
                            data: [app5.sumaries[0], app5.sumaries[2], app5.sumaries[3]],
                            backgroundColor: [
                                '#3A4656',
                                '#E73D4A',
                                '#000',
                            ],
                        }]
                    },
                    options: {

                    }
                });
            }, 300);
        },
        updateChart(date) {
            var date = this.dateFrom = $('#printMonths').val();
            axios.get(api + 'month-statistics' + '/' + date.split('/')[0] + '/' + date.split('/')[1])
                .then(response => {
                    this.sumaries = [];
                    this.sumaries.push(response.data[2].toFixed(2))
                    this.sumaries.push(response.data[3])
                    this.sumaries.push(response.data[4].toFixed(2))
                    this.sumaries.push(response.data[5].toFixed(2))
                    app5.myChart.data.datasets[0].data[0] = response.data[2].toFixed(2)
                    app5.myChart.data.datasets[0].data[1] = response.data[4].toFixed(2)
                    app5.myChart.data.datasets[0].data[2] = response.data[5].toFixed(2)
                    app5.myChart.update();
                })
                .catch(e => {
                    console.log(e);

                })
        },
        updateChartRanged(date) {
            var date = this.dateFrom = $('#printMonths').val();
            var dateTo = this.dateTo = $('#printMonthsRange').val();
            var dateMonthTo = '';
            var dateYearTo = dateTo.split('/')[1];

            if (parseInt(dateTo.split('/')[0]) < 10) {
                dateMonthTo = '0' + String(parseInt(dateTo.split('/')[0]) + 1)
            } else {
                dateMonthTo = parseInt(dateTo.split('/')[0]) + 1
            }

            if (dateMonthTo == 13) {
                dateYearTo = parseInt(dateTo.split('/')[1]) + 1;
                dateMonthTo = '01'
            }

            axios.get(api + 'month-statistics' + '/' + date.split('/')[0] + '/' + date.split('/')[1] + '/' + dateMonthTo + '/' + dateYearTo)
                .then(response => {
                    this.sumaries = [];
                    this.sumaries.push(response.data[2].toFixed(2))
                    this.sumaries.push(response.data[3])
                    this.sumaries.push(response.data[4].toFixed(2))
                    this.sumaries.push(response.data[5].toFixed(2))
                    app5.myChart.data.datasets[0].data[0] = response.data[2].toFixed(2)
                    app5.myChart.data.datasets[0].data[1] = response.data[4].toFixed(2)
                    app5.myChart.data.datasets[0].data[2] = response.data[5].toFixed(2)
                    app5.myChart.update();
                })
                .catch(e => {
                    console.log(e);

                })
        },
        updateYear(date) {
            this.dateFrom = $('#printYears').val();
            axios.get(api + 'year-statistics' + '/' + this.dateFrom)
                .then(response => {
                    this.sumaries = [];
                    this.sumaries.push(response.data[2].toFixed(2))
                    this.sumaries.push(response.data[3])
                    this.sumaries.push(response.data[4].toFixed(2))
                    this.sumaries.push(response.data[5].toFixed(2))
                    app5.myChart.data.datasets[0].data[0] = response.data[2].toFixed(2)
                    app5.myChart.data.datasets[0].data[1] = response.data[4].toFixed(2)
                    app5.myChart.data.datasets[0].data[2] = response.data[5].toFixed(2)
                    app5.myChart.update();
                })
                .catch(e => {
                    console.log(e);

                })
        },
        updateAll(date) {
            axios.get(api + 'all-statistics')
                .then(response => {
                    this.sumaries = [];
                    this.sumaries.push(response.data[2].toFixed(2))
                    this.sumaries.push(response.data[3])
                    this.sumaries.push(response.data[4].toFixed(2))
                    this.sumaries.push(response.data[5].toFixed(2))
                    app5.myChart.data.datasets[0].data[0] = response.data[2].toFixed(2)
                    app5.myChart.data.datasets[0].data[1] = response.data[4].toFixed(2)
                    app5.myChart.data.datasets[0].data[2] = response.data[5].toFixed(2)
                    app5.myChart.update();
                })
                .catch(e => {
                    console.log(e);

                })
        },

    },


    mounted() {

    },
}
</script>
