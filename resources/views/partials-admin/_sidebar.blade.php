<aside id="sidebar" class="sidebar c-overflow">
   
    <div class="s-profile">
                    <a href="#" data-ma-action="profile-menu-toggle">
                        <div class="sp-pic">
                            <img src="{{ url('uploads/profile_pic',Auth::user()->profiles->profile_pic) }}" height="200px" width="200px" alt="" >
                        </div>

                        <div class="sp-info">
                           {{ Auth::user()->name }}

                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                    </a>

                    <ul class="main-menu">
                        <li>
                            <a href="{{  url('user-profile', Auth::user()->id)}}"><i class="zmdi zmdi-account"></i> View Profile</a>
                        </li>
                        <!-- <li>
                            <a href="#"><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                        </li>
                        <li>
                            <a href="#"><i class="zmdi zmdi-settings"></i> Settings</a>
                        </li> -->
                        <li>
                            <a href="{{ route('user.logout') }}"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                        </li>
                    </ul>
    
    </div>

    <ul class="main-menu">
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{url('/')}}"><i class="zmdi zmdi-home"></i> Home</a>
                    </li>
                    @if( Auth::user()->role == 'admin' )
                    <li  class="{{ Request::is('designaion*') ? 'active' : '' }}">
                        <a href="{{url('designaion')}}"><i class="zmdi zmdi-view-compact"></i> Designation List</a>
                    </li>
                    <li class="sub-menu {{ Request::is('user*') ? 'active' : '' }}">
                        <a href="{{url('user')}}" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> User</a>

                        <ul>
                            <li><a href="{{url('user/create')}}">Create</a></li>
                            <li><a href="{{url('user')}}">User List</a></li>
                        </ul>
                    </li>
					<li class="sub-menu {{ Request::is('profile*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Employee </a>

                        <ul>
                            <li><a href="{{url('profile')}}">Employee List</a></li>
                            <li><a href="{{url('profile/create')}}">Create Employee</a></li>
                            <li><a href="top-mainmenu.html"></a></li>
                        </ul>
                    </li>
					
					<li class="sub-menu {{ Request::is('shift*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Shift </a>
                        <ul>
                            <li><a href="{{url('shift/create')}}">Create Shift </a></li>
                            <li><a href="{{ url('shift')}}">Shift List</a></li>
                        </ul>
                    </li>
                    
                    <li class="sub-menu {{ Request::is('single-leaves*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Leave </a>
                        <ul>
                            <li><a href="{{route('single-leaves.create')}}">Leave Request  </a></li>
                            <li><a href="{{ route('single-leaves.index')}}">Request  List</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu {{ Request::is('leave*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> All Leave Request</a>
                        <ul>
                            <li><a href="{{ url('leave')}}">Request  List</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu {{ Request::is('performance*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Performance </a>
                        <ul>
                            <li><a href="{{url('performance/create')}}">Add Perfermance Record  </a></li>
                            <li><a href="{{ url('performance')}}">List of Performance</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu {{ Request::is('offday*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Offday </a>
                        <ul>
                            <li><a href="{{url('offday/month')}}">Add Offday  </a></li>
                            <li><a href="{{ url('offdayview')}}">View Offday</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu  {{ Request::is('payrol*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Payroll </a>
                        <ul>
                            <li> <a href="{{ route('payrol.view') }}"> <i class="zmdi zmdi-view-compact"></i>Add Payroll</a></li>
                            <li><a href="{{ route('payrol.all')}}">Payroll List</a></li>

                        </ul>
                    </li>
					<li class="{{ Request::is('offday*') ? 'active' : '' }}">
                        <a href="{{url('ip')}}"><i class="zmdi zmdi-view-compact"></i>Define IP</a>
                    </li>

                    <h3>Accounting</h3>

                    <li class="sub-menu {{ Request::is('customers*') || Request::is('suppliers*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts-list-alt"></i> Contacts </a>
                        <ul>
                            <li><a href="{{ route('customers.index') }}">Customers  </a></li>
                            <li><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu {{ Request::is('accounts*') ? 'active' : '' }} {{ Request::is('transfer*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts"></i> Finantial Account </a>
                        <ul>
                            <li><a href="{{ route('accounts.create') }}">Create New Account  </a></li>
                            <li><a href="{{ route('accounts.index') }}">Accounts List</a></li>
                            <li><a href="{{ route('transfer.index') }}">Account Transfer</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu {{ Request::is('products*') || Request::is('services*') || Request::is('categories*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Inventory </a>
                        <ul>
                            <li><a href="{{ route('products.index') }}">Products  </a></li>
                            <li><a href="{{ route('services.index') }}">Services</a></li>
                            <li><a href="{{ route('categories.index') }}">Product/Service Categories</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu {{ Request::is('vats*') || Request::is('currency*') ? 'active' : '' }}">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Settings </a>
                        <ul>
                            <li><a href="{{ route('vats.index') }}">Vat  </a></li>
                            <li><a href="{{ route('currency.index') }}">Currency  </a></li>
                            
                        </ul>
                    </li>
                    <li class="sub-menu {{ Request::is('purchase*') ? 'active' : '' }} ">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Purchases </a>
                        <ul>
                            <li><a href="{{ route('purchase.create') }}">New Purchase  </a></li>
                            <li><a href="{{ route('purchase.index') }}">Purchases History  </a></li>
                            
                        </ul>
                    </li>
                    <li class="sub-menu {{ Request::is('sales*') ? 'active' : '' }} ">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Seles </a>
                        <ul>
                            <li><a href="{{ route('sales.create') }}">New Sale  </a></li>
                            <li><a href="{{ route('sales.index') }}">Sales History  </a></li>
                            
                        </ul>
                    </li>

                    <li class="sub-menu {{ Request::is('purchase*') ? 'active' : '' }} ">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Incomes / Expenses </a>
                        <ul>
                            <li><a href="{{ route('incomes.index') }}">Incomes </a></li>
                            <li><a href="{{ route('expenses.index') }}"> Expenses  </a></li>
                            <li><a href="{{ route('in-ex-categories.index') }}">Incomes / Expenses Categories  </a></li>
                            
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Reporting </a>
                        <ul>
                            <li><a href="{{ route('account-statement.index') }}">Account Statements  </a></li>
                            <li><a href="{{ route('report.income') }}">Income Report</a></li>
                            <li><a href="{{ route('report.expens') }}">Expense Report</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{url('notes')}}"><i class="zmdi zmdi-view-compact"></i>Notes</a>
                    </li>


                    <li>
                        <a href="{{url('fixed-assets')}}"><i class="zmdi zmdi-view-compact"></i>Fixed Assets</a>
                    </li>
                    <li>
                        <a href="{{url('stationaery')}}"><i class="zmdi zmdi-view-compact"></i>Stationaery</a>
                    </li>
                    <li>
                        <a href="{{url('housekeeping')}}"><i class="zmdi zmdi-view-compact"></i>Housekeeping</a>
                    </li>
                    <li><a href="{{url('all-attendance')}}"><i class="zmdi zmdi-view-compact"></i>All Attendance List</a></li>
                    @endif
                    
                    @if( Auth::user()->role == 'account' )
					

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts-list-alt"></i> Contacts </a>
                        <ul>
                            <li><a href="{{ route('customers.index') }}">Customers  </a></li>
                            <li><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts"></i> Finantial Account </a>
                        <ul>
                            <li><a href="{{ route('accounts.create') }}">Create New Account  </a></li>
                            <li><a href="{{ route('accounts.index') }}">Accounts List</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Inventory </a>
                        <ul>
                            <li><a href="{{ route('products.index') }}">Products  </a></li>
                            <li><a href="{{ route('services.index') }}">Services</a></li>
                            <li><a href="{{ route('categories.index') }}">Product/Service Categories</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Settings </a>
                        <ul>
                            <li><a href="{{ route('vats.index') }}">Vat  </a></li>
                            <li><a href="{{ route('currency.index') }}">Currency  </a></li>
                            
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Purchases </a>
                        <ul>
                            <li><a href="{{ route('purchase.create') }}">New Purchase  </a></li>
                            <li><a href="{{ route('purchase.index') }}">Purchases History  </a></li>
                            
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Seles </a>
                        <ul>
                            <li><a href="{{ route('sales.create') }}">New Sale  </a></li>
                            <li><a href="{{ route('sales.index') }}">Sales History  </a></li>
                            
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Incomes / Expenses </a>
                        <ul>
                            <li><a href="{{ route('incomes.index') }}">Incomes </a></li>
                            <li><a href="{{ route('expenses.index') }}"> Expenses  </a></li>
                            <li><a href="{{ route('in-ex-categories.index') }}">Incomes / Expenses Categories  </a></li>
                            
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Reporting </a>
                        <ul>
                            <li><a href="{{ route('account-statement.index') }}">Account Statements  </a></li>
                            <li><a href="{{ route('report.income') }}">Income Report</a></li>
                            <li><a href="{{ route('report.expens') }}">Expense Report</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{url('notes')}}"><i class="zmdi zmdi-view-compact"></i>Notes</a>
                    </li>
					
					
					@endif
					@if( Auth::user()->role == 'hr' )
					<li><a href="{{url('designaion')}}"><i class="zmdi zmdi-view-compact"></i>Designation</a></li>
                    <li class="sub-menu">
                        <a href="{{url('user')}}" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> User</a>

                        <ul>
                            <li><a href="{{url('user/create')}}">Create</a></li>
                            <li><a href="{{url('user')}}">User List</a></li>
                        </ul>
                    </li>
					<li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Employee </a>

                        <ul>
                            <li><a href="{{url('profile')}}">Employee List</a></li>
                            <li><a href="{{url('profile/create')}}">Create Employee</a></li>
                            <li><a href="top-mainmenu.html"></a></li>
                        </ul>
                    </li>
					
					<li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Shift </a>
                        <ul>
                            <li><a href="{{url('shift/create')}}">Create Shift </a></li>
                            <li><a href="{{ url('shift')}}">Shift List</a></li>
                        </ul>
                    </li>
                    
                    

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> All Leave Request</a>
                        <ul>
                            <li><a href="{{ url('leave')}}">Request  List</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Performance </a>
                        <ul>
                            <li><a href="{{url('performance/create')}}">Add Perfermance Record  </a></li>
                            <li><a href="{{ url('performance')}}">List of Employee</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Offday </a>
                        <ul>
                            <li><a href="{{url('off-day/month')}}">Add Offday  </a></li>
                            <li><a href="{{ url('offdayview')}}">View Offday</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Payroll </a>
                        <ul>
                            <li> <a href="{{ route('payrol.view') }}"> <i class="zmdi zmdi-view-compact"></i>Add Payroll</a></li>
                            <li><a href="{{ route('payrol.all')}}">Payroll List</a></li>

                        </ul>
                    </li>
					<li>
                        <a href="{{url('ip')}}"><i class="zmdi zmdi-view-compact"></i>Define IP</a>
                    </li>
					 <li><a href="{{url('all-attendance')}}"><i class="zmdi zmdi-view-compact"></i>All Attendance List</a></li>
					@endif
					
                    <li class="sub-menu">
                        <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-view-compact"></i> Leave </a>
                        <ul>
                            <li><a href="{{route('single-leaves.create')}}">Leave Request  </a></li>
                            <li><a href="{{ route('single-leaves.index')}}">Request  List</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="{{url('employee-attendance')}}"><i class="zmdi zmdi-view-compact"></i>Attendance  </a>
                    </li>
                    
    
    </ul> 
</aside>