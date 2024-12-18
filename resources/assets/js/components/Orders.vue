<template>
    <div>
        <button style="float:right;" class="float-right btn" type="button" @click="newOrder()">NEA</button>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Μάρκα</th>
                <th scope="col">Κωδικός</th>
                <th scope="col">Ποσότητα</th>
                <th scope="col">Παρατηρήσεις</th>
                <th scope="col">Χρήστης</th>
                <th scope="col">Ενέργειες</th>
                </tr>
            </thead>
            <tbody>
                <tr v-show="!order.for_remove" v-bind:class="{ 'strikeout': order.done , 'remove' : order.for_remove }" v-for="(order,i) in orders" :key="i">
                    <th scope="row">
                       <div class="checkbox">
                         <label>
                            <input @click="saveOrders()" style="margin-top: 10px;" type="checkbox" v-model="order.done">
                        </label>
                    </div>
                    </th>
                    <td><input style="margin-top: 10px;" v-model="order.brand" /></td>
                    <td><input style="margin-top: 10px;" v-model="order.code" /></td>
                    <td><input style="margin-top: 10px;" v-model="order.quantity" /></td>
                    <td><input style="margin-top: 10px;" v-model="order.info" /></td>
                    <td style="margin-top: 10px;">{{ order.user ? order.user.name : '' }}</td>
                    <td style="margin-top: 10px;">       
                        <button style="float:right;" class="float-right btn" type="button" @click="remove(i)">Διαγραφή</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button style="float:right;" class="float-right btn" type="button" @click="saveOrders()">ΑΠΟΘΗΚΕΥΣΗ</button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            orders: []
        }
    },

    methods: {
        newOrder() {
            this.orders.push(
                {
                    brand: '',
                    code: '',
                    quantity: '',
                    info: '',
                    done: false,
                }
            )
        },
        remove(i, cancel){
            cancel ? this.orders[i].for_remove = false: this.orders[i].for_remove = true;
            this.saveOrders();
        },
        getOrder(){
            axios
                .get(api + "get-all-orders")
                    .then(response => {
                        this.orders = response.data ;
                    })
                    .catch(e => {
                        
                    });
        },
        saveOrders() {
            axios
                .post(api + "orders" , this.orders)
                    .then(response => {
                        this.orders = response.data ;
                    })
                    .catch(e => {
                        
                    });
        }
    },

    created() {
        this.getOrder()
    },

    mounted() {
    },
}
</script>
