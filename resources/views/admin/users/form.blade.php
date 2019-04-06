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

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                        <div class="col-sm-8">
                            <div class="input-group {{ $errors->has('name') ? 'invalid-feedback'  : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">person</i>
                                    </div>
                                </div>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="Name" value="{{ old('name') ? old('name') : isset($user) ? $user->name : ''}}">
                            </div>
                            @if ($errors->has('name'))
                                <small class="form-text text-warning">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label form-label">Role</label>
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
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label form-label">Email</label>
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('email') ? 'invalid-feedback'  : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">mail</i>
                                    </div>
                                </div>
                                <input type="email" id="email" class="form-control" name="email"
                                placeholder="Email Address" value="{{ old('email') ? old('email') :  '' }}">
                            </div>
                            @if ($errors->has('email'))
                                <small class="form-text text-warning">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label form-label">Username</label>
                        <div class="col-sm-6 col-md-6">

                            <div class="input-group  {{ $errors->has('username') ? 'invalid-feedback'  : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">alternate_email</i>
                                    </div>
                                </div>
                                <input id="username" type="text" class="form-control" name="username"
                                    placeholder="username" value="{{ old('username') ? old('username') : isset($user) ? $user->username : '' }}">
                            </div>
                            @if ($errors->has('username'))
                                <small class="form-text text-warning">{{ $errors->first('username') }}</small>
                            @endif
                        </div>
                    </div>
                    @if(isset($user))
                    <div class="form-group row">
                        <label for="status_text" class="col-sm-3 col-form-label form-label">Status</label>
                        <div class="col-sm-6 col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">check_box</i>
                                    </div>
                                </div>

                                    <input type="text" class="form-control" value="{{ isset($user) ? $user->statusText : '' }}" disabled />
                            </div>
                        </div>

                    </div>
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
            <div class="tab-pane" id="change_status">
                <form action="{{ route('users.field.update', ['id'=> $user->id])}}"
                    class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="field" value="status"/>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label form-label">Status</label>
                        <div class="col-sm-6 col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">check_box</i>
                                    </div>
                                </div>
                                <select class="form-control" id="status">
                                    <option disabled>Select a status</option>
                                    @foreach(USER_STATUS as $key => $status)
                                        <option value="{{ $key}}" {{ $key == $user->status ? 'SELECTED' : ''}} > {{ $status }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-4 offset-sm-3">
                            <button type="submit" class="btn btn-success"> Update Billing</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="change_role">
                <form action="{{ route('users.field.update', ['id'=> $user->id]) }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="field" value="role"/>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label form-label">Role</label>
                        <div class="col-sm-6 col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">check_box</i>
                                    </div>
                                </div>
                                <select class="form-control" id="role">
                                    <option disabled>Select a Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id}}" >{{ $role->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-4 offset-sm-3">
                            <button type="submit" class="btn btn-success"> Change Role</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif

        </div>
    </div>
</div>
