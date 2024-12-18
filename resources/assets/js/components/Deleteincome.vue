<template>
    <modal name="deleteincome" height="auto" @before-open="beforeOpen" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Διαγραφή Εσόδου
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('deleteincome')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group" style="margin-left: 25px;">
                            Είστε σίγουρος ότι θέλετε να διαγράψετε την εγγραφή με ποσό παρραγελίας {{selectedFund.cost}}€?
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button type="button" class="btn green pull-right" @click="deleteFund()" style="margin-right: 40px;">Διαγραφή</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('deleteincome')">Ακύρωση</button>
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
    name: 'ExampleModal',
    data() {
        return {
            time: 0,
            customers: '',
            selectedFund: [],
            orders: [
            ],
            fund: {},
            order: {},
            parts: {},
            duration: 5000,

        }
    },
    methods: {
        beforeOpen(event) {
            this.orders = [];
            this.selectedFund = [];
            this.order.price = '';
            this.getCustomers();
            this.getParts();
            setTimeout(() => {
                $('select').select2().on('select2:open', function() {
                    $('.select2-dropdown').removeClass('select2-dropdown--above');
                    $('.select2-dropdown').addClass('select2-dropdown--below');
                }).on("change", function(e) {
                    setTimeout(function() {
                        $("#part-name").focus()
                    }, 800);
                });
            }, 30);
            setTimeout(() => {
                $('#customers-select').val(event.params.fund.customer_id).trigger("change")
            }, 500);
            this.selectedFund = event.params.fund;
            console.log(this.selectedFund);

            var partsList = event.params.fund.body.split(',');
            var costsList = event.params.fund.price.split(',');
            for (var index = 0; index < partsList.length; index++) {
                this.orders.push({
                    name: partsList[index],
                    price: costsList[index]
                })

            }
        },
        getCustomers: function() {
            axios.get(api + 'all-customers')
                .then(response => {
                    this.customers = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        pushOrder: function() {
            if (this.order.price && $("#parts-select").val()) {
                this.orders.push({
                    name: $("#parts-select").val(),
                    price: this.order.price
                })
            }
        },
        removeOrder: function(index) {
            this.orders.splice(index, 1)
        },
        getParts: function() {
            axios.get(api + 'all-parts')
                .then(response => {
                    this.parts = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        deleteFund: function() {
            var fundBody = this.orders[0].name;
            var fundPrice = parseInt(this.orders[0].price);
            var fundCost = parseInt(this.orders[0].price);
            for (var index = 1; index < this.orders.length; index++) {
                fundBody = fundBody + ',' + this.orders[index].name;
                fundPrice = fundPrice + ',' + this.orders[index].price;
                fundCost = fundCost + parseInt(this.orders[index].price);
            }
            this.fund.body = fundBody;
            this.fund.price = fundPrice;
            this.fund.cost = fundCost;
            this.fund.customer_id = this.selectedFund.customer_id;
            this.$modal.hide('deleteincome');
            axios.post(api + 'delete-fund/' + this.selectedFund.id, this.fund)
                .then(response => {
                    this.$emit('funddeleted');
                })
                .catch(e => {
                    console.log(e)
                })
        },
    },


    created() {
    },
}
</script>
