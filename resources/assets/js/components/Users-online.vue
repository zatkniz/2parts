<template>
    <ul class="media-list list-items">
        <li :id="'chat-user' + user.id" class="media" v-for="(user , index ) in users" @click="setReceiverId(user)">
            <div class="media-status" v-if="checkIfShowBadge(user)">
                <span class="label label-sm label-warning ">Νέα</span>
            </div>
            <!-- <img class="media-object" src="http://administration.2-parts.gr/img/avatar3_small.jpg" alt="..."> -->
            <div class="media-body">
                <h4 class="media-heading">{{user.name}}</h4>
                <div class="media-heading-sub">{{user.role == 1 ? 'Administrator' : 'Editor'}} </div>
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
        setReceiverId(user) {
            app5.chats = [];
            app5.receiverId = user.id;
            app5.newMessage = false;
            axios.get(api + 'chat-logs/' + app5.authUser + '/' + user.id)
                .then(response => {
                    app5.chats = response.data;
                    setTimeout(function() {
                        $('.page-quick-sidebar-chat-user-messages').scrollTop(10000);
                    }, 50);
                    app5.newMessagesArray.splice(app5.newMessagesArray.indexOf(user.id), 1)
                })
                .catch(e => {
                    console.log(e);
                })
            $('div#quick_sidebar_tab_1').toggleClass('page-quick-sidebar-content-item-shown');
        },
        checkIfShowBadge(user) {
            return app5.newMessagesArray.indexOf(user.id) > -1;
        },
        getAllCustomers() {
            axios.get(api + 'all-customers')
                .then(response => {
                    app5.allCustomers = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        getDeliveries() {
            axios.get(api + 'active-employees')
                .then(response => {
                    app5.deliveries = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        getAllParts() {
            axios.get(api + 'all-parts')
                .then(response => {
                    app5.allParts = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        getOutcomes: function() {
            axios.get(api + 'outcomes')
                .then(response => {
                    app5.allParts = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        toastrEvent() {
        },
        getAuthUser() {
            axios.get(api + 'auth-user')
                .then(response => {
                    app5.authUser = response.data.id
                    Echo.private('chat-channel.' + response.data.id)
                        .listen('MessageSend', (e) => {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "0",
                                "extendedTimeOut": "0",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            app5.echoId = e.user.id
                            toastr.options.onclick = function(e, user) {
                                if (!$('body.page-header-fixed.page-sidebar-closed-hide-logo.page-container-bg-solid.page-content-white').hasClass('page-quick-sidebar-open')) {
                                    $('a.dropdown-toggle').trigger('click');
                                }
                                $('div#quick_sidebar_tab_1').removeClass('page-quick-sidebar-content-item-shown');
                                setTimeout(function() {
                                    $('li#chat-user' + app5.echoId).trigger('click')
                                }, 150);
                            }
                            toastr["info"](e.message.body, e.user.name + ': ');
                            app5.newMessage = true;
                            app5.newMessagesArray.push(e.user.id);
                            axios.get(api + 'chat-logs/' + app5.authUser + '/' + e.user.id)
                                .then(response => {
                                    app5.chats = response.data;
                                    $('.page-quick-sidebar-chat-user-messages').scrollTop(10000);
                                })
                                .catch(e => {
                                    console.log(e);
                                })
                        });
                })
                .catch(e => {
                    console.log(e)
                })
        }
    },
    created() {
        this.getAllusers();
        this.getAuthUser();
        this.getAllCustomers();
        this.getOutcomes();
        this.getDeliveries();
    },
}
</script>
