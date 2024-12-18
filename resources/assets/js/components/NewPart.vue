<template>
    <modal name="newpart" @before-open="beforeOpen" height="auto" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Προσθήκη Νέου Εσόδου
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('newpart')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ανταλλακτικό</label>
                            <div class="col-md-8">
                                <input id="part-input" type="text" class="form-control" v-on:keyup="fastSearch()" placeholder="Ονομασία Ανταλλακτικού" v-model="part.name" v-on:keyup.enter="newPart()">
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                <tbody>
                                    <tr v-for="(listed , index ) in customers">
                                        <td>{{listed.name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button style="margin-right: 40px;" type="button" class="btn green pull-right" @click="newPart()">Προσθήκη</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('newpart')">Ακύρωση</button>
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
            part: {
                name: '',
            }
        }
    },
    methods: {
        beforeOpen(event) {
            setTimeout(function() {
                $('input#part-input').focus();
            }, 250);
        },
        newPart() {
            axios.post(api + 'new-part', this.part)
                .then(response => {
                    app5.addedPart = response.data.id;
                    this.$emit('partadd');
                    this.part = {
                        name: '',
                    };
                    this.$modal.hide('newpart');
                })
                .catch(e => {
                    console.log(e)
                })
        },
        fastSearch() {
            if (this.part.name.length > 0) {
                axios.post(api + 'fast-search-part', this.part)
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
