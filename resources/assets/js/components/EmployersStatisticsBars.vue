<template>
    <div class="col-md-12">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            remain: 0,
            availableMonths: [],
            months: [
                'Γεννάρης',
                'Φλεβάρης',
                'Μάρτης',
                'Απρίλης',
                'Μάιος',
                'Ιούνης',
                'Ιούλης',
                'Αύγουστος',
                'Σεπτέμβρης',
                'Οκτώβρης',
                'Νοέμβρης',
                'Δεκέμβρης',
            ],
            colors: [
                'red',
                'black',
                'yellow',
                'green',
                'pink',
                'white'
            ]
        }
    },
    methods: {
        dataTable: function(elementId) {
            var self = this;

            var date = $('input#dateFromBar').val();
            
             axios.get(api + 'employees-bar/' + date)
                .then(res => { 
                    
                    this.availableMonths = res.data[0].monthly_funds.map( val => {
                       return val.month;
                    })

                    self.availableMonths.map( g => {
                        res.data.map( val => {
                            if(!val.monthly_funds.find( (v , index) => {
                                return g == v.month;
                            })){
                                val.monthly_funds.splice(g - 1, 0, {
                                    count : 0,
                                    month : g
                                })
                            } 
                        })

                    })
                    
                    setTimeout(function() {
                        var ctx = document.getElementById("myChart").getContext('2d');
                        ctx.height = 400;
                        app5.chart =  new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: self.availableMonths.map(val => {
                                                    return self.months[val - 1];
                                                }),
                                                datasets: res.data.map( (val , index) => {
                                                    return {
                                                    label: val.name,
                                                    data: val.monthly_funds.map( ( v , i ) => {
                                                        return v.count;
                                                    }),
                                                    backgroundColor:  val.monthly_funds.map( v => {
                                                        return self.colors[index];
                                                    }),
                                                    borderWidth: 1
                                                }
                                                } )
                                            },
                                            options: {
                                                maintainAspectRatio: false,
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero:true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                    }, 300);
                })
                .catch(e => {
                    console.log(e)
                })
        },
    },

    created() {
        $('#dateFromBar').val(moment().format('YYYY'))
        var self = this;
        this.dataTable();
        setTimeout(() => {
            $('#dateFromBar').val(moment().format('YYYY'))
            $('#dateFromBar').datepicker({
                format: 'yyyy',
                startMode: "years", 
                minViewMode: "years",
                orientation: 'bottom',
                language: 'el',
                todayHighlight: true,
                todayBtn: 'linked',
            }).on('changeDate', function(e) {
                console.log(self.dataTable());
                
            });
        }, 2000);
    },
}
</script>

<style>
input.form-control.input-sm {
    float: right;
}

span.month, span.year {
    display: inline-block;
    width: 100px;
    text-align: center;
    border: 1px solid #000;
}
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-right.datepicker-orient-bottom {
    width: 350px;
    left: unset !important;
    right: 55px;
}
</style>