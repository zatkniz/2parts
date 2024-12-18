<template>
<div class="col-md-12">
    <div>
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th class="all">Α/Α</th>
                    <th class="all">Όνομα</th>
                    <th class="desktop">Μηνιαίες Παραγγελίες</th>
                    <th class="all">Τζίρος Μήνα</th>
                    <th class="all">Εισπράξεις Μήνα</th>
                    <th class="all">{{seller.percentage}}%</th>
                </tr>
            </thead>
            <tbody>
                <tr :id="'customer' + index" v-for="(customer , index ) in customers">
                    <td>{{index + 1}}</td>
                    <td :id="'teste' + index">
                        <a :href="'/single-customer/' + customer.id">{{customer.name}}</a>
                    </td>
                    <td class="text-center">{{customer.funds_monthly_count ? customer.funds_monthly_count.count : ''}}</td>
                    <td class="text-center">{{customer.funds_monthly_count ? customer.funds_monthly_count.price.toFixed(2) + '€' : ''}}</td>
                    <td class="text-center">{{customer.funds_pays_count ? customer.funds_pays_count.price.toFixed(2) + '€' : ''}}</td>
                    <td class="text-center">{{calculatePrice(customer)}}</td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn green pull-right" @click="savePayroll()">Αποθήκευση</button>
            </div>
        </div> -->
        <editpayroll></editpayroll>
    </div>
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                <strong>Σύνολο Ποσών: {{summaries}}€</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                <strong>Αποφορολογημένο Σύνολο: {{summariesTax.toFixed(2)}}€</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">
                <strong>{{seller.percentage}}%: {{summaries2percent.toFixed(2)}}€</strong>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            remain: 0,
            customers: '',
            employer: '',
            error: '',
            summaries: 0,
            summariesTax: 0,
            summaries2percent: 0,
            seller: {},
            orders: [
            ],
            fund: {
                isInvoice: false,
                isReceipt: false,
                hasPay: true,
                payment: '',
                payment: 0,
            },
            order: {},
            parts: {},
            duration: 5000,

        }
    },
    methods: {
        getCustomers: function() {
            this.customers = [];
            axios.get(api + 'current-payroll')
                .then(response => {
                    this.customers = response.data;
                    setTimeout(() => {
                        this.dataTable('sample_1');
                        setTimeout(function() {
                            $('.table-scrollable').removeClass('table-scrollable')
                        }, 600);
                    }, 500)
                })
                .catch(e => {
                    console.log(e);
                })
        },
        calculatePrice(customer){
            if(customer.funds_monthly_count){
                return (customer.funds_monthly_count.price / 100 * parseFloat(this.seller.percentage)).toFixed(2);
            }
            return 0;
        },
        getSinglePayroll: function() {
            
            this.customers = [];
            var date = null;
            var month = $('input#dateFrom').val().split('/')[0]
            var year = $('input#dateFrom').val().split('/')[1]

            if(month){
                date = moment( `${month}/${year}` , 'MM/YYYY' );
            }else{
                date = moment();
            }

            var id = this.employee.id
            
            if(!this.employee.id){
                id = window.location.href.split('/seller-print/')[1];
            }

            axios.get(api + 'employee/get-one/' + id).then(res => {
                this.seller = res.data;
                axios.get(api + 'employee/customers/' + id + '/' + date.format('MM') + '/' + date.format('YYYY') )
                    .then(response => {
                        this.customers = [];
                        this.customers = response.data.customers;
                        
                        this.customers.map(val => {
                            if(val.funds_monthly_count){
                            this.summaries += val.funds_monthly_count.price;
                            }
                        })
                        this.summariesTax = this.summaries / 1.24;
                        this.summaries2percent = this.summariesTax / 100 * parseFloat(this.seller.percentage);
                        setTimeout(() => {
                            // this.dataTable('sample_1');
                            setTimeout(function() {
                                $('.table-scrollable').removeClass('table-scrollable')
                            }, 600);
                            for (var index = 0; index < this.customers.length; index++) {
                                app5.countPayroll = app5.countPayroll + parseFloat($('td#summary' + index).text().split('€')[0])
                            }
                        }, 500)
                    })
                    .catch(e => {
                        console.log(e);
                    })
            })
        },
        savePayroll: function() {
            axios.post(api + 'save-payroll', this.customers)
                .then(response => {
                    toastr.success('Η μισθοδοσία αποθητεύτηκε επιτυχώς');
                })
                .catch(e => {
                    console.log(e);
                })
        },
        getCurrentPayrollPeriod: function() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd <= 15) {
                dd = '01';
            } else {
                dd = '02';
            }

            if (mm < 10) {
                mm = '0' + mm
            }

            today = dd + ' - ' + mm + '/' + yyyy;
            return today;
        },
        calculatePayrollSum: function(employee) {
            var payrolSum = parseFloat(this.employer[0].salary) + parseFloat(employee.extras)
            return payrolSum.toFixed(2);
        },
        calculateRemains: function(employee) {
            var remain = (parseFloat(this.employer[0].salary) + parseFloat(employee.extras)) - (parseFloat(employee.payroll_period_01_1) + parseFloat(employee.payroll_period_01_2) + parseFloat(employee.payroll_period_01_3) + parseFloat(employee.payroll_period_01_4) + parseFloat(employee.payroll_period_01_5) + parseFloat(employee.payroll_period_02_1) + parseFloat(employee.payroll_period_02_2) + parseFloat(employee.payroll_period_02_3) + parseFloat(employee.payroll_period_02_4) + parseFloat(employee.payroll_period_02_5));
            return remain.toFixed(2);
        },
        calculateSum: function(employee) {
            var sum = parseFloat(employee.payroll_period_01_1) + parseFloat(employee.payroll_period_01_2) + parseFloat(employee.payroll_period_01_3) + parseFloat(employee.payroll_period_01_4) + parseFloat(employee.payroll_period_01_5) + parseFloat(employee.payroll_period_02_1) + parseFloat(employee.payroll_period_02_2) + parseFloat(employee.payroll_period_02_3) + parseFloat(employee.payroll_period_02_4) + parseFloat(employee.payroll_period_02_5);
            return sum.toFixed(2);
        },
        dataTable: function(elementId) {
            setTimeout(function() {
                app5.Table = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
                    },
                    "bPaginate": false,
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [],

                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    "responsive": true,
                    "bDestroy": true,
                    "scrollX": false,
                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
            }, 300);
        },
    },

    created() {
        var self = this;
        if (this.employee) {
            this.getSinglePayroll();
        } else {
            this.getCustomers();
        }
        setTimeout(() => {
            $('#dateFrom').val(moment().format('MM/YYYY'))
            $('#dateFrom').datepicker({
                format: 'mm/yyyy',
                startMode: "months", 
                minViewMode: "months",
                orientation: 'bottom',
                language: 'el',
                todayHighlight: true,
                todayBtn: 'linked',
            }).on('changeDate', function(e) {
                self.summaries = 0;
                self.summariesTax = 0;
                self.summaries2percent = 0;
                self.getSinglePayroll();
            });
        }, 2000);
    },

    props: ['employee'],
}
</script>

<style>
input.form-control.input-sm {
    float: right;
}

span.month {
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