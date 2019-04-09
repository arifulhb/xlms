<div class="col-lg-8 col-md-8 col-sm-12">

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-card">
            <li class="nav-item">
                <a class="nav-link active" href="#first" data-toggle="tab">Account</a>
            </li>
            @if(isset($user))
            <li class="nav-item">
                <a class="nav-link" href="#change_status" data-toggle="tab">Status Change</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#change_role" data-toggle="tab">Role Change</a>
            </li>
            @endif
        </ul>
        <div class="tab-content card-body">
            <div class="tab-pane active" id="first">
                <form action="{{ isset($user) ? route('users.update', ['id' => $user->id]) : route('users.insert') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    @if(isset($user))
                    <input type="hidden" name="_method" value="PUT">
                    @endif

                    @component('parts.components.form-group',
                        ['name' => 'name', 'icon_name' => 'person', 'column' => 'col-sm-8 col-md-6'])
                        <input type="text" id="name" class="form-control" name="name"
                        placeholder="Name" value="{{ old('name') ? old('name') : isset($user) ? $user->name : ''}}">
                    @endcomponent

                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label form-label">Access Role</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-md-6">
                                    @if(isset($user))
                                        @foreach($user->roles as $role)
                                        <span class="badge badge-info">{{ $role['name'] }}</span>
                                        @endforeach
                                    @else
                                        <select id="role" class="form-control" name="role">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @component('parts.components.form-group',
                        ['name' => 'email', 'icon_name' => 'mail', 'column' => 'col-sm-6 col-md-6'])
                        <input type="email" id="email" class="form-control" name="email"
                        placeholder="Email Address" value="{{ old('email') ? old('email') :  isset($user) ? $user->email : '' }}">
                    @endcomponent

                    @component('parts.components.form-group',
                        ['name' => 'username', 'icon_name' => 'alternate_email', 'column' => 'col-sm-6 col-md-6'])
                        <input id="username" type="text" class="form-control" name="username"
                        placeholder="username" value="{{ old('username') ? old('username') : isset($user) ? $user->username : '' }}">
                    @endcomponent


                    @component('parts.components.form-group',
                        ['name' => 'department', 'icon_name' => 'business_center', 'column' => 'col-sm-8 col-md-4'])
                        @php
                        $user_dept = [];
                        foreach($user->departments as $item){
                            array_push($user_dept, $item->id);
                        }
                       @endphp
                        <select class="form-control" name="department" id="department" required>
                            <option selected disabled>Select a department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ in_array($department->id, $user_dept) ? 'selected' : '' }} >{{ $department->name }}</option>
                            @endforeach
                        </select>
                    @endcomponent

                    @component('parts.components.form-group',
                        ['name' => 'job_role', 'icon_name' => 'folder_shared', 'column' => 'col-sm-8 col-md-4'])
                        @php
                         $role_ids= [];
                         foreach($user->jobroles as $item){
                             array_push($role_ids, $item->id);
                         }
                        @endphp
                        <select class="form-control" name="job_role" id="job_role" required>
                            <option selected disabled>Select a Job Role</option>
                            @foreach($job_roles as $job_role)
                                <option value="{{ $job_role->id }}" {{ in_array($job_role->id, $role_ids) ? 'selected' : '' }} >{{ $job_role->name }}</option>
                            @endforeach
                        </select>
                    @endcomponent


                    @if(isset($user))

                    @component('parts.components.form-group',
                        ['name' => 'status', 'icon_name' => 'check_box', 'column' => 'col-sm-6 col-md-4'])
                        <input type="text" class="form-control" value="{{ isset($user) ? $user->statusText : '' }}" disabled />
                    @endcomponent
                    @endif

                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-3">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if(isset($user))
                @include('admin.users.status_change')
                @include('admin.users.role_change')
            @endif

        </div>
    </div>
</div>
