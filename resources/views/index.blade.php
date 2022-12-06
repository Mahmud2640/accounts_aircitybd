@extends('layouts.app')

@section('content')

@if (auth()->user()->role == 'admin')
    <div class="content content-narrow">
        <!-- Stats -->
        <div class="row">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">This Month Register</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count(\App\Models\Ticket::whereDate('created_at', Carbon\Carbon::now()->month)->get()) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Today Register</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count(\App\Models\Ticket::whereDate('created_at', Carbon\Carbon::today())->get()) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Total Register</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count(\App\Models\Ticket::all()) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Total Pay Amount</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ \App\Models\Ticket::sum('pay') }}.Tk</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Total due Amount</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ \App\Models\Ticket::sum('due') }}.Tk</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Stats -->

        <!-- Dashboard Charts -->
        <div class="row">

            <div class="col-xl-6">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Sales Report</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="py-3">
                            <!-- Lines Chart Container -->
                            <canvas class="js-chartjs-lines"></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Web site Link</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            @foreach (\App\Models\Link::get() as $item)
                                <div class="col-lg-6 text-center">
                                    <img src="{{ asset($item->image) }}" class="img-thumbnail" style="width:100%;height:100px;">
                                    <a target="_blank" href="{{ $item->link }}">{{ $item->name }}</a> <br>
                                    <a class="btn btn-dark btn-sm mt-1 mb-1" target="_blank" href="{{ $item->link }}">Check Now</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-xl-6">
                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Due Paymet Flight Date Coming Soon </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700">Name</th>
                                    <th class="d-none d-sm-table-cell font-w700">Number</th>
                                    <th class="font-w700">Flight</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Due</th>
                                    <th class="font-w700 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <span class="font-w600">{{ $ticket->name }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="font-size-sm text-muted">{{ $ticket->number }}</span>
                                        </td>
                                        <td>
                                            <span class="font-w600 text-danger">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-right">
                                            {{ $ticket->due }}
                                        </td>
                                        <td class="text-center">
                                            <a onclick="return confirm('Are you sure you ?');" href="{{ route('ticket.dou.paid',base64_encode($ticket->id)) }}" data-toggle="tooltip" data-placement="left" title="Due amount paid">
                                                <i class="fas fa-money-bill fa-fw"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Upcoming Flight</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700">Name</th>
                                    <th class="d-none d-sm-table-cell font-w700">Number</th>
                                    <th class="font-w700">Flight</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Sector</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Ticket::where('flight_date', '<',Carbon\Carbon::now()->addDays(1)->toDateTimeString())->where('flight_date', '>',Carbon\Carbon::now())->get() as $ticket)
                                    <tr>
                                        <td>
                                            <span class="font-w600">{{ $ticket->name }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="font-size-sm text-muted">{{ $ticket->number }}</span>
                                        </td>
                                        <td>
                                            <span class="font-w600 text-danger">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-right">
                                            {{ $ticket->sector ? $ticket->sector->name : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <!-- END Dashboard Charts -->
    </div>
@else
    <div class="content content-narrow">
        <!-- Stats -->
        <div class="row">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Today Register</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count(\App\Models\Ticket::whereDate('created_at', Carbon\Carbon::today())->where('user_id',auth()->user()->id)->get()) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Total Register</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ count(\App\Models\Ticket::where('user_id',auth()->user()->id)->get()) }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Total Pay Amount</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ \App\Models\Ticket::where('user_id',auth()->user()->id)->sum('pay') }}.Tk</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Total due Amount</div>
                        <div class="font-size-h2 font-w400 text-dark">{{ \App\Models\Ticket::where('user_id',auth()->user()->id)->sum('due') }}.Tk</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Stats -->

        <!-- Dashboard Charts -->
        <div class="row">

            <div class="col-xl-6">
                <!-- Lines Chart -->
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Sales Report</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="py-3">
                            <!-- Lines Chart Container -->
                            <canvas class="js-chartjs-lines"></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->

                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Web site Link</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            @foreach (\App\Models\Link::get() as $item)
                                <div class="col-lg-6 text-center">
                                    <img src="{{ asset($item->image) }}" class="img-thumbnail" style="width:100%;height:100px;">
                                     <a target="_blank" href="{{ $item->link }}">{{ $item->name }}</a> <br>
                                     <a class="btn btn-dark btn-sm mt-1 mb-1" target="_blank" href="{{ $item->link }}">Check Now</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-xl-6">
                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Due Paymet Flight Date Coming Soon </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700">Name</th>
                                    <th class="d-none d-sm-table-cell font-w700">Number</th>
                                    <th class="font-w700">Flight</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Due</th>
                                    <th class="font-w700 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <span class="font-w600">{{ $ticket->name }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="font-size-sm text-muted">{{ $ticket->number }}</span>
                                        </td>
                                        <td>
                                            <span class="font-w600 text-danger">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-right">
                                            {{ $ticket->due }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('ticket.dou.paid',base64_encode($ticket->id)) }}" data-toggle="tooltip" data-placement="left" title="Due amount paid">
                                                <i class="fas fa-money-bill fa-fw"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="block block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Upcoming Flight</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                            <thead class="thead-dark">
                                <tr class="text-uppercase">
                                    <th class="font-w700">Name</th>
                                    <th class="d-none d-sm-table-cell font-w700">Number</th>
                                    <th class="font-w700">Flight</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Sector</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Ticket::where('user_id',auth()->user()->id)->where('flight_date', '<',Carbon\Carbon::now()->addDays(1)->toDateTimeString())->where('flight_date', '>',Carbon\Carbon::now())->get() as $ticket)
                                    <tr>
                                        <td>
                                            <span class="font-w600">{{ $ticket->name }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="font-size-sm text-muted">{{ $ticket->number }}</span>
                                        </td>
                                        <td>
                                            <span class="font-w600 text-danger">{{ date('d M y, g:i a', strtotime($ticket->flight_date)) }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-right">
                                            {{ $ticket->sector ? $ticket->sector->name : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- END Dashboard Charts -->
    </div>
@endif
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <script type="text/javascript">
        !(function (r) {
            var e = {};
            function t(a) {
                if (e[a]) return e[a].exports;
                var o = (e[a] = { i: a, l: !1, exports: {} });
                return r[a].call(o.exports, o, o.exports, t), (o.l = !0), o.exports;
            }
            (t.m = r),
                (t.c = e),
                (t.d = function (r, e, a) {
                    t.o(r, e) || Object.defineProperty(r, e, { enumerable: !0, get: a });
                }),
                (t.r = function (r) {
                    "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(r, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(r, "__esModule", { value: !0 });
                }),
                (t.t = function (r, e) {
                    if ((1 & e && (r = t(r)), 8 & e)) return r;
                    if (4 & e && "object" == typeof r && r && r.__esModule) return r;
                    var a = Object.create(null);
                    if ((t.r(a), Object.defineProperty(a, "default", { enumerable: !0, value: r }), 2 & e && "string" != typeof r))
                        for (var o in r)
                            t.d(
                                a,
                                o,
                                function (e) {
                                    return r[e];
                                }.bind(null, o)
                            );
                    return a;
                }),
                (t.n = function (r) {
                    var e =
                        r && r.__esModule
                            ? function () {
                                  return r.default;
                              }
                            : function () {
                                  return r;
                              };
                    return t.d(e, "a", e), e;
                }),
                (t.o = function (r, e) {
                    return Object.prototype.hasOwnProperty.call(r, e);
                }),
                (t.p = ""),
                t((t.s = 2));
        })([
            ,
            ,
            function (r, e, t) {
                r.exports = t(3);
            },
            function (r, e) {
                function t(r, e) {
                    for (var t = 0; t < e.length; t++) {
                        var a = e[t];
                        (a.enumerable = a.enumerable || !1), (a.configurable = !0), "value" in a && (a.writable = !0), Object.defineProperty(r, a.key, a);
                    }
                }
                var a = (function () {
                    function r() {
                        !(function (r, e) {
                            if (!(r instanceof e)) throw new TypeError("Cannot call a class as a function");
                        })(this, r);
                    }
                    var e, a, o;
                    return (
                        (e = r),
                        (o = [
                            {
                                key: "initChartsChartJS",
                                value: function () {
                                    (Chart.defaults.global.defaultFontColor = "#999"),
                                        (Chart.defaults.global.defaultFontStyle = "600"),
                                        (Chart.defaults.scale.gridLines.color = "rgba(0,0,0,.05)"),
                                        (Chart.defaults.scale.gridLines.zeroLineColor = "rgba(0,0,0,.1)"),
                                        (Chart.defaults.scale.ticks.beginAtZero = !0),
                                        (Chart.defaults.global.elements.line.borderWidth = 2),
                                        (Chart.defaults.global.elements.point.radius = 4),
                                        (Chart.defaults.global.elements.point.hoverRadius = 6),
                                        (Chart.defaults.global.tooltips.cornerRadius = 3),
                                        (Chart.defaults.global.legend.labels.boxWidth = 15);
                                    var r,
                                        e,
                                        t = jQuery(".js-chartjs-lines");
                                    (r = {
                                        labels: [@forelse ($sales as $sale)
                                                    "<?php echo $sale->month; ?>",
                                                @empty
                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"
                                                @endforelse],
                                        datasets: [
                                            {
                                                label: "This Year",
                                                fill: !0,
                                                backgroundColor: "rgba(171, 227, 125, .3)",
                                                borderColor: "rgba(171, 227, 125, 1)",
                                                pointBackgroundColor: "rgba(171, 227, 125, 1)",
                                                pointBorderColor: "#fff",
                                                pointHoverBackgroundColor: "#fff",
                                                pointHoverBorderColor: "rgba(171, 227, 125, 1)",
                                                data: [
                                                @forelse ($sales as $sale)
                                                    "<?php echo $sale->amount; ?>",
                                                @empty
                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"
                                                @endforelse
                                                ],
                                            },
                                        ],
                                    }),
                                        (e = {
                                            labels: ["Earnings", "Sales", "Tickets"],
                                            datasets: [
                                                {
                                                    data: [48, 26, 26],
                                                    backgroundColor: ["rgba(171, 227, 125, 1)", "rgba(250, 219, 125, 1)", "rgba(117, 176, 235, 1)"],
                                                    hoverBackgroundColor: ["rgba(171, 227, 125, .75)", "rgba(250, 219, 125, .75)", "rgba(117, 176, 235, .75)"],
                                                },
                                            ],
                                        }),
                                        t.length && new Chart(t, { type: "line", data: r }),
                                        a.length && new Chart(a, { type: "bar", data: r }),
                                        o.length && new Chart(o, { type: "radar", data: r }),
                                        n.length && new Chart(n, { type: "polarArea", data: e }),
                                        l.length && new Chart(l, { type: "pie", data: e }),
                                        i.length && new Chart(i, { type: "doughnut", data: e });
                                },
                            },
                            {
                                key: "initRandomEasyPieChart",
                                value: function () {
                                    jQuery(".js-pie-randomize").on("click", function (r) {
                                        jQuery(r.currentTarget)
                                            .parents(".block")
                                            .find(".pie-chart")
                                            .each(function (r, e) {
                                                return jQuery(e)
                                                    .data("easyPieChart")
                                                    .update(Math.floor(100 * Math.random() + 1));
                                            });
                                    });
                                },
                            },
                            {
                                key: "init",
                                value: function () {
                                    this.initChartsChartJS(), this.initRandomEasyPieChart();
                                },
                            },
                        ]),
                        (a = null) && t(e.prototype, a),
                        o && t(e, o),
                        r
                    );
                })();
                jQuery(function () {
                    a.init();
                });
            },
        ]);
    </script>

    <script>jQuery(function(){ One.helpers(['easy-pie-chart', 'sparkline']); });</script>
@endsection
