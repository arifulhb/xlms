@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex">
                    <h4 class="card-title">Earnings</h4>
                    <p class="card-subtitle">Last 7 Days</p>
                </div>
                <a href="instructor-earnings.html" class="btn btn-sm btn-primary"><i class="material-icons">trending_up</i></a>
            </div>
            <div class="card-body">
                <div class="chart" style="height: 200px;">
                    <canvas id="earningsChart" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <div class="flex">
                    <h4 class="card-title">Transactions</h4>
                    <p class="card-subtitle">Latest Transactions</p>
                </div>
                <a href="instructor-statement.html" class="btn btn-sm btn-primary"><i class="material-icons">receipt</i></a>
            </div>
            <div data-toggle="lists" data-lists-values='["js-lists-values-course", "js-lists-values-document", "js-lists-values-amount", "js-lists-values-date"
]' data-lists-sort-by="js-lists-values-date" data-lists-sort-desc="true" class="table-responsive">

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        Cards

        <pre>
        {{ print_r(Auth::user()->roles->toArray()) }}
        </pre>
    </div>
</div>
@endsection
