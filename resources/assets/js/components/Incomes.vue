<template>
    <div>
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th class="all">Πελάτης</th>
                    <th class="all max-sized">Ανταλλακτικά</th>
                    <th class="all">Παραγγελία:</th>
                    <th class="all">Πληρωμή:</th>
                    <th data-priority="1" class="none">Αυτοκίνητο:</th>
                    <th data-priority="1" class="none">Υπόλοιπο Παραγγελίας:</th>
                    <th data-priority="1" class="none">Υπόλοιπο Πελάτη:</th>
                    <th data-priority="1" class="none">Κωδικός Παραγγελίας:</th>
                    <th data-priority="1" class="none">Καταχώρηση:</th>
                    <th data-priority="1" class="none">Διανομέας:</th>
                    <th data-priority="1" class="none">Τελευταία Επεξεργασία:</th>
                    <th class="none">Ενέργειες</th>
                </tr>
            </thead>
            <tbody>
                <tr :id="'fund' + index" v-for="(fund , index ) in funds" v-if="checkNext(index)">
                    <td></td>
                    <td class="max-sized"></td>
                    <td>€</td>
                    <td id="editablε" @dblclick="quickEditPayment(fund , index)">€</td>
                    <td></td>
                    <td>€</td>
                    <td>€</td>
                    <td></td>
                    <td id="user"></td>
                    <td id="last_user"></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <newmodal @fundadd="resetFunds(print)"></newmodal>
        <editincome @fundupdated="resetFunds()"></editincome>
        <deleteincome @funddeleted="resetFunds(1)"></deleteincome>
        <mail></mail>
    </div>
</template>
<script>
export default {
  data() {
    return {
      posts: [],
      funds: [],
      print: '',
      test: ""
    };
  },

  methods: {
    update: function() {
      axios
        .get(api + "funds")
        .then(response => {
          this.posts.push(response.data);
        })
        .catch(e => {
          this.errors.push(e);
        });
    },
    openEditincomeModal: function() {
      app5.$modal.show("editincome");
    },
    createTable: function() {},
    // humnaHour: function(time) {
    //     setTimeout(function() {
    //         return moment(time).format('h:mm:ss');
    //     }, 500);
    // },
    quickEditPayment: function(fund, index) {
      app5.selectedFund = fund;
      $("td#editable" + index).html(
        ' <input id="edit-input' +
          index +
          '" type="text" value="' +
          fund.payment +
          '" class="form-control" style="width:85%" placeholder="Ποσό" onkeypress="app5.quickSaveFund(event,' +
          index +
          ')">€'
      );
      setTimeout(function() {
        $("td#editable" + index + " input").focus();
      }, 50);
    },
    humanTime: function(time) {
      return time.substr(time.indexOf(" "), 20);
    },
    getAllFunds: function(deleted) {
      if (deleted) {
        this.funds = [];
      }
      if (this.isfromquery) {
        this.funds.push(this.serverdata);
        if (this.isranged) {
          this.funds = this.funds[0];
        }
        setTimeout(() => {
          app5.dataTable("sample_1");
          app5.funds = this.funds;
        }, 500);
        return;
      }
      // axios.get(api + 'funds')
      //     .then(response => {
      //         this.funds = response.data;
      //         app5.funds = response.data;
      //         setTimeout(() => {
      //             app5.dataTable('sample_1');
      //         }, 500);
      //         setTimeout(function() {
      //             app5.Table.on('key', function(e, datatable, key, cell, originalEvent) {
      //                 if (key == 13) {
      //                     if ($('#editable' + cell.node().id.substr(8, 80) + ' input').length == 0) {
      //                         app5.quickEditPayment(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80))
      //                     }
      //                 }
      //             }).on('key-blur', function(e, datatable, cell) {
      //                 app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
      //             })
      //         }, 1500);
      //         setTimeout(function() {
      //             app5.Table.on('row-reorder', function(e, diff, edit) {
      //                 var startedCustomer = edit.triggerRow.data()[10].substr(edit.triggerRow.data()[10].indexOf('id=') + 4, edit.triggerRow.data()[10].indexOf('" onclic') - 7);
      //                 if (typeof diff[1] !== 'undefined') {
      //                     var finishedCustomer = diff[1].node.id.substr(4, 10);
      //                     app5.mergeFunds(startedCustomer, finishedCustomer);
      //                 }
      //             });
      //         }, 1500);
      //     })
      //     .catch(e => {
      //         this.errors.push(e)
      //     })
    },
    dailySums: function() {
      axios
        .get(api + "summaries")
        .then(response => {
          app5.sumaries = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },
    resetFunds: function(print) {
      // $.blockUI({ message: '<h1>Παρακλώ περιμένετε...</h1>' });
      // if (this.isfromquery) {
      //     location.reload();
      // }
      // app5.Table.destroy();
      // this.getAllFunds(deleted);
      // this.dailySums();
      // window.scrollTo(0, 0);
      // setTimeout(() => {
      //     $.unblockUI();
      // }, 500)
      if(app5.$refs.offers){
        app5.$refs.offers.resetFunds();
      }

app5.Table.ajax.reload(function(print) {        
        if (app5.print) {
          app5.createPdf(app5.lastFund);
        }
        setTimeout(function() {
          $('[data-toggle="popover"]').popover();
        }, 500);
        app5.print = false;
      });
      this.dailySums();
    },
    checkNext: function(index) {
      if (this.isfromquery) {
        app5.isfromquery = true;
        var theDate = this.funds[index].created_at
          .substr(0, this.funds[index].created_at.indexOf(" "))
          .split("-");
        var date = theDate[2] + "/" + theDate[1] + "/" + theDate[0];
        if (index == 0) {
          setTimeout(function() {
            $("tr#fund0").before(
              '<tr rowspan="4"><td tabindex="0" class="past-tr-no-plus" style=""><strong>' +
                date +
                "</strong></td><td></td><td></td><td></td></tr>"
            );
          }, 2000);
        }
        if (index > 0) {
          if (
            this.funds[index].created_at.substr(
              0,
              this.funds[index].created_at.indexOf(" ")
            ) !=
            this.funds[index - 1].created_at.substr(
              0,
              this.funds[index - 1].created_at.indexOf(" ")
            )
          ) {
            setTimeout(function() {
              $("tr#fund" + index).before(
                '<tr rowspan="4"><td tabindex="0"  class="past-tr-no-plus" style=""><strong>' +
                  date +
                  "</strong></td><td></td><td></td><td></td></tr>"
              );
            }, 2000);
          }
        }
      }
      return true;
    }
  },

  created() {
    if(this.single){
      setTimeout(function() {
        app5.dataTableSingle("sample_1");
      }, 200);
      return;
    }
    if (this.iscustomer) {
      setTimeout(function() {
        app5.dataTableCustomer("sample_1");
      }, 200);
      return;
    }
    if (this.isfromquery) {
      setTimeout(function() {
        app5.isfromquery = true;
        app5.dataTablePastFunds("sample_1");
      }, 500);
      return;
    }
    setTimeout(() => {
      app5.dataTable("sample_1");
    }, 500);
  },

  mounted() {
    // this.getAllFunds();
    this.dailySums();
    // this.humanTime();
    Echo.private("fund").listen("FundSaved", e => {
      setTimeout(function() {
        app5.$refs.incomes.resetFunds();
      }, 500);
    });
  },

  props: ["isfromquery", "serverdata", "isranged", "iscustomer", "isprovince" , "single"]
};
</script>
