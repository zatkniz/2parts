<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  "onsubmit="return false">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Αναζήτηση..." v-on:keyup.enter="searchFund()" v-model="fundQuery">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            @if(Auth::user()->role == 1)
            <li class="nav-item start">
                <a href="{{ url('/home') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Αρχική</span>
                </a>
            </li>
            @endif
            <!-- <li class="nav-item  has-sub-menu">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-calculator"></i>
                    <span class="title">Ταμεία</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="" class="nav-link ">
                            <span class="title">Ταμείο Ημέρας</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('past-funds') }}" class="nav-link ">
                            <span class="title">Ταμεία</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('province') }}" class="nav-link ">
                            <span class="title">Επαρχεία</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item  ">
                <a href="{{ url('daily-funds') }}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Ταμείο Ημέρας</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('past-funds') }}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Ταμεία</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('province') }}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Επαρχεία</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('customers') }}" class="nav-link nav-toggle">
                    <i class="icon-basket"></i>
                    <span class="title">Καρτέλα Πελάτη</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('balances') }}" class="nav-link nav-toggle">
                    <i class="icon-basket"></i>
                    <span class="title">Υπόλοιπα</span>
                </a>
            </li>
            <!-- <li class="nav-item has-sub-menu ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-basket"></i>
                    <span class="title">Πελάτες</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{ url('customers') }}" class="nav-link ">
                            <span class="title">Καρτέλα Πελάτη</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ url('balances') }}" class="nav-link ">
                            <span class="title">Υπόλοιπα</span>
                        </a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item start">
                <a href="{{ url('/orders') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Παραγγελίες</span>
                </a>
            </li>
            @if(Auth::user()->role == 1)
            <li class="nav-item  ">
                <a href="{{ url('payroll') }}" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Μισθοδοσία</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('employees') }}" class="nav-link nav-toggle">
                   <i class="icon-user"></i>
                    <span class="title">Υπάλληλοι</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('users') }}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Χρήστες</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('statistics') }}" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Στατιστικά</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('employers-statistics') }}" class="nav-link nav-toggle">
                    <i class="icon-info"></i>
                    <span class="title">Στατιστικά Πωλητών</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->role == 1 || Auth::user()->percentage > 0 )
            <li class="nav-item  has-sub-menu">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-calculator"></i>
                    <span class="title">Λίστα Πωλητή</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                <li class="nav-item " v-for="seller in sellers" v-if="{{Auth::user()->id}} == seller.id || {{ Auth::user()->role == 1 }}">
                        <a :href="'/seller-print/' + seller.id" class="nav-link ">
                            <span class="title">@{{ seller.name }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="nav-item  ">
                <a href="{{ url('print') }}" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Εκτυπώσεις</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ url('duties') }}" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Εκκρεμότητες</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>