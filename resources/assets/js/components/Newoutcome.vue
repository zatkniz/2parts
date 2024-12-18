<template>
    <modal name="newoutcome" height="auto" @before-open="beforeOpen" @before-close="beforeClose" :adaptive="true" :scrollable="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Προσθήκη Νέου Εσόδου
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
                        <div class="form-group">
                            <label class="col-md-3 control-label">Έξοδο</label>
                            <div class="col-md-7">
                                <select id="parts-select" class="form-control">
                                    <option></option>
                                    <option v-for="part in parts" :value="part.id">{{part.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <a class="btn btn-circle red-sunglo" onclick="app5.$modal.show('addnewoutcome');$('select').select2('close')">
                                    <span>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ποσό</label>
                            <div class="col-md-7">
                                <input id="car-name" type="text" class="form-control" placeholder="Τιμή" v-model="outcome.price" v-on:keyup.enter="focusDeliveries()">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Διανομέας</label>
                            <div class="col-md-7">
                                <select id="delivery-select" class="form-control" v-model="outcome.delivery_id">
                                    <option></option>
                                    <option v-for="delivery in deliveries" :value="delivery.id">{{delivery.name}} {{delivery.surname}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button id="save-button" type="button" class="btn green pull-right" @click="saveOutcome()" style="margin-right: 40px;">Αποθήκευση</button>
                        <button type="button" class="btn default pull-right" @click="closeModal()">Ακύρωση</button>
                    </div>
                </form>
            </div>
        </div>
        <addnewoutcome @outcomeadd="getOutcomes()"></addnewoutcome>
        <quickeditoutcome @customeradd="getOutcomes()"></quickeditoutcome>
    </modal>
</template>
<script>
export default {
  name: "ExampleModal",
  data() {
    return {
      parts: {},
      deliveries: "",
      outcome: {
        name: "",
        price: ""
      }
    };
  },
  methods: {
    beforeOpen(event) {
      this.outcome.price = "";
      this.outcome.delivery_id = "";
      this.parts = app5.allParts;
      this.deliveries = app5.deliveries;
      var self = this;
      setTimeout(function() {
        $("#customers-select").on("select2:selecting", function(e) {
          setTimeout(function() {
            app5.selectedOutfund = $("#parts-select").val();
            $("span#select2-customers-select-container").append(
              '<span class="pull-right" onclick="app5.editOutcome();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
            );
          }, 100);
        });
        // $("#parts-select").on("select2:selecting", function(e) {
        //     $("#car-name").focus();
        // });
        $("#delivery-select").on("select2:selecting", function(e) {
          setTimeout(() => {
            self.saveOutcome();
          }, 100);
        });
      }, 30);
      setTimeout(function() {
        $("#parts-select").select2("open");
      }, 150);
    },
    beforeClose(event) {
      $("#parts-select").select2("destroy");
      $("#delivery-select").select2("destroy");
    },
    closeModal() {
      this.$modal.hide("newoutcome");
    },
    focusDeliveries(){
      if(this.outcome.price)
        $("#delivery-select").select2("open");
        setTimeout(function() {
          $("input.select2-search__field").focus();
        }, 100);
    },
    getOutcomes: function() {
      this.parts = [];
      axios
        .get(api + "outcomes")
        .then(response => {
          this.parts = response.data;
          app5.selectedOutfund = $("#parts-select").val();
          setTimeout(function() {
            if (app5.addedOutcome != "") {
              $("#parts-select")
                .val(app5.addedOutcome)
                .trigger("change");
              $("span#select2-parts-select-container").append(
                '<span class="pull-right" onclick="app5.editOutcome();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
              );
              $("#car-name").focus();
            }
            app5.addedOutcome = "";
          }, 200);
        })
        .catch(e => {
          console.log(e);
        });
    },
    saveOutcome: function() {
      this.outcome.name = $("#parts-select").val();
      this.outcome.delivery_id = $("#delivery-select").val();
      if ($("span#select2-parts-select-container").text() == "") {
        toastr.warning("Δεν έχει οριστεί έξοδο");
        return;
      }
      if (this.outcome.price == "") {
        // toastr.warning("Δεν έχει οριστεί τιμή");
        return;
      }
      if (app5.isfromquery) {
        if ($("#dateFrom").val() == "") {
          toastr.warning("Δεν έχει οριστεί ημερομηνία");
          $.unblockUI();
          return;
        }
        this.outcome.pastDate = $("#dateFrom")
          .val()
          .split("/");
      }
      this.outcome.price = parseFloat(
        String(this.outcome.price).replace(",", ".")
      );
      axios
        .post(api + "save-outcome", this.outcome)
        .then(response => {
          this.$emit("outcomeadd");
        })
        .catch(e => {
          console.log(e);
        });
      this.closeModal();
    }
  },

  created() {}
};
</script>
