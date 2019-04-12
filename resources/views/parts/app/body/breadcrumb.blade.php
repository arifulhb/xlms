@section('breadcrumb')
    @isset($model)
    {{ Breadcrumbs::render(isset($breadcrumb) ? $breadcrumb : 'dashboard', $model ) }}
@else
    {{ Breadcrumbs::render(isset($breadcrumb) ? $breadcrumb : 'dashboard' ) }}
    @endif
@endsection
