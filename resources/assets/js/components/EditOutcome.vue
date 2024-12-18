<template>
    <modal name="editoutcome" height="auto" @before-open="beforeOpen" @before-close="beforeClose" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Επεξεργασία Εξόδου
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
        price: "",
        id: ""
      }
    };
  },
  methods: {
    beforeOpen(event) {
      this.outcome.price = "";
      this.outcome.price = event.params.outcome.total;
      this.outcome.id = event.params.outcome.id;
      this.outcome.delivery_id = event.params.outcome.delivery_id;
      app5.selectedOutfund = event.params.outcome.outcome.id;
      this.deliveries = app5.deliveries;
      this.getOutcomes(event.params.outcome.outcome.id);
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
            app5.selectedOutfund = $("#customers-select").val();
            $("span#select2-customers-select-container").append(
              '<span class="pull-right" onclick="app5.editOutcome().val());"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
            );
          }, 100);
        });
        $("#parts-select").on("select2:selecting", function(e) {
          setTimeout(function() {
            app5.selectedOutfund = $("#parts-select").val();
            $("#car-name").focus();
            $("span#select2-parts-select-container").append(
              '<span class="pull-right" onclick="app5.editOutcome().val());"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
            );
          }, 100);
        });
        $("#delivery-select").on("select2:selecting", function(e) {
          setTimeout(() => {
            self.saveOutcome();
          }, 100);
        });
      }, 30);
    },
    beforeClose(event) {
      $("#parts-select").select2("destroy");
      $("#delivery-select").select2("destroy");
      this.outcome.price = "";
    },
    closeModal() {
      this.$modal.hide("editoutcome");
    },
    focusDeliveries(){
      $("#delivery-select").select2("open");
      setTimeout(function() {
        $("input.select2-search__field").focus();
      }, 100);
    },
    getOutcomes: function(id) {
      this.parts = [];
      axios
        .get(api + "outcomes")
        .then(response => {
          this.parts = response.data;
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
          }, 200);
          if (app5.addedOutcome == "") {
            setTimeout(function() {
              $("#parts-select")
                .val(id)
                .trigger("change");
              $("span#select2-parts-select-container").append(
                '<span class="pull-right" onclick="app5.editOutcome();"><i class="fa fa-cogs" aria-hidden="true"></i></span>'
              );
            }, 500);
          }
          setTimeout(function() {
            app5.addedOutcome = "";
          }, 700);
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
        toastr.warning("Δεν έχει οριστεί τιμή");
        return;
      }
      this.outcome.price = parseFloat(
        String(this.outcome.price).replace(",", ".")
      );
      axios
        .post(api + "update-outfund/" + this.outcome.id, this.outcome)
        .then(response => {
          this.$emit("outcomeadd");
          this.closeModal();
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  created() {}
};
</script>

