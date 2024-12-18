<template>
    <modal name="newduty" height="auto" width="60%" @before-open="beforeOpen" :adaptive="true" :scrollable="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Προσθήκη Νέας Εκκρεμότητας
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('newduty')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ημερομηνία</label>
                            <div class="col-md-2">
                                <input id="duty-date" type="text" class="form-control" placeholder="Ημερομηνία">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Εκκρεμότητα</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" v-model="duty.body" v-on:keyup.enter="saveDuty()"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button id="save-button" type="button" class="btn green pull-right" @click="saveDuty()" style="margin-right: 40px;">Αποθήκευση</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('newduty')">Ακύρωση</button>
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
        saveDuty() {
            if ($('#duty-date').val() == '') {
                toastr.warning('Δεν έχει οριστεί ημερομηνία');
                return;
            }
            if (!this.duty.body) {
                toastr.warning('Δεν υπάρχει περιγραφή');
                return;
            }
            this.duty.end_date = $('#duty-date').val();
            axios.post(api + 'save-duty', this.duty)
                .then(response => {
                    this.$modal.hide('newduty');
                    app5.$refs.duties.getDuties();
                    app5.$refs.dutycount.getCount();
                })
                .catch(e => {
                    console.log(e)
                })
        },
        setEndDate() {
            console.log('ss');

            this.duty.end_date = $('#duty-date').val();
        },
    },

    created() {

    },

}
</script>
