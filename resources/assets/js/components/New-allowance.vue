<template>
    <modal name="newallowanace" height="auto" width="60%" @before-open="beforeOpen" :adaptive="true" :scrollable="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Προσθήκη Αδείας για {{employee.name}} {{employee.surname}}
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('newallowanace')"> </a>
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
                            <label class="col-md-3 control-label">Ημέρες Άδειας</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Ημέρες" v-model="allowance.days">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Λόγος Άδειας</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" v-model="allowance.reason" v-on:keyup.enter="saveAllowance()"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button id="save-button" type="button" class="btn green pull-right" @click="saveAllowance()" style="margin-right: 40px;">Αποθήκευση</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('newallowanace')">Ακύρωση</button>
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
            employee: {
                id: '',
                name: '',
                surname: ''
            },
            allowance: {
                id: '',
                employee_id: '',
                days: '',
                start_date: '',
                reason: ''
            },
        }
    },
    methods: {
        beforeOpen(event) {
            this.employee = event.params.employee;
            this.allowance.employee_id = event.params.employee.id
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
        saveAllowance() {
            if ($('#duty-date').val() == '') {
                toastr.warning('Δεν έχει οριστεί ημερομηνία');
                return;
            }
            if (!this.allowance.reason) {
                toastr.warning('Δεν υπάρχει περιγραφή');
                return;
            }
            this.allowance.start_date = $('#duty-date').val();
            axios.post(api + 'save-allowance', this.allowance)
                .then(response => {
                    this.$modal.hide('newallowanace');
                    app5.$refs.allowance.getAllowance();
                })
                .catch(e => {
                    console.log(e)
                })
        },
        setEndDate() {
            this.allowance.start_date = $('#duty-date').val();
        },
    },

    created() {

    },

}
</script>
