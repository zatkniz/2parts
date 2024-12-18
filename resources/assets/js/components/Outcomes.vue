<template>
    <div>
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="outcomes-table">
            <thead>
                <tr>
                    <th class="min-phone-l">Προμήθεια/Έξοδα</th>
                    <th>Ποσό</th>
                    <th data-priority="1" class="none">Ενέργειες</th>
                </tr>
            </thead>
            <tbody>
                <tr :id="'outfund' + index" v-for="(outfund , index ) in outfunds" v-if="checkNext(index)">
                    <td>{{outfund.outcome.name}}</td>
                    <td>{{outfund.total}}€</td>
                    <td>
                        <a :id="index" class="btn btn-default dark btn-outline" onclick="app5.editOutcomeModal(app5.outfunds , $(this).attr('id'))">
                            <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        </a>
                        <a :id="index" class="btn btn-danger btn-outline" onclick="app5.deleteOutcomeModal(app5.outfunds , $(this).attr('id'))">
                            <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <newoutcome @outcomeadd="resetFunds()"></newoutcome>
        <editoutcome @outcomeadd="resetFunds()"></editoutcome>
        <deleteoutcome @funddeleted="resetFunds()"></deleteoutcome>
    </div>
</template>
<script>
export default {
    data() {
        return {
            posts: [],
            outfunds: [],
        }
    },

    methods: {
        getAllOutfunds: function() {
            this.outfunds = [];
            if (this.isfromquery) {
                // this.outfunds.push(this.serverdata);
                if (this.isranged) {
                    this.outfunds = this.outfunds[0];
                }
                setTimeout(() => {
                    this.dataTablePast('outcomes-table');
                    app5.outfunds = this.outfunds;
                }, 500)
                return;
            }
            setTimeout(() => {
                this.dataTable('outcomes-table');
            }, 50)
            // axios.get(api + 'all-outfunds')
            //     .then(response => {
            //         this.outfunds = response.data;
            //         app5.outfunds = response.data;
            //         setTimeout(() => {
            //             this.dataTable('outcomes-table');
            //         }, 500)
            //     })
            //     .catch(e => {
            //         this.errors.push(e)
            //     })
        },
        resetFunds: function() {
            // $.blockUI({ message: '<h1>Παρακλώ περιμένετε...</h1>' });
            // if (this.isfromquery) {
            //     location.reload();
            // }
            // app5.TableOutfunds.destroy();
            // this.getAllOutfunds();
            // this.dailySums();
            // setTimeout(() => {
            //     $.unblockUI();
            // }, 400)
            app5.TableOutfunds.ajax.reload();
            this.dailySums();
        },
        dataTable: function(elementId) {
            setTimeout(function() {
                app5.TableOutfunds = $('#' + elementId).DataTable({
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
                    ajax: {
                        'url': api + 'all-outfunds',
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    columns: [
                        { data: 'outcome.name' },
                        {
                            data: function(d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function(d) {
                                app5.editOutFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editOutcomeModal(${ JSON.stringify(d) })'>
                                    <span>
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </span>
                                    </a>
                                    <a id="index" class="btn btn-danger btn-outline" onclick="app5.deleteOutcomeModal(${ JSON.stringify(d) })">
                                    <span>
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </span>
                                    </a>`

                            }
                        },
                    ],
                    "initComplete": function(settings, json) {
                        $.contextMenu({
                            selector: 'table#outcomes-table tbody tr',
                            callback: function(key, options) {
                                var m = "clicked: " + key;
                                window.console && console.log(m) || alert(m);
                            },
                            items: {
                                "new": {
                                    name: "Νέο Έξοδο",
                                    icon: "fa-plus",
                                    callback: function(itemKey, opt, rootMenu, originalEvent) {
                                        app5.openNewOutcomeModal()
                                    }
                                },
                                "edit": {
                                    name: "Επεξεργασία Εξόδου",
                                    icon: "edit",
                                    callback: function() {
                                        app5.editFund = app5.TableOutfunds.row(this[0]).data()
                                        app5.editOutcomeModal( app5.TableOutfunds.row(this[0]).data() )
                                    }
                                },
                                "delete": {
                                    name: "Διαγραφή Εξόδου",
                                    icon: "delete",
                                    callback: function() {
                                        app5.editFund = app5.TableOutfunds.row(this[0]).data()
                                        app5.deleteOutcomeModal(app5.TableOutfunds.row(this[0]).data())
                                    }
                                },
                            }
                        });
                    },
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function() { app5.openNewOutcomeModal() } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                    ],

                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

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
        dataTablePast: function(elementId) {
            setTimeout(function() {
                app5.TableOutfunds = $('#' + elementId).DataTable({
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
                    ajax: {
                        'url': api + 'past-outfunds-result/' + window.location.pathname.substr(window.location.pathname.indexOf('from='), 100),
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    columns: [
                        { data: 'outcome.name' },
                        {
                            data: function(d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function(d) {
                                app5.editOutFund = d;
                                return '<a id="index" class="btn btn-default dark btn-outline" onclick="app5.editOutcomeModal()">' +
                                    '<span>' +
                                    '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                                    '</span>' +
                                    '</a>' +
                                    '<a id="index" class="btn btn-danger btn-outline" onclick="app5.deleteOutcomeModal()">' +
                                    '<span>' +
                                    '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                                    '</span>' +
                                    '</a>'

                            }
                        },
                    ],
                    "initComplete": function(settings, json) {
                        $.contextMenu({
                            selector: 'table#outcomes-table tbody tr',
                            callback: function(key, options) {
                                var m = "clicked: " + key;
                                window.console && console.log(m) || alert(m);
                            },
                            items: {
                                "new": {
                                    name: "Νέο Έξοδο",
                                    icon: "fa-plus",
                                    callback: function(itemKey, opt, rootMenu, originalEvent) {
                                        app5.openNewOutcomeModal()
                                    }
                                },
                                "edit": {
                                    name: "Επεξεργασία Εξόδου",
                                    icon: "edit",
                                    callback: function() {
                                        app5.editFund = app5.TableOutfunds.row(this[0]).data()
                                        app5.editOutcomeModal(app5.TableOutfunds.row(this[0]).data())
                                    }
                                },
                                "delete": {
                                    name: "Διαγραφή Εξόδου",
                                    icon: "delete",
                                    callback: function() {
                                        app5.editFund = app5.TableOutfunds.row(this[0]).data()
                                        app5.deleteOutcomeModal( app5.TableOutfunds.row(this[0]).data() )
                                    }
                                },
                            }
                        });
                    },
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function() { app5.openNewOutcomeModal() } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                    ],

                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

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
        dailySums: function() {
            axios.get(api + 'summaries')
                .then(response => {
                    app5.sumaries = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        checkNext: function(index) {
            if (this.isfromquery) {
                var theDate = this.outfunds[index].created_at.substr(0, this.outfunds[index].created_at.indexOf(' ')).split('-')
                var date = theDate[2] + '/' + theDate[1] + '/' + theDate[0];
                if (index == 0) {
                    setTimeout(function() {
                        $('tr#outfund0').before('<tr rowspan="4"><td tabindex="0" class="past-tr-no-plus" style=""><strong>' + date + '</strong></td><td></td></tr>')
                    }, 2000);
                }
                if (index > 0) {
                    if (this.outfunds[index].created_at.substr(0, this.outfunds[index].created_at.indexOf(' ')) != this.outfunds[index - 1].created_at.substr(0, this.outfunds[index - 1].created_at.indexOf(' '))) {
                        setTimeout(function() {
                            $('tr#outfund' + index).before('<tr rowspan="4"><td tabindex="0"  class="past-tr-no-plus" style=""><strong>' + date + '</strong></td><td></td></tr>')


                        }, 2000);
                    }
                }
            }
            return true;
        },
    },

    created() {
        if (this.isfromquery) {
            setTimeout(function() {
                app5.isfromquery = true;
            }, 1000);

        }
    },

    mounted() {
        this.getAllOutfunds();
        Echo.private('fund')
            .listen('FundSaved', (e) => {
                setTimeout(function() {
                    app5.$refs.outcomes.resetFunds()
                }, 500);
            });
    },

    props: ['isfromquery', 'serverdata', 'isranged'],
}
</script>
