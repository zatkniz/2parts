<template>
    <modal name="payroll" height="auto" width="40%" @before-open="beforeOpen" :scrollable="true" :adaptive="true">
        <div id="newoutcome" class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    Επεξεργασία Πληρωμής για {{employee.name}} {{employee.surname}}
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="" class="remove" data-original-title="" title="" @click="$modal.hide('payroll')"> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form" onsubmit="return false">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-6 text-right">Bonus</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.extras" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">Δώρο</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.gift" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">01 - 1</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_01_1" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">01 - 2</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_01_2" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">01 - 3</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_01_3" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">01 - 4</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_01_4" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">01 - 5</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_01_5" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">02 - 1</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_02_1" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">02 - 2</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_02_2" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">02 - 3</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_02_3" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">02 - 4</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_02_4" />€</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-right">02 - 5</div>
                            <div class="col-md-6"><input style="width:20%;" v-model="payroll.payroll_period_02_5" />€</div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button id="save-button" type="button" class="btn green pull-right" @click="savePayroll()" style="margin-right: 40px;">Αποθήκευση</button>
                        <button type="button" class="btn default pull-right" @click="$modal.hide('payroll')">Ακύρωση</button>
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
            employee: '',
            payroll: '',
        }
    },
    methods: {
        beforeOpen(event) {
            console.log(event.params.employee);
            
            this.employee = event.params.employee;
            this.payroll = event.params.employee.payroll ? event.params.employee.payroll : event.params.employee;
        },
        savePayroll() {
            axios.post(api + 'update-payroll', this.payroll)
                .then(response => {
                    location.reload();
                })
                .catch(e => {
                    console.log(e)
                })
        }
    },


    created() {
    },
}
</script>
