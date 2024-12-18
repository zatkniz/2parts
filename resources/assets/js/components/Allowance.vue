<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Όνομα </th>
                    <th style="width:200px;"> Ημέρες </th>
                    <th> Ημερομηνία Έναρξης </th>
                    <th> Λόγος </th>
                    <th> Υπόλοιπο </th>
                    <th> Ενέργειες </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(allowance , index) in allowances">
                    <td> {{index + 1}} </td>
                    <td> {{allowance.employee.name}} {{allowance.employee.surname}} </td>
                    <td> {{allowance.days}} </td>
                    <td> {{allowance.start_date}} </td>
                    <td> {{allowance.reason}} </td>
                    <td :id="'remain' + index">{{ calculateRemainingDays(allowance , index) }}</td>
                    <td>
                        <a @click="completeDuty(allowance)" class="btn btn-outline btn-circle dark btn-sm red">
                            <i class="fa fa-trash-o"></i> Διαγραφή
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <newallowance></newallowance>
        <deleteallowance></deleteallowance>
    </div>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            allowances: [],
            remaining: 0
        }
    },
    methods: {
        calculateRemainingDays(allowance, index) {
            if (index == 0) {
                this.remaining = parseInt(allowance.employee.absent_days) - allowance.days
                return this.remaining
            }
            this.remaining = this.remaining - allowance.days
            return this.remaining
        },
        editAllowance: function(allowance) {
            app5.newAllowanceModal(allowance);
        },
        completeDuty: function(duty) {
            app5.deleteAllowance(duty);
        },
        getAllowance: function() {
            axios.get(api + 'allowance/' + employee.id)
                .then(response => {
                    this.allowances = response.data;
                })
                .catch(e => {
                    console.log(e)
                })
        }
    },
    created() {
        this.getAllowance();
    },

    props: ['employee'],
}
</script>
