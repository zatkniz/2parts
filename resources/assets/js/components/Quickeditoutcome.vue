<template>
    <modal name="quickeditoutcome" @before-open="beforeOpen" height="auto" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Γρήγορη Προσθήκη Εξόδου
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('quickeditoutcome')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Έξοδο</label>
                            <div class="col-md-8">
                                <input id="part-input" type="text" class="form-control" placeholder="Ονομασία Εξόδου" v-model="outcome.name" v-on:keyup.enter="editOutcome()">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button style="margin-right: 40px;" type="button" class="btn green pull-right" @click="editOutcome()">Αποθήκευση</button>
                        <button type="button" class="btn red pull-right" @click="deleteOutcome()">Διαγραφή</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('quickeditoutcome')">Ακύρωση</button>
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
            outcome: {
                name: '',
            }
        }
    },
    methods: {
        beforeOpen(event) {
            setTimeout(function() {
                $('input#part-input').focus();
            }, 100);
            axios.get(api + 'quick-find-outcome/' + event.params.outcome)
                .then(response => {
                    this.outcome.name = response.data.name;
                    this.outcome.id = response.data.id;
                })
                .catch(e => {
                    console.log(e)
                })
        },
        editOutcome() {
            axios.post(api + 'quick-edit-outcome/' + this.outcome.id, this.outcome)
                .then(response => {
                    app5.addedOutcome = response.data.id;
                    this.$emit('customeradd', response);
                    this.outcome = {
                        name: '',
                    };
                    this.$modal.hide('quickeditoutcome');
                })
                .catch(e => {
                    console.log(e)
                })
        },
        deleteOutcome() {
            axios.post(api + 'quick-delete-outcome/' + this.outcome.id, this.outcome)
                .then(response => {
                    app5.addedOutcome = response.data.id;
                    this.$emit('customeradd', response);
                    this.customer = {
                        name: '',
                    };
                    this.$modal.hide('quickeditoutcome');
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
