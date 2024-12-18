<template>
    <modal name="deleteoutcome" height="auto" @before-open="beforeOpen" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Διαγραφή Εσόδου
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('deleteoutcome')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group" style="margin-left: 25px;">
                            Είστε σίγουρος ότι θέλετε να διαγράψετε την εγγραφή?
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button type="button" class="btn green pull-right" @click="deleteOutfund()" style="margin-right: 40px;">Διαγραφή</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('deleteoutcome')">Ακύρωση</button>
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

        }
    },
    methods: {
        beforeOpen(event) {
            this.selectedOutfund = event.params.outfund;
        },
        deleteOutfund: function() {
            axios.post(api + 'delete-outfund/' + this.selectedOutfund.id, this.fund)
                .then(response => {
                    this.$emit('funddeleted');
                    this.$modal.hide('deleteoutcome');
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
