<template>
    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
        <thead>
            <tr>
                <th class="all">Πελάτης</th>
                <th class="desktop">Υπόλοιπο</th>
            </tr>
        </thead>
        <tbody>
            <tr :id="'customer' + index" v-for="(customer , index ) in customers">
                <td :id="'teste' + index">
                    <a :href="'/single-customer/' + customer.id">{{customer.name}}</a>
                </td>
                <td class="text-center">{{customer.balance.balance}}€</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
  name: "ExampleModal",
  data() {
    return {
      time: 0,
      customers: "",
      error: "",
      orders: [],
      fund: {
        isInvoice: false,
        isReceipt: false,
        hasPay: true,
        payment: "",
        payment: 0
      },
      selected: {},
      order: {},
      parts: {},
      duration: 5000
    };
  },
  methods: {
    getCustomers: function() {
      this.customers = [];
      axios
        .get(api + "all-customers-detailed")
        .then(response => {
          this.customers = response.data;
          setTimeout(function() {
            $("select")
              .select2()
              .on("select2:open", function() {
                $(".select2-dropdown").removeClass("select2-dropdown--above");
                $(".select2-dropdown").addClass("select2-dropdown--below");
              });
          }, 30);
          setTimeout(() => {
            this.dataTable("sample_1");
            this.humanTime();
            setTimeout(function() {
              $(".table-scrollable").removeClass("table-scrollable");
            }, 600);
          }, 500);
        })
        .catch(e => {
          console.log(e);
        });
    },
    humanTime: function(customer) {
      for (var index = 0; index < this.customers.length; index++) {
        if (this.customers[index].last_fund) {
          this.customers[index].last_fund.created_at = app5.moment(
            this.customers[index].last_fund.created_at
          );
        }
      }
      return;
    },
    dataTable: function(elementId, serverdata) {
      setTimeout(function() {
        app5.Table = $("#" + elementId).DataTable({
          // Internationalisation. For more info refer to http://datatables.net/manual/i18n
          language: {
            aria: {
              sortAscending: ": activate to sort column ascending",
              sortDescending: ": activate to sort column descending"
            },
            emptyTable: "Δεν υπάρχουν εγγραφές",
            info: "_TOTAL_ εγγραφές",
            infoEmpty: "Δεν υπάρχουν εγγραφές",
            infoFiltered: "(filtered1 from _MAX_ total entries)",
            lengthMenu: "_MENU_ entries",
            search: "Αναζήτηση:",
            zeroRecords: "Δεν βρέθηκαν σχετικές εγγραφές"
          },
          bPaginate: false,
          ajax: {
            url: api + "all-customers-detailed",
            dataSrc: "",
            rowId: "id"
          },
          bServerSide: false,
          columns: [
            {
              data: function(d) {
                return (
                  '<a href="/single-customer/' + d.id + '">' + d.name + "</a>"
                );
              }
            },
            { data: "balance.balance" }
          ],
          buttons: [
            {
              text: "Εκτύπωση Επιλεγμένων",
              className: "btn dark btn-outline selected-btn",
              action: function() {
                app5.printSelectedBalances(app5.selectedPrint);
              }
            },
            {
              text: "Εκτύπωση Όλων",
              className: "btn dark btn-outline",
              action: function() {
                app5.printAllBalances(serverdata);
              }
            },
            {
              text: "Εκτύπωση Πελατών Με Υπόλοιπο",
              className: "btn dark btn-outline",
              action: function() {
                app5.printBalances(serverdata);
              }
            }
          ],

          // setup responsive extension: http://datatables.net/extensions/responsive/
          responsive: {
            details: {}
          },
          bDestroy: true,
          scrollX: false,

          order: [[0, "asc"]],
          initComplete: function(settings, json) {
            $("#sample_1 tbody").delegate("tr", "click", function(event) {
              var $row = $(event.target);
              if ($row[0].tagName !== "TR") $row = $row.parent();
              if (event.ctrlKey) {
                app5.selectedPrint = [];
                $row.toggleClass("selected");
                $(".selected").each(function() {
                  app5.selectedPrint.push(app5.Table.row(this).data());
                });
                if (app5.selectedPrint.length > 1) {
                  $(".selected-btn").show(200);
                } else {
                  $(".selected-btn").hide(200);
                }
              }
              if (event.ctrlKey === false) {
                $row.siblings().removeClass("selected");
                app5.selectedPrint = [];
                $(".selected").each(function() {
                  app5.selectedPrint.push(app5.Table.row(this).data());
                });
                if (app5.selectedPrint.length > 1) {
                  $(".selected-btn").show(200);
                } else {
                  $(".selected-btn").hide(200);
                }
              }
            });
          },
          lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"] // change per page values here
          ],
          // set the initial value
          pageLength: 10,

          dom:
            "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable

          // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
          // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
          // So when dropdowns used the scrollable div should be removed.
          //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
      }, 300);
    }
  },

  created() {
    // this.getCustomers();
    // this.customers = this.serverdata;
    this.dataTable("sample_1", this.serverdata);
  },

  props: ["serverdata"]
};
</script>

<style>
input.form-control.input-sm {
  float: right;
}

.selected-btn {
  display: none;
}

tr.selected {
  background-color: #ff0000 !important;
  color: #fff;
}

table.dataTable td.sorting_1, table.dataTable td.sorting_2, table.dataTable td.sorting_3, table.dataTable th.sorting_1, table.dataTable th.sorting_2, table.dataTable th.sorting_3 {
    background: inherit !important;
}

tr.selected a {
    color: #fff !important;
}

.table-hover>tbody>tr:hover, .table-hover>tbody>tr:hover>td {
    background: #e50000!important;
    color: #fff !important;
}

.table-hover>tbody>tr:hover a, .table-hover>tbody>tr:hover>td {
    color: #fff !important;
}
</style>