<template>
    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
        <thead>
            <tr>
                <th class="all">Όνομα</th>
                <th class="desktop">Επώνυμο</th>
                <th class="desktop">Ημερομηνία Πρόσληψης</th>
                <th class="desktop">Ημερομηνία Αποχώρησης</th>
            </tr>
        </thead>
        <tbody>
            <tr :id="'customer' + index" v-for="(customer , index ) in customers">
                <td :id="'teste' + index">
                    <a :href="'/single-employee/' + customer.id">{{customer.name}}</a>
                </td>
                <td class="text-center">{{customer.surname}}</td>
                <td class="text-center">{{customer.hiring_date}}</td>
                <td class="text-center">{{customer.firing_date}}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            time: 0,
            customers: '',
            error: '',
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
            axios.get(api + 'all-employees')
                .then(response => {
                    this.customers = response.data;
                    setTimeout(function() {
                        $('select').select2().on('select2:open', function() {
                            $('.select2-dropdown').removeClass('select2-dropdown--above');
                            $('.select2-dropdown').addClass('select2-dropdown--below');
                        })
                    }, 30);
                    setTimeout(() => {
                        this.dataTable('sample_1');
                        this.humanTime();
                        setTimeout(function() {
                            $('.table-scrollable').removeClass('table-scrollable')
                        }, 600);
                    }, 500)
                })
                .catch(e => {
                    console.log(e);
                })
        },
        humanTime: function(customer) {
            for (var index = 0; index < this.customers.length; index++) {
                if (this.customers[index].last_fund) {
                    this.customers[index].last_fund.created_at = app5.moment(this.customers[index].last_fund.created_at);
                }
            }
            return;
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
                    buttons: [
                        {
                            text: 'Νέο', className: 'btn dark btn-outline', action: function() {
                                window.location.href = api + 'new-employee'
                            }
                        },
                        { extend: 'print', className: 'btn dark btn-outline' },
                    ],

                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
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
        this.getCustomers();
    },
}
</script>

<style>
input.form-control.input-sm {
    float: right;
}
</style>