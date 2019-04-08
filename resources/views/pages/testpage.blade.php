@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test Page</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Here is my test page
                </div>

                <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
                   <div class="dhx_cal_navline">
                       <div class="dhx_cal_prev_button">&nbsp;</div>
                       <div class="dhx_cal_next_button">&nbsp;</div>
                       <div class="dhx_cal_today_button"></div>
                       <div class="dhx_cal_date"></div>
                       <div class="dhx_cal_tab" name="day_tab"></div>
                       <div class="dhx_cal_tab" name="week_tab"></div>
                       <div class="dhx_cal_tab" name="month_tab"></div>
                   </div>
                   <div class="dhx_cal_header"></div>
                   <div class="dhx_cal_data"></div>
                </div>
                <script type="text/javascript">
                    scheduler.config.xml_date = "%Y-%m-%d %H:%i:%s";

                    scheduler.setLoadMode("day");//!


                    scheduler.init("scheduler_here", new Date(2019, 3, 1), "week");
                    //scheduler.init("scheduler_here", new Date(Today()), "week");


                    //scheduler.load("/api/events", "json");//!
                </script>
            </div>
        </div>
    </div>
</div>
@endsection