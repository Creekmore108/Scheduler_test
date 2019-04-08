# Scheduler_test
Testing DHTMLX Scheduler under nested pages. Initial page and JaveaScript are located in "views/layouts/app.blade.php" and nested scheduler is located in "views/pages/scheduler.blade.php." The @extends('layouts.app') notation is use to load app and @section('content') to add DHTML Scheduler portion of the page.


Sorry the migrations to create the events table and resources tables were in another project and did not get included in the Git.
I created a new project and connected to the existing DB withe the test data loaded.

Here are the migrations to create events and resources tables:

        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->string('color')->default('Blue');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->bigInteger('resource_id')->nullable()->default(null);
            $table->bigInteger('user_id')->nullable()->default(null);
            $table->timestamps();
       
=================================================================

        Schema::create('resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resource_name');
            $table->string('description');
            $table->string('color');
            $table->timestamps();
        
=================================================================
