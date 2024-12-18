<dutyonbar ref="dutycount"></dutyonbar>
<div class="new-message" @click="newMessage = false">
    <i v-if="newMessage" class="fa fa-envelope" aria-hidden="true"></i>
</div> 
<ul class="nav navbar-nav pull-right">
    <!-- BEGIN NOTIFICATION DROPDOWN -->
    <!-- BEGIN USER LOGIN DROPDOWN -->
    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
    <li id="customers-component">
        <headercustomers></headercustomers>
    </li>
    <li class="dropdown dropdown-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            {{--  <img alt="" class="img-circle" src="{{ asset('img/avatar3_small.jpg')}}" />  --}}
            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-default">
            <li>
                <a href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="icon-key"></i>Έξοδος</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                     </form>
            </li>
        </ul>
    </li>
    <!-- END USER LOGIN DROPDOWN -->
    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
    <li class="dropdown dropdown-quick-sidebar-toggler">
        <a href="javascript:;" class="dropdown-toggle">
            <i class="icon-logout"></i>
        </a>
    </li>
    <!-- END QUICK SIDEBAR TOGGLER -->
</ul>