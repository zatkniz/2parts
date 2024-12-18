<template>
    <modal name="editcustomer" @before-open="beforeOpen" height="auto" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Γρήγορη Προσθήκη Πελάτη
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('editcustomer')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Πελάτης</label>
                            <div class="col-md-8">
                                <input id="customer-input" type="text" class="form-control" placeholder="Όνομα Πελάτη" v-model="customer.name" v-on:keyup.enter="editCustomer()">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button style="margin-right: 40px;" type="button" class="btn green pull-right" @click="editCustomer()">Ενημέρωση</button>
                        <!-- <button type="button" class="btn red pull-right" @click="deleteCustomer()">Διαγραφή</button> -->
                        <button type="button" class="btn default pull-right" @click="$modal.hide('editcustomer')">Ακύρωση</button>
                    </div>
                </form>
            </div>
        </div>
    </modal>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            time: 0,
            duration: 5000,
            customer: {
                name: '',
                id: ''
            }
        }
    },
    methods: {
        beforeOpen(event) {
            axios.get(api + 'quick-find-customer/' + app5.selectedCustomer)
                .then(response => {
                    this.customer.name = response.data.name;
                    this.customer.id = response.data.id;
                })
                .catch(e => {
                    console.log(e)
                })
        },
        editCustomer() {
            axios.post(api + 'quick-edit-customer/' + this.customer.id, this.customer)
                .then(response => {
                    app5.addedCustomer = response.data.id;
                    this.$emit('customeradd', response);
                    this.customer = {
                        name: '',
                    };
                    this.$modal.hide('editcustomer');
                })
                .catch(e => {
                    console.log(e)
                })
        },
        deleteCustomer() {
            axios.post(api + 'quick-delete-customer/' + this.customer.id, this.customer)
                .then(response => {
                    app5.addedCustomer = response.data.id;
                    this.$emit('customeradd', response);
                    this.customer = {
                        name: '',
                    };
                    this.$modal.hide('editcustomer');
                })
                .catch(e => {
                    console.log(e)
                })
        },
    },


    mounted() {

    },
}
</script>
