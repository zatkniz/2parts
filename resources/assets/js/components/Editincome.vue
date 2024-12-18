<template>
    <modal name="editincome" height="auto" width="80%" @before-open="beforeOpen" @before-close="beforeClose" :scrollable="true" :adaptive="true" v-on:keyup.esc="closeModal()">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Επεξεργασία Εσόδου
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="closeModal()"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group form-md-checkboxes">
                            <label class="col-sm-3 control-label">Τιμολόγιο</label>
                            <div class="col-sm-1" style="margin-top: 8px;width: 5%;">
                                <div class="md-checkbox">
                                    <input @click="destroySelectCustomer(0)" v-model="fund.isInvoice" type="checkbox" id="checkbox2_5" name="checkboxes2[]" value="1" class="md-check">
                                    <label for="checkbox2_5">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                            <label class="col-md-1 control-label">Απόδειξη</label>
                            <div class="col-md-1" style="margin-top: 8px;width: 5%;">
                                <div class="md-checkbox">
                                    <input @click="destroySelectCustomer(1)" v-model="fund.isReceipt" type="checkbox" id="checkbox2_6" name="checkboxes2[]" value="1" class="md-check">
                                    <label for="checkbox2_6">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                            <label class="col-md-1 control-label">Επαρχία</label>
                            <div class="col-md-1" style="margin-top: 8px;width: 5%;">
                                <div class="md-checkbox">
                                    <input type="checkbox" v-model="fund.isProvince" id="checkbox2_7" name="checkboxes2[]" value="1" class="md-check">
                                    <label for="checkbox2_7">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                            <label class="col-sm-1 control-label">Πιστωτικό</label>
                            <div class="col-sm-1" style="margin-top: 8px;width: 5%;">
                                <div class="md-checkbox">
                                    <input @click="destroySelectCustomer(2)" v-model="fund.isCreditNote" type="checkbox" id="checkbox2_8" name="checkboxes2[]" value="1" class="md-check">
                                    <label for="checkbox2_8">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                            <label class="col-sm-1 control-label">Προσφορά</label>
                            <div class="col-sm-1" style="margin-top: 8px;width: 5%;">
                                <div class="md-checkbox">
                                    <input v-model="fund.isOffer" type="checkbox" id="checkbox2_9" name="checkboxes2[]" value="1" class="md-check">
                                    <label for="checkbox2_9">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Πελάτης</label>
                            <div class="col-md-7">
                                <select id="customers-select" class="form-control">
                                    <option></option>
                                    <option v-for="customer in customers" :value="customer.id">{{customer.id}} - {{customer.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:;" onclick="app5.$modal.show('newcustomer');$('select').select2('close')" class="btn btn-circle red-sunglo ">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group" v-if="fund.isInvoice">
                            <label class="col-md-3 control-label">Τιμολόγιο</label>
                            <div class="col-md-5">
                                <input id="invoice-number" type="text" class="form-control" placeholder="Αριθμός Δελτίου Τιμολογίου" v-model="fund.invoice" v-on:keyup.enter="focusInvoicePrice()">
                            </div>
                            <div class="col-md-3">
                                <input id="invoice-price" type="text" class="form-control" placeholder="Ποσό" v-model="fund.invoicePrice" v-on:keyup.enter="focusPayment(order)">
                            </div>
                        </div>
                        <div class="form-group" v-if="fund.isCreditNote">
                            <label class="col-md-3 control-label">Πιστωτικό</label>
                            <div class="col-md-5">
                                <input id="credit-number" type="text" class="form-control" placeholder="Αριθμός Πιστωτικού" v-model="fund.credit" v-on:keyup.enter="focusCreditPrice()">
                            </div>
                            <div class="col-md-3">
                                <input id="credit-price" type="text" class="form-control" placeholder="Ποσό" v-model="fund.creditPrice" v-on:keyup.enter="saveFund()">
                            </div>
                        </div>
                        <div class="form-group" v-if="fund.isReceipt">
                            <label class="col-md-3 control-label">Απόδειξη</label>
                            <div class="col-md-5">
                                <input id="receipt-name" type="text" class="form-control" placeholder="Αριθμός Δελτίου Απόδειξης" v-model="fund.receipt" v-on:keyup.enter="receiptNext()">
                            </div>
                            <div class="col-md-3">
                                <input id="receipt-value" type="text" class="form-control" placeholder="Ποσό" v-model="fund.receiptPrice" v-on:keyup.enter="focusPayment(order)">
                            </div>
                        </div>
                        <div class="form-group" v-if="!fund.isInvoice && !fund.isReceipt && !fund.isCreditNote">
                            <label class="col-md-3 control-label">Ανταλλακτικό</label>
                            <div class="col-md-5">
                                <select id="parts-select" class="form-control">
                                    <option></option>
                                    <option v-for="part in parts" :value="part.id">{{part.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input id="quantity-name" type="number" value="1" class="form-control" placeholder="Ποσότητα" v-model="fund.quantity" v-on:keyup.enter="focusCar(order.price)">
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:;" onclick="app5.$modal.show('newpart');$('select').select2('close')" class="btn btn-circle red-sunglo ">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="form-group" v-if="!fund.isInvoice && !fund.isReceipt && !fund.isCreditNote">
                            <label class="col-md-3 control-label">Αυτοκίνητο</label>
                            <div class="col-md-2">
                                <input id="car-name" type="text" class="form-control" placeholder="Μοντέλο" v-model="fund.car" v-on:keyup.enter="focusCode(order)">
                            </div>
                            <div class="col-md-3">
                                <input id="part-code" type="text" class="form-control" placeholder="Κωδικός" v-model="fund.part_code" v-on:keyup.enter="focusPrice(order)">
                            </div>
                            <div class="col-md-2">
                                <input id="part-name" type="text" class="form-control" placeholder="Τιμή" v-model="order.price" v-on:keyup.enter="pushOrder(order)">
                            </div>
                        </div>
                        <div class="form-group" v-if="fund.isProvince">
                            <label class="col-md-3 control-label">Τρόπος Αποστολής</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Τρόπος Αποστολής" v-model="fund.provinceWay">
                            </div>
                            <label class="col-md-2 control-label">Κωδικός</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Κωδικός" v-model="fund.provinceCode">
                            </div>
                        </div>
                        <div class="form-group" v-if="orders.length > 0 && !fund.isInvoice && !fund.isReceipt && !fund.isCreditNote">
                            <label class="col-md-3 control-label">Ανταλλακτικά:</label>
                            <div class="col-md-8">
                                <table style="width:88%;" class="table table-striped">
                                    <tr v-for="(order , index) in orders">
                                        <td>{{order.name}}</td>
                                        <td style="width:22%;">
                                            <input style="width: 90%;margin-right: 13px;" type="text" class="form-control pull-right" placeholder="Κωδικός" v-model="order.part_code">
                                        </td>
                                        <td style="width:10%;">
                                            <input type="number" class="form-control pull-right" placeholder="Ποσότητα" v-model="order.quantity">
                                        </td>
                                        <td>
                                            <input :id="'car' + index" style="width:90%;" type="text" class="form-control pull-right" placeholder="Μοντέλο" v-model="order.car_model">
                                        </td>
                                        <td class="" style="margin-right: 5px;width: 90px;">
                                            <input :id="'order' + index" style="width:70%;" type="text" class="form-control pull-right" placeholder="Τιμή" v-model="order.price" v-on:keyup.enter="nextOrderFocus(index)">
                                        </td>
                                        <td>
                                            €
                                        </td>
                                        <td class=" remove-order">
                                            <a @click="removeOrder(index)">
                                                <i style="margin-top: 0px;" class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td style="width:70px;">
                                            <input :id="'sum' + index" type="text" class="form-control pull-right" placeholder="Τιμή" @change="calculatePrice(order , index)" :value="(order.quantity * parseFloat(String(order.price).replace(',', '.') , 2)).toFixed(2)">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <hr/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">
                                            Σύνολο: {{orderSum()}}€
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group" v-if="!fund.isCreditNote">
                            <label class="col-md-3 control-label">Πληρωμή</label>
                            <div class="col-md-1" style="margin-top: 8px;">
                                <div class="md-checkbox">
                                    <input v-model="fund.hasPay" type="checkbox" id="checkbox2_4" name="checkboxes2[]" value="1" class="md-check" @click="focusPayment()">
                                    <label for="checkbox2_4">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3" v-if="fund.hasPay">
                                <input id="payment-input" type="text" class="form-control" placeholder="Ποσό" v-model="fund.payment" v-on:keyup.enter="focusDeliveries()">
                            </div>
                            <div class="col-md-1" style="margin-left: -20px;margin-top: 6px;" v-if="fund.hasPay">
                                €
                            </div>
                            <label class="col-md-1 control-label"  v-if="fund.hasPay">Τράπεζα</label>
                            <div class="col-md-1" style="margin-top: 8px;"  v-if="fund.hasPay">
                                <div class="md-checkbox">
                                    <input v-model="fund.isBank" type="checkbox" id="checkbox2_44" name="checkboxes2[]" value="1" class="md-check">
                                    <label for="checkbox2_44">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Διανομέας</label>
                            <div class="col-md-7">
                                <select id="delivery-select" class="form-control" v-model="fund.delivery_id">
                                    <option></option>
                                    <option v-for="delivery in deliveries" :value="delivery.id">{{delivery.name}} {{delivery.surname}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Σχόλια</label>
                            <div class="col-md-7" style="margin-top: 8px;">
                                <div class="md-checkbox">
                                  <textarea class="form-control" rows="5" id="comment" v-model="fund.comments" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button :disable="disable" type="button" class="btn green pull-right" @click="saveFund()" style="margin-right: 40px;">Αποθήκευση</button>
                        <button type="button" class="btn default pull-right" @click="closeModal()">Ακύρωση</button>
                    </div>
                </form>
            </div>
        </div>
        <newcustomer @customeradd="getCustomers()"></newcustomer>
        <editcustomer @customeradd="getCustomers()"></editcustomer>
        <newpart @partadd="getParts()"></newpart>
        <editpart @partadd="getParts()"></editpart>
    </modal>
</template>
<script>
export default {
  name: "ExampleModal",
  data() {
    return {
      time: 0,
      disable: true,
      customers: "",
      deliveries: "",
      orders: [],
      fund: {
        isInvoice: false,
        isReceipt: false,
        isProvince: false,
        isCreditNote: false,
        isBank: false,
        hasPay: false,
        payment: "",
        payment: 0
      },
      order: {},
      parts: {},
      duration: 5000
    };
  },
  methods: {
    beforeOpen(event) {
      this.orders = [];
      this.selectedFund = [];
      this.order.price = "";
      this.customers = app5.allCustomers;
      this.deliveries = app5.deliveries;
      this.getParts(event.params.fund.customer_id);
      this.fund.isReceipt = 0;
      this.fund.isInvoice = 0;
      this.fund.isProvince = 0;
      this.fund.isCreditNote = 0;
      this.fund.isOffer = 0;
      this.fund.isBank = 0;
      this.fund.quantity = 1;
      this.fund.invoice = "";
      this.fund.invoicePrice = "";
      this.fund.receipt = "";
      this.fund.credit = "";
      this.fund.creditPrice = "";
      this.fund.receiptPrice = "";
      var self = this;
      setTimeout(() => {
        $("select")
          .select2()
          .on("select2:open", function() {
            $(".select2-dropdown").removeClass("select2-dropdown--above");
            $(".select2-dropdown").addClass("select2-dropdown--below");
          })
          .on("change", function(e) {
            setTimeout(function() {
              $("#part-name").focus();
            }, 30);
          })
          .on("select2:close", function() {
            setTimeout(function() {
              $("#part-name").focus();
            }, 30);
          });
      }, 30);
      setTimeout(function() {
        $("#customers-select").on("select2:selecting", function(e) {
          $("#parts-select").select2("open");
          setTimeout(function() {
            $("input.select2-search__field").focus();
            app5.selectedCustomer = $("#customers-select").val();
            $("span#select2-customers-select-container").append(
              '<span class="pull-right" onclick="app5.editCustomer();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
            );
          }, 100);
        });
        $("#delivery-select").on("select2:closing", function(e) {
          setTimeout(() => {
            self.saveFund();
          }, 100);
        });
        $("#parts-select")
          .on("change", function(e) {
            setTimeout(function() {
              $("#quantity-name").focus();
            }, 150);
          })
          .on("select2-close", function() {
            setTimeout(function() {
              $("#quantity-name").focus();
            }, 150);
          })
          .on("select2:close", function() {
            setTimeout(function() {
              $("#quantity-name").focus();
            }, 150);
          });
      }, 30);
      this.selectedFund = event.params.fund;
      this.fund.isInvoice = this.selectedFund.isInvoice == 1 ? 1 : 0;
      this.fund.isReceipt = this.selectedFund.isReceipt == 1 ? 1 : 0;
      this.fund.isProvince = this.selectedFund.isProvince == 1 ? 1 : 0;
      this.fund.isCreditNote = this.selectedFund.credit ? 1 : 0;
      this.fund.isOffer = this.selectedFund.isOffer ? 1 : 0;
      this.fund.isBank = this.selectedFund.isBank ? 1 : 0;
      this.fund.hasPay = this.selectedFund.hasPay == 1 ? 1 : 0;
      this.fund.payment = this.selectedFund.payment;
      this.fund.provinceWay = this.selectedFund.provinceWay;
      this.fund.provinceCode = this.selectedFund.provinceCode;
      this.fund.car_model = this.selectedFund.car_model;
      this.fund.comments = this.selectedFund.comments;
      this.fund.delivery_id = this.selectedFund.delivery_id;
      
      if(this.fund.isOffer && this.fund.body.indexOf('Είσπραξη') > -1){
        this.fund.body = '';
      }
      
      if (this.selectedFund.isInvoice == 1) {
        this.fund.invoice = this.selectedFund.body.substring(13, 100);
        this.fund.invoicePrice = this.selectedFund.cost;
      }
      if (this.selectedFund.isReceipt == 1) {
        this.fund.receipt = parseInt(this.selectedFund.body.substring(12, 100));
        this.fund.receiptPrice = this.selectedFund.cost;
      }
      if (this.fund.isCreditNote == 1) {
        this.fund.credit = parseInt(this.selectedFund.body.substring(17, 100));
        this.fund.creditPrice = this.selectedFund.credit;
      }
      var partsList = event.params.fund.body.split(",");
      if (event.params.fund.parts_codes != null) {
        var partsCodesList = event.params.fund.parts_codes.split("%");
      }
      if (event.params.fund.cars) {
        var carsList = event.params.fund.cars.split(",");
      } else {
        var carsList = "";
      }
      var costsList = event.params.fund.price.split("%");
      for (var index = 0; index < partsList.length; index++) {
        if (partsCodesList != null) {
          var orderPart =
            partsCodesList[index].indexOf("*") > -1
              ? partsCodesList[index].split("*")[0]
              : partsCodesList[index];
        } else {
          var orderPart = " ";
        }
        this.orders.push({
          name:
            partsList[index].indexOf("*") > -1
              ? partsList[index].split("*")[1]
              : partsList[index],
          part_code: orderPart,
          quantity:
            partsList[index].indexOf("*") > -1
              ? parseInt(partsList[index].split("*")[0])
              : 1,
          price: costsList[index],
          car_model: carsList[index]
        });
      }
    },
    beforeClose(event) {
      $("#customers-select").select2("destroy");
      $("#delivery-select").select2("destroy");
      $("#parts-select").select2("destroy");
    },
    focusDeliveries(){
      $("#delivery-select").select2("open");
      setTimeout(function() {
        $("input.select2-search__field").focus();
      }, 100);
    },
    closeModal() {
      this.$modal.hide("editincome");
    },
    receiptNext() {
      $("#receipt-value").focus();
    },
    calculatePrice(order, index) {
      var sum = parseFloat($("#sum" + index).val());
      order.price = (sum / order.quantity).toFixed(2);
    },
    orderSum: function() {
      var sum = 0;
      for (var index = 0; index < this.orders.length; index++) {
        console.log();

        sum +=
          this.orders[index].quantity *
          parseFloat(String(this.orders[index].price).replace(",", "."), 2);
      }
      return sum.toFixed(2);
    },
    getCustomers: function() {
      axios
        .get(api + "all-customers")
        .then(response => {
          this.customers = response.data;
          setTimeout(function() {
            if (app5.addedCustomer != "") {
              $("#customers-select")
                .val(app5.addedCustomer)
                .trigger("change");
              $("#parts-select").select2("open");
              setTimeout(function() {
                $("input.select2-search__field").focus();
                $("span#select2-customers-select-container").append(
                  '<span class="pull-right" onclick="app5.editCustomer();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
                );
              }, 100);
            }
            app5.addedCustomer = "";
          }, 200);
        })
        .catch(e => {
          console.log(e);
        });
    },
    pushOrder: function() {
      if ($("select#parts-select").val() == "") {
        $("#order0").focus();
      }
      if (this.order.price && $("#parts-select").val() && this.fund.car) {
        var sum = parseFloat(
          String($("#part-name").val()).replace(",", "."),
          2
        );
        this.orders.push({
          name: $("span#select2-parts-select-container").text(),
          part_code: this.fund.part_code,
          price: (sum / this.fund.quantity).toFixed(2),
          car_model: this.fund.car,
          quantity: this.fund.quantity
        });
        this.order.price = "";
        this.fund.part_code = "";
        $("#parts-select")
          .val("")
          .trigger("change");
        $("#parts-select").select2("open");
        setTimeout(function() {
          $("input.select2-search__field").focus();
        }, 350);
      }
    },
    focusPrice: function(index) {
      setTimeout(function() {
        $("#part-name").focus();
      }, 200);
    },
    focusCode: function(index) {
      setTimeout(function() {
        $("#part-code").focus();
      }, 200);
    },
    focusCar(price) {
      $("#car-name").focus();
      // if (price != '') {
      //     $('#car-name').focus();
      // } else if (this.orders.length > 0 && $("#parts-select").val() == '') {
      //     $('#order0').focus();
      // }
    },
    focusInvoicePrice() {
      $("#invoice-price").focus();
    },
    focusCreditPrice() {
      $("#credit-price").focus();
    },
    nextOrderFocus(index) {
      if (index + 1 < this.orders.length) {
        $("#order" + (index + 1)).focus();
      } else {
        if (this.fund.hasPay) {
          $("#payment-input").focus();
        } else {
          this.saveFund();
        }
      }
    },
    destroySelectCustomer: function(type) {
      $("select").select2("close");
      if (
        this.fund.isInvoice ||
        this.fund.isReceipt ||
        this.fund.isCreditNote
      ) {
        if (type == 0) {
          this.fund.isReceipt = false;
          this.fund.isCreditNote = false;
        } else {
          this.fund.isInvoice = false;
          this.fund.isCreditNote = false;
        }
        if (type == 2) {
          this.fund.isReceipt = false;
          this.fund.isInvoice = false;
          this.fund.isCreditNote = true;
        }
        if (type == 1) {
          if (!this.fund.isInvoice) {
            setTimeout(() => {
              $("#customers-select")
                .val("1")
                .trigger("change");
              $("#receipt-name").focus();
            }, 50);
          }
        } else {
          if (this.fund.isInvoice) {
            if ($("#customers-select").val() == "") {
              setTimeout(function() {
                $("#customers-select")
                  .select2("open")
                  .on("change", function(e) {
                    setTimeout(function() {
                      $("#invoice-number").focus();
                    }, 30);
                  });
              }, 600);
            } else {
              setTimeout(() => {
                $("#invoice-number").focus();
                $("#customers-select").on("change", function(e) {
                  setTimeout(function() {
                    $("#invoice-number").focus();
                    $("#customers-select").on("change", function(e) {
                      setTimeout(function() {
                        $("#credit-number").focus();
                      }, 30);
                    });
                  }, 30);
                });
              }, 500);
            }
          } else if (this.fund.isCreditNote) {
            if ($("#customers-select").val() == "") {
              setTimeout(function() {
                $("#customers-select")
                  .select2("open")
                  .on("change", function(e) {
                    setTimeout(function() {
                      $("#credit-number").focus();
                    }, 30);
                  });
              }, 600);
            } else {
              setTimeout(() => {
                $("#credit-number").focus();
                $("#customers-select").on("change", function(e) {
                  setTimeout(function() {
                    $("#credit-number").focus();
                  }, 30);
                });
              }, 500);
            }
          }
        }
        $("#parts-select").select2("destroy");
        return;
      }
      setTimeout(() => {
        $("select")
          .select2()
          .on("select2:open", function() {
            $(".select2-dropdown").removeClass("select2-dropdown--above");
            $(".select2-dropdown").addClass("select2-dropdown--below");
          });
      }, 30);
      // $('#customers-select').val('').trigger("change");
      return;
    },
    removeOrder: function(index) {
      this.orders.splice(index, 1);
    },
    focusPayment: function(index) {
      setTimeout(function() {
        $("#payment-input").focus();
      }, 200);
    },
    getParts: function(id) {
      this.parts = [];
      axios
        .get(api + "all-parts")
        .then(response => {
          this.parts = response.data;
          setTimeout(function() {
            if (app5.addedPart != "") {
              $("#parts-select")
                .val(app5.addedPart)
                .trigger("change");
              $("span#select2-parts-select-container").append(
                '<span class="pull-right" onclick="app5.editPart();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
              );
            }
            app5.addedPart = "";
          }, 200);
          setTimeout(() => {
            $("#customers-select")
              .val(id)
              .trigger("change");
            $("span#select2-customers-select-container").append(
              '<span class="pull-right" onclick="app5.editCustomer();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
            );
            app5.selectedCustomer = $("#customers-select").val();
          }, 100);
        })
        .catch(e => {
          console.log(e);
        });
    },
    saveFund: function() {
      $("#car0").focus();
      $("select").select2("close");
      this.fund.customer_id = $("#customers-select").val();
      this.fund.delivery_id = $("#delivery-select").val();
      if (this.fund.customer_id == "") {
        toastr.warning("Δεν έχει οριστεί πελάτης");
        return;
      }
      if (
        this.fund.isInvoice ||
        this.fund.isReceipt ||
        this.fund.isCreditNote
      ) {
        if (this.fund.isInvoice) {
          if (this.fund.invoice == "") {
            toastr.warning("Ορίστε Αριθμό τιμολογίου");
            $.unblockUI();
            return;
          }
          if (this.fund.invoicePrice == "") {
            toastr.warning("Ορίστε ποσό τιμολογίου");
            $.unblockUI();
            return;
          }
          this.fund.body = "Αριθ. Τιμόλ.:" + this.fund.invoice;
          this.fund.price = parseFloat(
            String(this.fund.invoicePrice).replace(",", ".")
          );
          this.fund.cost = this.fund.price;
        } else if (this.fund.isReceipt) {
          if (this.fund.receipt == "") {
            toastr.warning("Ορίστε Αριθμό Απόδειξης");
            $.unblockUI();
            return;
          }
          if (this.fund.receiptPrice == "") {
            toastr.warning("Ορίστε ποσό απόδειξης");
            $.unblockUI();
            return;
          }
          this.fund.body = "Αριθ. Απόδ.:" + this.fund.receipt;
          this.fund.cost = parseFloat(
            String(this.fund.receiptPrice).replace(",", ".")
          );
          this.fund.price = parseFloat(
            String(this.fund.receiptPrice).replace(",", ".")
          );
        } else {
          if (this.fund.credit == "") {
            toastr.warning("Ορίστε Αριθμό Πιστωτικού");
            $.unblockUI();
            return;
          }
          if (this.fund.creditPrice == "") {
            toastr.warning("Ορίστε ποσό πιστωτικού");
            $.unblockUI();
            return;
          }
          this.fund.creditPrice = parseFloat(
            String(this.fund.creditPrice).replace(",", ".")
          );
          this.fund.body = "Αριθ. Πιστωτικού:" + this.fund.credit;
          this.fund.cost = 0;
          this.fund.price = 0;
        }
      } else {
        if (this.orders.length < 1) {
          if ($("#parts-select").val() == "" && this.fund.hasPay) {
            this.fund.body = "Είσπραξη";
            this.fund.cost = 0;
            this.fund.price = "0";
          } else {
            toastr.warning(
              "Δεν έχουν τοποθετηθεί ανταλλακτικά στην παραγγελία"
            );
            return;
          }
        }
        if (this.orders.length > 0) {
          var fundBody = this.orders[0].quantity + "*" + this.orders[0].name;
          var fundPartsCodes =
            this.orders[0].part_code != null ? this.orders[0].part_code : "%";
          var fundCars = this.orders[0].car_model;
          var fundModels = this.orders[0].car_model;
          this.orders[0].price = this.orders[0].price.replace(",", ".");
          var fundPrice = this.orders[0].price;
          var fundCost = parseFloat(this.orders[0].price);
          for (var index = 1; index < this.orders.length; index++) {
            fundBody =
              fundBody +
              "," +
              this.orders[index].quantity +
              "*" +
              this.orders[index].name;
            fundCars = fundCars + "," + this.orders[index].car_model;
            if (this.orders[index].part_code != null) {
              fundPartsCodes =
                fundPartsCodes + "%" + this.orders[index].part_code;
            } else {
              fundPartsCodes = fundPartsCodes + "%" + " ";
            }
            if (fundModels.indexOf(this.orders[index].car_model) < 0) {
              fundModels = fundModels + "%" + this.orders[index].car_model;
            }
            this.orders[index].price = this.orders[index].price.replace(
              ",",
              "."
            );
            fundPrice = fundPrice + "%" + this.orders[index].price;
            fundCost = fundCost + parseFloat(this.orders[index].price);
          }
          this.fund.body = fundBody;
          this.fund.parts_codes = fundPartsCodes;
          this.fund.car_model = fundModels;
          this.fund.cars = fundCars;
          this.fund.price = fundPrice;
          this.fund.cost = parseFloat(this.orderSum());
        }
      }
      if (this.fund.hasPay) {
        if (this.fund.isInvoice) {
          if (this.fund.payment == "") {
            this.fund.payment = 0;
          }
          this.fund.total =
            parseFloat(this.fund.cost) - parseFloat(this.fund.payment);
          this.fund.payment = parseFloat(
            String(this.fund.payment).replace(",", ".")
          );
        } else if (this.fund.isReceipt) {
          if (this.fund.payment == "") {
            this.fund.payment = 0;
          }
          this.fund.total =
            parseFloat(this.fund.cost) - parseFloat(this.fund.payment);
          this.fund.payment = parseFloat(
            String(this.fund.payment).replace(",", ".")
          );
        } else {
          if (this.fund.payment == "") {
            this.fund.payment = 0;
          }
          this.fund.total =
            parseFloat(this.fund.cost) - parseFloat(this.fund.payment);
          this.fund.payment = parseFloat(
            String(this.fund.payment).replace(",", ".")
          );
        }
      } else {
        if (this.fund.isInvoice) {
          this.fund.total = this.fund.invoicePrice;
        } else if (this.fund.isReceipt) {
          this.fund.total = parseFloat(
            String(this.fund.receiptPrice).replace(",", ".")
          );
        } else {
          this.fund.total = fundCost;
        }
        this.fund.payment = 0;
      }
      if (app5.isfromquery) {
        if ($("#dateFrom").val() == "") {
          toastr.warning("Δεν έχει οριστεί ημερομηνία");
          $.unblockUI();
          return;
        }
        this.fund.pastDate = $("#dateFrom")
          .val()
          .split("/");
      }
      this.closeModal();
      axios
        .post(api + "update-fund/" + this.selectedFund.id, this.fund)
        .then(response => {
          this.$emit("fundupdated");
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  created() {}
};
</script>
