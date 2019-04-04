<!-- Menu -->
<ul class="nav navbar-nav flex-nowrap">

    <!-- Notifications dropdown -->
    <li class="nav-item dropdown dropdown-notifications dropdown-menu-sm-full">
        <button class="nav-link btn-flush dropdown-toggle" type="button" data-toggle="dropdown" data-dropdown-disable-document-scroll data-caret="false">
            <i class="material-icons">notifications</i>
            <span class="badge badge-notifications badge-danger">2</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <div data-perfect-scrollbar class="position-relative">
                {{-- <div class="dropdown-header"><strong>Messages</strong></div>
                <div class="list-group list-group-flush mb-0">

                    <a href="instructor-messages.html" class="list-group-item list-group-item-action unread">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-muted">5 minutes ago</small>

                            <span class="ml-auto unread-indicator bg-primary"></span>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <img src="assets/images/people/110/woman-5.jpg" alt="people" class="avatar-img rounded-circle">
                            </span>
                            <span class="flex d-flex flex-column">
                                <strong>Michelle</strong>
                                <span class="text-black-70">Clients loved the new design.</span>
                            </span>
                        </span>
                    </a>

                    <a href="instructor-messages.html" class="list-group-item list-group-item-action unread">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-muted">5 minutes ago</small>

                            <span class="ml-auto unread-indicator bg-primary"></span>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <img src="assets/images/people/110/woman-5.jpg" alt="people" class="avatar-img rounded-circle">
                            </span>
                            <span class="flex d-flex flex-column">
                                <strong>Michelle</strong>
                                <span class="text-black-70">🔥 Superb job..</span>
                            </span>
                        </span>
                    </a>

                </div> --}}

                <div class="dropdown-header"><strong>System notifications</strong></div>
                <div class="list-group list-group-flush mb-0">

                    <a href="instructor-messages.html" class="list-group-item list-group-item-action border-left-3 border-left-danger">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-muted">3 minutes ago</small>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <span class="avatar-title rounded-circle bg-light">
                                    <i class="material-icons font-size-16pt text-danger">account_circle</i>
                                </span>
                            </span>
                            <span class="flex d-flex flex-column">

                                <span class="text-black-70">Your profile information has not been synced correctly.</span>
                            </span>
                        </span>
                    </a>

                    <a href="instructor-messages.html" class="list-group-item list-group-item-action">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-muted">5 hours ago</small>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <span class="avatar-title rounded-circle bg-light">
                                    <i class="material-icons font-size-16pt text-success">group_add</i>
                                </span>
                            </span>
                            <span class="flex d-flex flex-column">
                                <strong>Adrian. D</strong>
                                <span class="text-black-70">Wants to join your private group.</span>
                            </span>
                        </span>
                    </a>

                    <a href="instructor-messages.html" class="list-group-item list-group-item-action">
                        <span class="d-flex align-items-center mb-1">
                            <small class="text-muted">1 day ago</small>

                        </span>
                        <span class="d-flex">
                            <span class="avatar avatar-xs mr-2">
                                <span class="avatar-title rounded-circle bg-light">
                                    <i class="material-icons font-size-16pt text-warning">storage</i>
                                </span>
                            </span>
                            <span class="flex d-flex flex-column">

                                <span class="text-black-70">Your deploy was successful.</span>
                            </span>
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </li>
    <!-- // END Notifications dropdown -->
    @include('parts.app.navigation.profile_menu')
</ul>
