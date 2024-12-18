<template>
<div class="col-md-12">
    <div>
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th class="all">Όνομα</th>
                    <th class="all">Α.Παρ</th>
                    <th class="all">Ποσό</th>
                    <th class="all">Α. Ετ. Παρ.</th>
                    <th class="all">Ποσό</th>
                    <th class="all">Α. Μην. Παρ.</th>
                    <th class="all">Ποσό</th>
                    <th class="all">Α. Εβδ. Παρ.</th>
                    <th class="all">Ποσό</th>
                    <th class="all">Α. Ημ. Παρ.</th>
                    <th class="all">Ποσό</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            remain: 0,
        }
    },
    methods: {
        dataTable: function(elementId) {
            setTimeout(function() {
                app5.Table = $('#sample_1').DataTable({
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
                    ajax: {
                        'url': api + 'employers-sells',
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    columns: [
                        {
                            data: function (d) {
                                return d.name;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_funds ? d.count_funds.count : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_funds ? d.count_funds.price.toFixed(2) + '€' : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_year_funds ? d.count_year_funds.count : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_year_funds ? d.count_year_funds.price.toFixed(2) + '€' : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_month_funds ? d.count_month_funds.count : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_month_funds ? d.count_month_funds.price.toFixed(2) + '€' : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_week_funds ? d.count_week_funds.count : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_week_funds ? d.count_week_funds.price.toFixed(2) + '€' : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_daily_funds ? d.count_daily_funds.count : 0;
                            }
                        },
                        {
                            data: function (d) {
                                return d.count_daily_funds ? d.count_daily_funds.price.toFixed(2) + '€' : 0;
                            }
                        },
                    ],
                    "bServerSide": false,
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
        this.dataTable();
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