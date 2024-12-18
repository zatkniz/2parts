<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Όνομα </th>
                    <th style="width:200px;"> Εκκρεμότητα </th>
                    <th> Ημερομηνία Καταχώρησης </th>
                    <th> Ημερομηνία Εκκρεμότητας </th>
                    <th> Ολοκλήρωση </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(duty , index) in duties">
                    <td> {{index + 1}} </td>
                    <td> {{duty.user.name}} </td>
                    <td> {{duty.body}} </td>
                    <td> {{moment(duty.created_at)}} </td>
                    <td> {{duty.end_date}} </td>
                    <td>
                        <a @click="editDuty(duty)" class="btn btn-outline btn-circle btn-sm purple">
                            <i class="fa fa-edit"></i> Επεξεργασία
                        </a>
                        <a @click="completeDuty(duty)" class="btn btn-outline btn-circle dark btn-sm red">
                            <i class="fa fa-trash-o"></i> Ολοκλήρωση
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <newduty></newduty>
        <completeduty></completeduty>
    </div>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            duties: []
        }
    },
    methods: {
        moment: function(time) {
            time = time.split(' ');
            var date = time[0].split('-');
            return date[2] + '/' + date[1] + '/' + date[0];
        },
        editDuty: function(duty) {
            app5.newDutyModal(duty);
        },
        completeDuty: function(duty) {
            app5.completeDutyModal(duty);
        },
        getDuties: function() {
            axios.get(api + 'all-duties')
                .then(response => {
                    this.duties = response.data;
                })
                .catch(e => {
                    console.log(e)
                })
        }
    },
    created() {
        this.getDuties();
    },
}
</script>
