<template>
    <ul class="media-list list-items">
        <li class="media" v-for="(user , index ) in users">
            <div class="media-status">
                <span class="badge badge-success">8</span>
            </div>
            <img class="media-object" src="http://administration.2-parts.gr/img/avatar3_small.jpg" alt="...">
            <div class="media-body">
                <h4 class="media-heading">{{user.name}}</h4>
                <div class="media-heading-sub"> {{user.role == 1 ? 'Administator' : 'Editor'}} </div>
            </div>
        </li>
    </ul>
</template>
<script>
export default {
    name: 'ExampleModal',
    data() {
        return {
            users: [],
        }
    },
    methods: {
        getAllusers() {
            axios.get(api + 'get-online-users')
                .then(response => {
                    this.users = response.data;                
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
    },
    mounted() {
        this.getAllusers();
    },
}
</script>
