<div class="tab-pane {{ Session::has('tab') ? '' : 'active'}}" id="first">
    <form action="{{ route('profile.update') }}" class="form-horizontal" method="POST">
        {{ csrf_field() }}

        @component('parts.components.form-group',
            ['name' => 'name', 'icon_name' => 'person', 'column' => 'col-sm-8 col-md-6'])
            <input type="text" id="name" class="form-control" name="name"
            placeholder="Name" value="{{ $user->name  }}">
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
            placeholder="Email Address" value="{{ $user->email }}">
        @endcomponent

        @component('parts.components.form-group',
            ['name' => 'username', 'icon_name' => 'alternate_email', 'column' => 'col-sm-6 col-md-6'])
            <input id="username" type="text" class="form-control" name="username"
            placeholder="username" value="{{ $user->username }}">
        @endcomponent

        @php
            $role_permission = $user->roles->toArray()[0]['name'];
            $admin_class_name = $role_permission == USER_ROLE_INSTRUCTOR ? 'd-none' : '';
            $instructor_class_name =  $role_permission == USER_ROLE_INSTRUCTOR ? '' : 'd-none';
        @endphp

        <div class="js-admin js-student {{ $admin_class_name }}">
        @component('parts.components.form-group',
            ['name' => 'department', 'icon_name' => 'business_center', 'column' => 'col-sm-8 col-md-4'])
            @php
            $user_dept = [];
            if(isset($user)){
                foreach($user->departments as $item){
                    array_push($user_dept, $item->id);
                }
            }
            @endphp
            <select class="form-control" name="department" id="department">
                <option selected disabled value="select">Select a department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ in_array($department->id, $user_dept) ? 'selected' : '' }} >{{ $department->name }}</option>
                @endforeach
            </select>
        @endcomponent
        </div>

        <div class="js-admin js-student {{ $admin_class_name }}">
        @component('parts.components.form-group',
            ['name' => 'job_role', 'icon_name' => 'folder_shared', 'column' => 'col-sm-8 col-md-4'])
            @php
                $role_ids= [];
                if(isset($user)){
                foreach($user->jobroles as $item){
                    array_push($role_ids, $item->id);
                }
            }
            @endphp
            <select class="form-control" name="job_role" id="job_role">
                <option selected disabled  value="select">Select a Job Role</option>
                @foreach($job_roles as $job_role)
                    <option value="{{ $job_role->id }}" {{ in_array($job_role->id, $role_ids) ? 'selected' : '' }} >{{ $job_role->name }}</option>
                @endforeach
            </select>
        @endcomponent
        </div>

        <div class="js-instructor  {{ $instructor_class_name }}">
        @component('parts.components.form-group',
            ['name' => 'expertise', 'icon_name' => 'highlight', 'column' => 'col-sm-8 col-md-6'])
            <input type="text" id="expertise" class="form-control" name="expertise"
            placeholder="e.g. Expertise1, Expertise2" value="{{ old('expertise') ? old('expertise') : isset($user) ? $user->expertise : ''}}">
        @endcomponent
        </div>


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
