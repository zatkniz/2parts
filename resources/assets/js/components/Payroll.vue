<template>
    <div>
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th class="all">Α/Α</th>
                    <th class="desktop">Όνομα</th>
                    <th class="desktop">Μισθός</th>
                    <th class="desktop">Bonus</th>
                    <th class="desktop">Δώρο</th>
                    <th class="desktop">Τακτική Μισθοδοσία</th>
                    <th class="none" style="width:40px;">01-1</th>
                    <th class="none" style="width:40px;">01-2</th>
                    <th class="none" style="width:40px;">01-3</th>
                    <th class="none" style="width:40px;">01-4</th>
                    <th class="none" style="width:40px;">01-5</th>
                    <th class="none">02-1</th>
                    <th class="none">02-2</th>
                    <th class="none">02-3</th>
                    <th class="none">02-4</th>
                    <th class="none">02-5</th>
                    <th>Σύνολο Μισθοδοσίας</th>
                    <th>Σύνολο</th>
                    <th>Υπόλοιπο</th>
                    <th class="none">Επεξεργασία</th>
                </tr>
            </thead>
            <tbody>
                <tr :id="'customer' + index" v-for="(customer , index ) in customers">
                    <td>{{index + 1}}</td>
                    <td :id="'teste' + index">
                        <a :href="'/single-employee/' + customer.employee.id">{{customer.employee.name}} {{customer.employee.surname}}</a>
                    </td>
                    <td class="text-center">{{customer.employee.salary}}€</td>
                    <td class="text-center">{{customer.extras}}</td>
                    <td class="text-center">{{customer.gift}}</td>
                    <td class="text-center">{{getCurrentPayrollPeriod()}}</td>
                    <td class="text-center">
                        {{customer.payroll_period_01_1}}€ ({{customer.payroll_period_01_1_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_01_2}}€ ({{customer.payroll_period_01_2_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_01_3}}€ ({{customer.payroll_period_01_3_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_01_4}}€ ({{customer.payroll_period_01_4_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_01_5}}€ ({{customer.payroll_period_01_5_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_02_1}}€ ({{customer.payroll_period_02_1_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_02_2}}€ ({{customer.payroll_period_02_2_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_02_3}}€ ({{customer.payroll_period_02_3_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_02_4}}€ ({{customer.payroll_period_02_4_date}})
                    </td>
                    <td class="text-center">
                        {{customer.payroll_period_02_5}}€ ({{customer.payroll_period_02_5_date}})
                    </td>
                    <td class="text-center">{{calculatePayrollSum(customer)}}€</td>
                    <td class="text-center">{{calculateSum(customer)}}€</td>
                    <td class="text-center">{{calculateRemains(customer)}}€</td>
                    <td>
                        <a :id="index" class="btn btn-default dark btn-outline" onclick="app5.editPayrollModal(app5.testPosts , $(this).attr('id'))">
                            <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        </a>
                    </td>
                </tr>
                <tr id="no-expand">
                    <td></td>
                    <td>
                        Σύνολα
                    </td>
                    <td class="text-center">{{sumSalary}}€</td>
                    <td class="text-center">{{sumExtras}}€</td>
                    <td class="text-center">{{sumGift}}€</td>
                    <td class="text-center"></td>
                    <td class="text-center">130€</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">{{sumAllSalary}}€</td>
                    <td class="text-center">{{sumAllSums}}€</td>
                    <td class="text-center">{{sumRemains}}€</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn green pull-right" @click="savePayroll()">Αποθήκευση</button>
            </div>
        </div>
        <editpayroll></editpayroll>
    </div>
</template>
<script>
export default {
  name: "ExampleModal",
  data() {
    return {
      remain: 0,
      customers: "",
      error: "",
      orders: [],
      sumSalary: 0,
      sumExtras: 0,
      sumGift: 0,
      sumAllSums: 0,
      sumAllSalary: 0,
      sumRemains: 0,
      fund: {
        isInvoice: false,
        isReceipt: false,
        hasPay: true,
        payment: "",
        payment: 0
      },
      order: {},
      parts: {},
      duration: 5000
    };
  },
  methods: {
    calculateSumSalary: function() {
      this.sumSalary = 0;
      this.sumExtras = 0;
      this.sumGift = 0;
      this.sumAllSalary = 0;
      this.sumAllSums = 0;
      this.sumRemains = 0;
      for (let index = 0; index < this.customers.length; index++) {
        this.sumSalary += parseInt(this.customers[index].employee.salary);
        this.sumExtras += parseInt(this.customers[index].extras);
        this.sumGift += parseInt(this.customers[index].gift);
        this.sumAllSalary += parseFloat(
          this.calculatePayrollSum(this.customers[index])
        );
        this.sumAllSums += parseFloat(this.calculateSum(this.customers[index]));
        this.sumRemains += parseFloat(
          this.calculateRemains(this.customers[index])
        );
      }
    },
    updateThis(customer){
      console.log('d');
      console.log(customer);
      
      
    },
    getCustomers: function() {
      this.customers = [];
      axios
        .get(api + "current-payroll")
        .then(response => {
          this.customers = response.data;
          app5.testPosts = response.data;
          setTimeout(() => {
            this.dataTable("sample_1");
            this.calculateSumSalary();
            setTimeout(function() {
              $(".table-scrollable").removeClass("table-scrollable");
            }, 600);
          }, 500);
        })
        .catch(e => {
          console.log(e);
        });
    },
    getSinglePayroll: function() {
      this.customers = [];
      axios
        .get(api + "payroll/" + this.employee.id)
        .then(response => {
          this.customers = response.data;
          app5.testPosts = response.data;
          setTimeout(() => {
            this.dataTable("sample_1");
            setTimeout(function() {
              $(".table-scrollable").removeClass("table-scrollable");
            }, 600);
          }, 500);
        })
        .catch(e => {
          console.log(e);
        });
    },
    savePayroll: function() {
      axios
        .post(api + "save-payroll", this.customers)
        .then(response => {
          toastr.success("Η μισθοδοσία αποθητεύτηκε επιτυχώς");
          this.calculateSumSalary();
        })
        .catch(e => {
          console.log(e);
        });
    },
    getCurrentPayrollPeriod: function() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1; //January is 0!
      var yyyy = today.getFullYear();

      if (dd <= 15) {
        dd = "01";
      } else {
        dd = "02";
      }

      if (mm < 10) {
        mm = "0" + mm;
      }

      today = dd + " - " + mm + "/" + yyyy;
      return today;
    },
    calculatePayrollSum: function(employee) {
      var payrolSum =
        parseFloat(employee.employee.salary) + parseFloat(employee.extras) + parseFloat(employee.gift);
      return payrolSum.toFixed(2);
    },
    calculateRemains: function(employee) {
      var remain =
        parseFloat(employee.employee.salary) +
        parseFloat(employee.extras) +
        parseFloat(employee.gift) -
        (parseFloat(employee.payroll_period_01_1) +
          parseFloat(employee.payroll_period_01_2) +
          parseFloat(employee.payroll_period_01_3) +
          parseFloat(employee.payroll_period_01_4) +
          parseFloat(employee.payroll_period_01_5) +
          parseFloat(employee.payroll_period_02_1) +
          parseFloat(employee.payroll_period_02_2) +
          parseFloat(employee.payroll_period_02_3) +
          parseFloat(employee.payroll_period_02_4) +
          parseFloat(employee.payroll_period_02_5));
      return remain.toFixed(2);
    },
    calculateSum: function(employee) {
      var sum =
        parseFloat(employee.payroll_period_01_1) +
        parseFloat(employee.payroll_period_01_2) +
        parseFloat(employee.payroll_period_01_3) +
        parseFloat(employee.payroll_period_01_4) +
        parseFloat(employee.payroll_period_01_5) +
        parseFloat(employee.payroll_period_02_1) +
        parseFloat(employee.payroll_period_02_2) +
        parseFloat(employee.payroll_period_02_3) +
        parseFloat(employee.payroll_period_02_4) +
        parseFloat(employee.payroll_period_02_5);
      return sum.toFixed(2);
    },
    dataTable: function(elementId) {
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
          // Or you can use remote translation file
          //"language": {
          //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
          //},

          // setup buttons extentension: http://datatables.net/extensions/buttons/
          buttons: [{ extend: "print", className: "btn dark btn-outline" }],

          // setup responsive extension: http://datatables.net/extensions/responsive/
          responsive: true,
          bDestroy: true,
          scrollX: false,
          ordering: false,
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
    window.self = this;
    if (this.employee) {
      this.getSinglePayroll();
    } else {
      this.getCustomers();
    }
  },

  props: ["employee"]
};
</script>

<style>
input.form-control.input-sm {
  float: right;
}

table.dataTable.dtr-inline.collapsed
  > tbody
  > tr#no-expand
  > td:first-child:before,
table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
  top: 9px;
  left: 4px;
  height: 14px;
  width: 14px;
  display: block;
  position: absolute;
  color: white;
  border: 2px solid white;
  border-radius: 14px;
  box-shadow: 0 0 3px #444;
  box-sizing: content-box;
  text-align: center;
  font-family: "Courier New", Courier, monospace;
  line-height: 14px;
  content: "";
  background-color: transparent;
}
</style>