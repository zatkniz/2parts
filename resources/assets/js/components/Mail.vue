<template>
    <modal name="mail" height="auto" @before-open="beforeOpen" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Αποστολή Παραγγελίας
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('mail')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <input v-on:keyup.enter="sendMail()" style="margin: 0px 15px;width: 557px;" id="part-code" type="email" placeholder="email" class="form-control" v-model="selectedFund.customer.email">
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button type="button" class="btn green pull-right" @click="sendMail()" style="margin-right: 40px;">Αποστολή</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('mail')">Ακύρωση</button>
                    </div>
                </form>
            </div>
        </div>
        <newcustomer @customeradd="getCustomers()"></newcustomer>
        <newpart @partadd="getParts()"></newpart>
    </modal>
</template>
<script>
export default {
  name: "ExampleModal",
  data() {
    return {
      selectedFund: {
        customer: {
          email: ""
        }
      }
    };
  },
  methods: {
    beforeOpen(event) {
      this.selectedFund = event.params.fund;
    },
    sendMail: function() {
      axios
        .post(api + "send-pdf/" + this.selectedFund.id , this.selectedFund)
        .then(response => {
          toastr.success("Το mail εστάλει επιτυχώς.");
        })
        .catch(e => {
          console.log(e);
        });
      this.$modal.hide("mail");
    }
  },

  created() {}
};
</script>
