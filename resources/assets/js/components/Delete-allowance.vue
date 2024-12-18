<template>
    <modal name="deleteallowance" height="auto" width="30%" @before-open="beforeOpen" :adaptive="true" :scrollable="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Διαγραφή 'Αδειας
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('deleteallowance')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                Διαγραφή Αδείας?
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button id="save-button" type="button" class="btn green pull-right" @click="deleteallowance()" style="margin-right: 40px;">Ολοκλήρωση</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('deleteallowance')">Ακύρωση</button>
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
            duty: {
                id: '',
                body: '',
                end_date: ''
            }
        }
    },
    methods: {
        beforeOpen(event) {
            if (event.params.duty) {
                this.duty.body = event.params.duty.body;
                setTimeout(function() {
                    $('#duty-date').val(event.params.duty.end_date);
                }, 150);
                this.duty.id = event.params.duty.id;
            }
            console.log(event.params.duty.end_date);

            setTimeout(function() {
                $('#duty-date').datepicker({
                    format: 'dd/mm/yyyy',
                    orientation: 'bottom',
                    language: 'el',
                    todayHighlight: true,
                    todayBtn: 'linked',
                });

                $('#duty-date').on('changeDate', function(ev) {
                    $(this).datepicker('hide');
                });
            }, 500);
        },
        deleteallowance() {
            axios.post(api + 'delete-allowance/' + this.duty.id)
                .then(response => {
                    this.$modal.hide('deleteallowance');
                    app5.$refs.allowance.getAllowance();
                })
                .catch(e => {
                    console.log(e)
                })
        },
        setEndDate() {
            this.duty.end_date = $('#duty-date').val();
        },
    },

    created() {

    },

}
</script>
