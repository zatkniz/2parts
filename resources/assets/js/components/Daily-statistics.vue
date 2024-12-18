<template>
    <div>
        <input id="printMonths" type="text" class="form-control col-md-4 statistic-input-date" v-show="isDaily">
        <input id="printMonthsRange" type="text" class="form-control col-md-4 statistic-input-date" v-show="isDaily">
        <span class="input-group-addon no-pad statistics-range" style="background-color: rgb(50, 197, 210);" v-show="isDaily">
            <button id="dateToBtn" type="button" class="btn default date-reset green" @click="clearRange()">
                <i class="fa fa-times"></i>
            </button>
        </span>
        <input id="printYears" type="text" class="form-control col-md-4 statistic-input-date" v-show="isYear">
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th class="all">Ημερομηνία</th>
                    <th class="all max-sized">Ποσό</th>
                    <th class="all">Πληρωμές</th>
                    <th class="all">Έξοδα</th>
                    <th class="desktop">Ημερ.</th>
                </tr>
            </thead>
            <tbody>
                <tr :id="'fund' + index" v-for="(fund , index ) in dailyFunds">
                    <td>{{humanTime(fund.day)}}</td>
                    <td>{{fund.sum.toFixed(2)}}€</td>
                    <td>{{fund.payment.toFixed(2)}}€</td>
                    <td class="max-sized">{{findOutfundOfday(fund)}}€</td>
                    <td class="max-sized">{{fund.day}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
  data() {
    return {
      dailyFunds: [],
      dailyOutFunds: [],
      dateFrom: "",
      isYear: false,
      isDaily: true
    };
  },

  methods: {
    getAllFunds: function(deleted) {
      axios
        .get(api + "month-statistics")
        .then(response => {
          this.dailyFunds = response.data[0];
          this.dailyOutFunds = response.data[1];
          for (var index = 0; index < this.dailyFunds.length; index++) {
            app5.labels[index] = this.humanTime(this.dailyFunds[index].day);
            app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            app5.barpayments[index] = parseFloat(
              this.dailyFunds[index].payment
            );
            app5.baroutfunds[index] = parseFloat(
              this.dailyOutFunds[index].payment
            );
          }
          app5.sumaries.push(response.data[2].toFixed(2));
          app5.sumaries.push(response.data[3]);
          app5.sumaries.push(response.data[4].toFixed(2));
          app5.sumaries.push(response.data[5].toFixed(2));
          setTimeout(() => {
            this.dataTable("sample_1");
          }, 500);
          setTimeout(function() {
            $("#printMonths")
              .datepicker({
                format: "mm/yyyy",
                orientation: "bottom",
                language: "el",
                viewMode: "months",
                minViewMode: "months",
                todayHighlight: true,
                setDate: new Date(),
                autoclose: true,
                todayBtn: "linked"
              })
              .on("changeDate", function(e) {
                // app5.$refs.dailystats.dailyFunds = [];
                // app5.$refs.dailystats.dailyOutFunds = [];
                this.dateFrom = $("#printMonths").val();
                this.dateTo = $("#printMonthsRange").val();
                if (this.dateTo == "") {
                  if (app5.statisticsSelect == 7) {
                    app5.$refs.dailystats.getMonthFunds(2);
                  } else if (app5.statisticsSelect == 4) {
                    app5.$refs.dailystats.getMonthFunds(1);
                  } else {
                    app5.$refs.dailystats.getMonthFunds(this.dateFrom);
                  }

                  app5.$refs.chartspie.updateChart(this.dateFrom);
                } else {
                  if (app5.isWithCustomer) {
                    app5.$refs.dailystats.getMonthFundsRanged(
                      this.dateFrom,
                      this.dateTo,
                      1
                    );
                    app5.$refs.chartspie.updateChartRanged(
                      this.dateFrom,
                      this.dateTo,
                      1
                    );
                  } else {
                    app5.$refs.dailystats.getMonthFundsRanged(
                      this.dateFrom,
                      this.dateTo,
                      0
                    );
                    app5.$refs.chartspie.updateChartRanged(
                      this.dateFrom,
                      this.dateTo,
                      0
                    );
                  }
                }
              });
            $("#printMonthsRange")
              .datepicker({
                format: "mm/yyyy",
                orientation: "bottom",
                language: "el",
                viewMode: "months",
                minViewMode: "months",
                todayHighlight: true,
                autoclose: true,
                todayBtn: "linked"
              })
              .on("changeDate", function(e) {
                // app5.$refs.dailystats.dailyFunds = [];
                // app5.$refs.dailystats.dailyOutFunds = [];
                this.dateFrom = $("#printMonths").val();
                this.dateTo = $("#printMonthsRange").val();
                if (app5.isWithCustomer) {
                  app5.$refs.dailystats.getMonthFundsRanged(
                    this.dateFrom,
                    this.dateTo,
                    1
                  );
                  app5.$refs.chartspie.updateChartRanged(
                    this.dateFrom,
                    this.dateTo,
                    1
                  );
                } else {
                  app5.$refs.dailystats.getMonthFundsRanged(
                    this.dateFrom,
                    this.dateTo,
                    0
                  );
                  app5.$refs.chartspie.updateChartRanged(
                    this.dateFrom,
                    this.dateTo,
                    0
                  );
                }
              });
            $("#printMonths").datepicker("setDate", new Date());
          }, 500);
          setTimeout(function() {
            $("#printYears")
              .datepicker({
                format: "yyyy",
                orientation: "bottom",
                language: "el",
                viewMode: "years",
                minViewMode: "years",
                todayHighlight: true,
                setDate: new Date(),
                autoclose: true,
                todayBtn: "linked"
              })
              .on("changeDate", function(e) {
                // app5.$refs.dailystats.dailyFunds = [];
                // app5.$refs.dailystats.dailyOutFunds = [];
                this.dateFrom = $("#printYears").val();
                if (app5.statisticsSelect == 2) {
                  app5.$refs.dailystats.getYearFunds();
                  app5.$refs.chartspie.updateYear();
                }
                if (app5.statisticsSelect == 5) {
                  app5.$refs.dailystats.getYearFunds(1);
                  app5.$refs.chartspie.updateYear();
                }
                if (app5.statisticsSelect == 8) {
                  app5.$refs.dailystats.getYearFunds(2);
                  app5.$refs.chartspie.updateYear();
                }
              });
            $("#printYears").datepicker("setDate", new Date());
          }, 500);
          app5.$refs.chartspie.createChart();
          app5.$refs.chartbar.createChart();
        })
        .catch(e => {
          this.errors.push(e);
        });
    },
    humanTime: function(day) {
      if (app5.statisticsSelect == "1" && day) {
        var date = day.split("-");
        return date[2] + "/" + date[1];
      }
      return day;
    },
    findOutfundOfday(fund) {
      for (var index = 0; index < this.dailyOutFunds.length; index++) {
        if (fund.day == this.dailyOutFunds[index].day) {
          return this.dailyOutFunds[index].payment.toFixed(2);
        }
      }
      return 0;
    },
    clearRange() {
      $("#printMonthsRange").val("");
      this.getMonthFunds();
    },
    getMonthFunds: function(customer) {
      var customerId = "";
      var outcome = "";
      if (customer == 1) {
        customerId = "/" + $("#customers-select").val();
      }
      if (customer == 2) {
        outcome = "-outcome";
        customerId = "/" + $("#outcomes-select").val();
      }
      var date = (this.dateFrom = $("#printMonths").val());
      axios
        .get(
          api +
            "month-statistics" +
            outcome +
            "/" +
            date.split("/")[0] +
            "/" +
            date.split("/")[1] +
            customerId
        )
        .then(response => {
          app5.Table.destroy();
          app5.sumaries = [];
          this.dailyFunds = response.data[0];
          this.dailyOutFunds = response.data[1];
          app5.myBar.data.labels = [];
          app5.labels = [];
          app5.barincomes = [];
          app5.barpayments = [];
          app5.baroutfunds = [];
          for (var index = 0; index < this.dailyFunds.length; index++) {
            app5.labels[index] = this.humanTime(this.dailyFunds[index].day);
            if (customer == 2) {
              app5.barincomes[index] = 0;
            } else {
              app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            }
            if (customer == 2) {
              app5.barpayments[index] = 0;
            } else {
              app5.barpayments[index] = parseFloat(
                this.dailyFunds[index].payment
              );
            }
            if (customer == 1) {
              app5.baroutfunds[index] = 0;
            } else {
              app5.baroutfunds[index] = parseFloat(
                this.dailyOutFunds[index].payment
              );
            }
          }
          app5.$refs.chartbar.updateChart();
          app5.sumaries.push(response.data[2].toFixed(2));
          app5.sumaries.push(response.data[3]);
          app5.sumaries.push(response.data[4].toFixed(2));
          app5.sumaries.push(response.data[5].toFixed(2));
          setTimeout(() => {
            this.dataTable("sample_1");
          }, 500);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    getMonthFundsRanged: function(date, dateTo, customer) {
      var date = (this.dateFrom = $("#printMonths").val());
      var dateTo = (this.dateTo = $("#printMonthsRange").val());
      var dateMonthTo = "";
      var dateYearTo = dateTo.split("/")[1];
      var customerId = "";
      var outcome = "";
      if (customer == 1) {
        customerId = "/" + $("#customers-select").val();
      }
      if (customer == 2) {
        outcome = "-outcome";
        customerId = "/" + $("#outcomes-select").val();
      }
      if (parseInt(dateTo.split("/")[0]) < 10) {
        dateMonthTo = "0" + String(parseInt(dateTo.split("/")[0]) + 1);
      } else {
        dateMonthTo = parseInt(dateTo.split("/")[0]) + 1;
      }

      if (dateMonthTo == 13) {
        dateYearTo = parseInt(dateTo.split("/")[1]) + 1;
        dateMonthTo = "01";
      }

      axios
        .get(
          api +
            "month-statistics" +
            outcome +
            "/" +
            date.split("/")[0] +
            "/" +
            date.split("/")[1] +
            "/" +
            dateMonthTo +
            "/" +
            dateYearTo +
            customerId
        )
        .then(response => {
          app5.Table.destroy();
          app5.sumaries = [];
          this.dailyFunds = response.data[0];
          this.dailyOutFunds = response.data[1];
          app5.myBar.data.labels = [];
          app5.labels = [];
          app5.barincomes = [];
          app5.barpayments = [];
          app5.baroutfunds = [];
          for (var index = 0; index < this.dailyFunds.length; index++) {
            app5.labels[index] = this.humanTime(this.dailyFunds[index].day);
            app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            app5.barpayments[index] = parseFloat(
              this.dailyFunds[index].payment
            );
            if (customer == 1) {
              app5.baroutfunds[index] = 0;
            } else {
              app5.baroutfunds[index] = parseFloat(
                this.dailyOutFunds[index].payment
              );
            }
          }
          app5.$refs.chartbar.updateChart();
          app5.sumaries.push(response.data[2].toFixed(2));
          app5.sumaries.push(response.data[3]);
          app5.sumaries.push(response.data[4].toFixed(2));
          app5.sumaries.push(response.data[5].toFixed(2));
          setTimeout(() => {
            this.dataTable("sample_1");
          }, 500);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    getYearFunds: function(customer) {
      var customerId = "";
      var outcome = "";
      if (customer == 1) {
        customerId = "/" + $("#customers-select").val();
      }
      if (customer == 2) {
        outcome = "-outcome";
        customerId = "/" + $("#outcomes-select").val();
      }
      this.dateFrom = $("#printYears").val();
      axios
        .get(
          api + "year-statistics" + outcome + "/" + this.dateFrom + customerId
        )
        .then(response => {
          app5.Table.destroy();
          app5.sumaries = [];
          this.dailyFunds = response.data[0];
          this.dailyOutFunds = response.data[1];
          app5.myBar.data.labels = [];
          app5.labels = [];
          app5.barincomes = [];
          app5.barpayments = [];
          app5.baroutfunds = [];
          for (var index = 0; index < this.dailyFunds.length; index++) {
            app5.labels[index] = this.humanTime(this.dailyFunds[index].day);
            app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            app5.barpayments[index] = parseFloat(
              this.dailyFunds[index].payment
            );
            if (customer == 2) {
              app5.barincomes[index] = 0;
            } else {
              app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            }
            if (customer == 2) {
              app5.barpayments[index] = 0;
            } else {
              app5.barpayments[index] = parseFloat(
                this.dailyFunds[index].payment
              );
            }
            if (customer == 1) {
              app5.baroutfunds[index] = 0;
            } else {
              app5.baroutfunds[index] = parseFloat(
                this.dailyOutFunds[index].payment
              );
            }
          }
          app5.$refs.chartbar.updateChart();
          app5.sumaries.push(response.data[2].toFixed(2));
          app5.sumaries.push(response.data[3]);
          app5.sumaries.push(response.data[4].toFixed(2));
          app5.sumaries.push(response.data[5].toFixed(2));
          setTimeout(() => {
            this.dataTable("sample_1");
          }, 500);
        })
        .catch(e => {
          // this.errors.push(e)
        });
    },
    getAllYearsFunds: function(customer) {
      var customerId = "";
      var outcome = "";
      if (customer == 1) {
        customerId = "/" + $("#customers-select").val();
      }
      if (customer == 2) {
        outcome = "-outcome";
        customerId = "/" + $("#outcomes-select").val();
      }
      axios
        .get(api + "all-statistics" + outcome + customerId)
        .then(response => {
          app5.Table.destroy();
          app5.sumaries = [];
          this.dailyFunds = response.data[0];
          this.dailyOutFunds = response.data[1];
          app5.myBar.data.labels = [];
          app5.labels = [];
          app5.barincomes = [];
          app5.barpayments = [];
          app5.baroutfunds = [];
          for (var index = 0; index < this.dailyFunds.length; index++) {
            app5.labels[index] = this.humanTime(this.dailyFunds[index].day);
            app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            app5.barpayments[index] = parseFloat(
              this.dailyFunds[index].payment
            );
            if (customer == 2) {
              app5.barincomes[index] = 0;
            } else {
              app5.barincomes[index] = parseFloat(this.dailyFunds[index].sum);
            }
            if (customer == 2) {
              app5.barpayments[index] = 0;
            } else {
              app5.barpayments[index] = parseFloat(
                this.dailyFunds[index].payment
              );
            }
            if (customer == 1) {
              app5.baroutfunds[index] = 0;
            } else {
              app5.baroutfunds[index] = parseFloat(
                this.dailyOutFunds[index].payment
              );
            }
          }
          app5.$refs.chartbar.updateChart();
          app5.sumaries.push(response.data[2].toFixed(2));
          app5.sumaries.push(response.data[3]);
          app5.sumaries.push(response.data[4].toFixed(2));
          app5.sumaries.push(response.data[5].toFixed(2));
          setTimeout(() => {
            this.dataTable("sample_1");
          }, 500);
        })
        .catch(e => {
          // this.errors.push(e)
        });
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
          keys: true,
          // setup responsive extension: http://datatables.net/extensions/responsive/
          responsive: {
            details: {}
          },
          columnDefs: [
            { width: "6%", targets: 1 },
            { visible: false, targets: 4 }
          ],
          bDestroy: true,

          aaSorting: [],

          bSort: true,

          order: [[4, "asc"]],

          lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"] // change per page values here
          ],
          initComplete: function(settings, json) {
            if (
              parseInt(app5.statisticsSelect) > 3 &&
              parseInt(app5.statisticsSelect) < 7
            ) {
              app5.Table.column(3).visible(false);
              setTimeout(function() {
                app5.Table.column(3).visible(false);
              }, 50);
            } else if (parseInt(app5.statisticsSelect) > 6) {
              setTimeout(function() {
                app5.Table.column(3).visible(false);
              }, 250);
              setTimeout(function() {
                app5.Table.column(2).visible(false);
              }, 250);
              setTimeout(function() {
                app5.Table.column(4).visible(false);
              }, 250);
            }
          },
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

  created() {},

  mounted() {
    this.getAllFunds();
  }
};
</script>
<style>
.statistic-input-date {
  position: absolute;
  width: 110px;
  z-index: 99999999999;
  text-align: center;
}

.statistics-range {
  width: auto;
  position: absolute;
  left: 259px;
  height: 34px;
  z-index: 999999999999;
}

button#dateToBtn {
  margin-top: 2px;
}
</style>
