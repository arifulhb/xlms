
    <!-- jQuery -->
    <script src="{{ asset('template/assets/vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('template/assets/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('template/assets/vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('template/assets/vendor/dom-factory.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/material-design-kit.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('template/assets/js/app.js') }}"></script>

    <!-- Highlight.js -->
    <script src="{{ asset('template/assets/js/hljs.js') }}"></script>

    <!-- App Settings (safe to remove) -->
    {{-- <script src="{{ asset('template') }}assets/js/app-settings.js"></script> --}}

    <!-- Global Settings -->
    {{-- <script src="{{ asset('template/assets/js/settings.js') }} "></script> --}}

    <!-- Moment.js -->
    <script src="{{ asset('template/assets/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/moment-range.min.js') }}"></script>

    <!-- Chart.js -->
    {{-- <script src="{{ asset('template/assets/vendor/Chart.min.js') }}"></script> --}}

    <!-- UI Charts Page JS -->
    {{-- <script src="{{ asset('template/assets/js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ asset('template/assets/js/chartjs.js') }}"></script> --}}

    <!-- Chart.js Samples -->
    {{-- <script>
        (function() {
            'use strict';

            Charts.init()

            var earnings = []

            // Create a date range for the last 7 days
            var start = moment().subtract(7, 'days').format('YYYY-MM-DD') // 7 days ago
            var end = moment().format('YYYY-MM-DD') // today
            var range = moment.range(start, end)

            // Create the earnings graph data
            // Iterate the date range and assign a random ($) earnings value for each day
            range.by('days', function(moment) {
                earnings.push({
                    y: Math.floor(Math.random() * 300) + 10,
                    x: moment.toDate()
                })
            })

            var Earnings = function(id, type = 'roundedBar', options = {}) {
                options = Chart.helpers.merge({
                    barRoundness: 1.2,
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(a) {
                                    if (!(a % 10))
                                        return "$" + a
                                }
                            }
                        }],
                        xAxes: [{
                            offset: true,
                            ticks: {
                                padding: 10
                            },
                            maxBarThickness: 20,
                            gridLines: {
                                display: false
                            },
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(a, e) {
                                var t = e.datasets[a.datasetIndex].label || "",
                                    o = a.yLabel,
                                    r = "";
                                return 1 < e.datasets.length && (r += '<span class="popover-body-label mr-auto">' + t + "</span>"), r += '<span class="popover-body-value">$' + o + "</span>"
                            }
                        }
                    }
                }, options)

                var data = {
                    datasets: [{
                        label: "Earnings",
                        data: earnings
                    }]
                }

                Charts.create(id, type, options, data)
            }

            // Create Chart
            Earnings('#earningsChart')

        })()
    </script> --}}

    <!-- List.js -->
    {{-- <script src="{{ asset('template/assets/vendor/list.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('template/assets/js/list.js') }}"></script> --}}
    <script src="{{ asset('js/toast.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
