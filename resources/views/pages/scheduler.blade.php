@extends('layouts.app')  {{-- scheduler javascript and CSS are loaded in this file --}}

@section('content') {{-- begining of main page calendar section --}}

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

    scheduler.locale.labels.section_owner="Owner";
    scheduler.config.lightbox.sections=[
        {name:"description", height:50, map_to:"text", type:"textarea" , focus:true},
        {name:"owner", height:30, type:"select", options:scheduler.serverList("employees"), map_to:"employee_id" },
        {name:"resource", height:30, type:"select", options:scheduler.serverList("resources"), map_to:"resource_id" },
        {name:"color", height:30, type:"select", options:scheduler.serverList("color"), map_to:"resource_id" },
        {name:"time", height:72, type:"time", map_to:"auto"}
    ];


    function getEmployeeById(id){
        var allEmployees = scheduler.serverList("employees");
        var employee = null;
        for(var i = 0; i < allEmployees.length; i++){
            if(allEmployees[i].key == id){
                employee = allEmployees[i];
                break;
            }
        }
        return employee;
    }

    function getResourceById(id){
        var allResources = scheduler.serverList("resources");
        var resource = null;
        for(var i = 0; i < allResources.length; i++){
            if(allResources[i].key == id){
                resource = allResources[i];
                break;
            }
        }
        return resource;
    }

    function getColorById(id){
        var allColors = scheduler.serverList("color");
        var color = null;
        for(var i = 0; i < allColors.length; i++){
            if(allColors[i].key == id){
                color = allColors[i];
                break;
            }
        }
        return color;
    }

    scheduler.templates.event_color = function(start, end, ev){
      var color = getColorById(event.resource_id);
      
      return color;

     }


    scheduler.templates.event_text = function(start, end, event){
        var employee = getEmployeeById(event.employee_id);
        var resource = getResourceById(event.resource_id);
        var color = getColorById(event.resource_id);
        

        var evTxt = event.text;
        var html = '';
        if(employee || resource){
            html += "<br>User: " + employee.label + "<br>Resource: " + resource.label + "<br>Description: " + evTxt + ", " + color.label;
        }

        //scheduler.getEvent(event.resource_id).color = color;
        //scheduler.updateEvent(event.resource_id);
        return html;
    }
    scheduler.templates.event_bar_text = function(start, end, event){
        var employee = getEmployeeById(event.employee_id);
        var resource = getResourceById(event.resource_id);
        var color = getColorById(event.resource_id);

        var html = '';
        if(employee || resource){
            html += "<b> Resource: </b>" + resource.label + ",<b> User: </b>" + employee.label + color.label;
        }
        return html;
    }


    scheduler.setLoadMode("day");//!


    scheduler.init("scheduler_here", new Date(2019, 3, 1), "week");
    //scheduler.init("scheduler_here", new Date(Today()), "week");


    scheduler.load("/api/events", "json");//!
    var dp = new dataProcessor("/api/events");//!
    dp.init(scheduler);
    dp.setTransactionMode("REST");
    
</script>

@endsection
