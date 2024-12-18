<a href="javascript:;" class="page-quick-sidebar-toggler">
    <i class="icon-login"></i>
</a>
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
    <div class="page-quick-sidebar">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Συνομιλία
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                    <h3 class="list-heading">On-line Χρήστες</h3>
                    <usersonline></usersonline>
                </div>
                <div class="page-quick-sidebar-item">
                    <div class="page-quick-sidebar-chat-user">
                        <div class="page-quick-sidebar-nav">
                            <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                <i class="icon-arrow-left"></i>Επιστροφή</a>
                        </div>
                        <div class="page-quick-sidebar-chat-user-messages">
                            <div class="post" v-bind:class="{'out': chat.receiver.id == authUser , 'in': chat.receiver.id != authUser}" v-for="(chat , index) in chats">
                                <p class="avatar" >@{{chat.sender.name[0]}}</p>
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">@{{chat.sender.name}}</a>
                                    <span class="datetime">@{{setMessageTime(chat.created_at)}}</span>
                                    <span class="body"> @{{chat.body}} </span>
                                </div>
                            </div>
                        </div>
                        <div class="page-quick-sidebar-chat-user-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Πληκτρολογήστε ένα μήνυμα..." v-model="messageBody" v-on:keyup.enter="sendMessage()">
                                <div class="input-group-btn">
                                    <button type="button" class="btn green" @click="sendMessage()">
                                        <i class="icon-paper-clip"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>