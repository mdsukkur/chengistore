<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="ft-home"></i>
                    <span class="menu-title" data-i18n="">
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/employeeManagement') || Request::is('admin/SalaryManagement') ? 'has-sub open' : '' }}">
                <a href="#"><i class="fa fa-briefcase"></i><span class="menu-title">
                        Employee Management
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/employeeManagement') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('employeeManagement.index')}}">Employee</a>
                    </li>
                    <li class="{{ Request::is('admin/SalaryManagement') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('SalaryManagement.index')}}">Salary Management</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Request::is('admin/projectDetails') || Request::route()->getName() == 'projectDetails.show' ? 'active' : '' }}">
                <a href="{{route('projectDetails.index')}}">
                    <i class="ft-cloud"></i>
                    <span class="menu-title" data-i18n="">
                        Projects
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/SupplierManagement') || Request::route()->getName() == 'SupplierManagement.show' ? 'active' : '' }}">
                <a href="{{route('SupplierManagement.index')}}">
                    <i class="ft-user-plus"></i>
                    <span class="menu-title" data-i18n="">
                        Supplier
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/expense') || Request::is('admin/personal_expense') ? 'has-sub open' : '' }}">
                <a href="#"><i class="fa fa-users"></i><span class="menu-title">
                        Expense Management
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/expense') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('expense.index')}}">Expense</a>
                    </li>
                    <li class="{{ Request::is('admin/personal_expense') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('personal_expense.index')}}">Personal Expense</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Request::is('admin/account') || Request::is('admin/Bank_Statement') ? 'has-sub open' : '' }}">
                <a href="#"><i class="fa fa-dashcube"></i><span class="menu-title"
                                                                data-i18n="">
                        Account Management
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/account') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('account.index')}}">Accounts</a>
                    </li>
                    <li class="{{ Request::is('admin/BankManagement') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('BankManagement.index')}}">Bank Details</a>
                    </li>
                    <li class="{{ Request::is('admin/Bank_Statement') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('account.bank_statement')}}">Bank Transaction</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Request::is('admin/assetManagement') ? 'active' : '' }}">
                <a href="{{route('assetManagement.index')}}">
                    <i class="fa fa-history"></i>
                    <span class="menu-title" data-i18n="">
                        Asset Management
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/userManagement') ? 'active' : '' }}">
                <a href="{{route('userManagement.index')}}">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">
                        User Management
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/historyGenerator') || Request::is('admin/generateHistory') ? 'active' : '' }}">
                <a href="{{route('admin.historyGenerator')}}">
                    <i class="ft-folder"></i>
                    <span class="menu-title" data-i18n="">
                        History Generate
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/branchManagement') ? 'has-sub open' : '' }}">
                <a href="#"><i class="fa fa-cogs"></i><span class="menu-title">
                        Setting
                    </span></a>
                <ul class="menu-content">
                    <li class="{{ Request::is('admin/branchManagement') ? 'active' : '' }}">
                        <a class="menu-item" href="{{route('branchManagement.index')}}">Branch</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ Request::is('admin/Profile') ? 'active' : '' }}">
                <a href="{{route('admin.profile')}}">
                    <i class="fa fa-user-secret"></i>
                    <span class="menu-title" data-i18n="">
                        Profile
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('admin/changePassword') ? 'active' : '' }}">
                <a href="{{route('admin.changepassword')}}">
                    <i class="ft-lock"></i>
                    <span class="menu-title" data-i18n="">
                        Change Password
                    </span>
                </a>
            </li>

        </ul>
    </div>
</div>
