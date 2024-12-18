<template>
    <modal name="newcustomer" @before-open="beforeOpen" height="auto" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Γρήγορη Προσθήκη Πελάτη
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('newcustomer')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Πελάτης</label>
                            <div class="col-md-8">
                                <input id="customer-input" type="text" class="form-control" v-on:keyup="fastSearch()" placeholder="Όνομα Πελάτη" v-model="customer.name" v-on:keyup.enter="newCustomer()">
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                <tbody>
                                    <tr v-for="(listed , index ) in customers">
                                        <td>{{listed.name}} <span v-if="listed.active == 0">(ΑΝΕΝΕΡΓΟΣ)</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button style="margin-right: 40px;" type="button" class="btn green pull-right" @click="newCustomer()">Προσθήκη</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('newcustomer')">Ακύρωση</button>
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
            customers: [],
            customer: {
                name: '',
                id: ''
            }
        }
    },
    methods: {
        beforeOpen(event) {
            setTimeout(function() {
                $('input#customer-input').focus();
            }, 250);
        },
        newCustomer() {
            axios.post(api + 'new-customer', this.customer)
                .then(response => {
                    app5.addedCustomer = response.data.id;
                    app5.selectedCustomer = response.data.id;
                    this.$emit('customeradd', response);
                    this.customer = {
                        name: '',
                    };
                    this.$modal.hide('newcustomer');
                })
                .catch(e => {
                    console.log(e)
                })
        },
        fastSearch() {
            if (this.customer.name.length > 0) {
                axios.post(api + 'fast-search', this.customer)
                    .then(response => {
                        this.customers = response.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
                return;
            }
            this.customers = [];
        }
    },


    mounted() {

    },
}
</script>
