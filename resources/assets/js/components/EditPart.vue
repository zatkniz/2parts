<template>
    <modal name="editpart" @before-open="beforeOpen" height="auto" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Γρήγορη Προσθήκη Ανταλλακτικού
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('editpart')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ανταλλακτικό</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Ονομασία Ανταλλακτικού" v-model="part.name" v-on:keyup.enter="newPart()">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button type="button" class="btn green pull-right" @click="newPart()" style="margin-right: 50px;">Ενημέρωση</button>
                        <button type="button" class="btn red pull-right" @click="deletePart()">Διαγραφή</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('editpart')">Ακύρωση</button>
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
            part: {
                name: '',
            }
        }
    },
    methods: {
        beforeOpen(event) {
            axios.get(api + 'quick-find-part/' + app5.selectedPart)
                .then(response => {
                    this.part.name = response.data.name;
                    this.part.id = response.data.id;
                })
                .catch(e => {
                    console.log(e)
                })
        },
        newPart() {
            axios.post(api + 'quick-edit-part/' + this.part.id, this.part)
                .then(response => {
                    app5.addedPart = response.data.id;
                    this.$emit('partadd', response);
                    this.part = {
                        name: '',
                    };
                    this.$modal.hide('editpart');
                })
                .catch(e => {
                    console.log(e)
                })
        },
        deletePart() {
            axios.post(api + 'quick-delete-part/' + this.part.id, this.part)
                .then(response => {
                    app5.addedPart = response.data.id;
                    this.$emit('partadd', response);
                    this.part = {
                        name: '',
                    };
                    this.$modal.hide('editpart');
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
