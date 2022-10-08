<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            @can('Admin') 
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Admin Home</div>


                 <a class="nav-link" href="{{ route('drivers.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Driver Assign
                </a>

                <a class="nav-link" href="{{ route('buses.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Bus Entry
                </a>

                <a class="nav-link" href="{{ route('events.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Event Details
                </a>

                <a class="nav-link" href="{{ route('trips.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Trip Details
                </a>

                <a class="nav-link" href="{{ route('passengers.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Passenger Details
                </a>

                <a class="nav-link" href="{{ route('bookings.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Bookings Details
                </a>

                <a class="nav-link" href="{{ route('contract_message.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Message
                </a>


                

                {{--@can('user-management')--}}

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Role
                        </a>
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Users
                        </a>
                    </nav>
                </div>


            </div>
            @endcan


            @can('Driver') 
            <div class="nav">
                <div class="sb-sidenav-menu-heading">List</div>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                     Home
                </a>

                <a class="nav-link" href="{{ route('trips.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Trip Details
                </a>


                 <a class="nav-link" href="{{ route('driver.trip.passenger') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Check Passenger List
                </a>
               
            </div>
            @endcan

            @can('passenger') 
            <div class="nav">
                <div class="sb-sidenav-menu-heading">List</div>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Passenger Home
                </a>

                <a class="nav-link" href="{{ route('passengers.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Passenger Profile
                </a>

                <a class="nav-link" href="{{ route('events.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Event Details
                </a>

            </div>
            @endcan
            @can('Guest')
            <div class="nav">
                <div class="sb-sidenav-menu-heading">List</div>
            <a class="nav-link" href="#">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Waiting for Supervisor Conformation
            </a>
            </div>
            @endcan

        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->role->name ?? "" }}
           
        </div>
    </nav>
</div>


