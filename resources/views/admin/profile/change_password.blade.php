<div class="tab-pane {{ Session::has('tab') ? 'active' : ''}}" id="change-password">

        <form action="{{ route('profile.change.password') }}" class="form-horizontal" method="POST">
            {{ csrf_field() }}

            @component('parts.components.form-group',
                ['name' => 'password', 'icon_name' => 'lock', 'column' => 'col-sm-8 col-md-6'])
                <input type="password" id="password" class="form-control" name="password" value="">
            @endcomponent

            @component('parts.components.form-group',
                ['name' => 'confirm', 'icon_name' => 'lock', 'column' => 'col-sm-8 col-md-6'])
                <input type="password" id="confirm" class="form-control" name="password_confirmation" value="">
            @endcomponent

            <div class="form-group row">
                <div class="col-sm-8 offset-sm-3">
                    <div class="media align-items-center">
                        <div class="media-left">
                            <button type="submit" class="btn btn-success">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
