@extends('layout.main')

@section('title')
Users List
@endsection

@section('content')
<div class="container mt-3">
    @if ($message = Session::get('success'))
    <div class="alert alert-success mx-1" role="alert">
        {{ $message }}
    </div>
    @endif
    <h2 class=" text-center">Users List</h2>
    <div class="mt-5">
        <a href="{{ route( 'user.export') }}" class="btn btn-primary">Export Users</a>
    </div>
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Location</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Picture</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="userData">
            <!-- results appear here -->
        </tbody>


    </table>

    <div class="ajax-loading"><img src="{{ asset('images/loading.gif') }}" /></div>
</div>
@endsection
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<style>
    .ajax-loading {
        text-align: center;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    var SITEURL = "{{ url('/') }}";
    var page = 1; //track user scroll as page number, right now page number is 1
    load_more(page); //initial content load
    $(window).scroll(function() { //detect page scroll
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
            page++; //page number increment
            // alert(page);
            load_more(page); //load content   
        }
    });

    function load_more(page) {
        $.ajax({
                url: SITEURL + "?page=" + page,
                type: "get",
                datatype: "html",
                beforeSend: function() {
                    $('.ajax-loading').show();
                }
            })
            .done(function(data) {
                if (data.length == 0) {
                    console.log(data.length);
                    //notify user if nothing to load
                    $('.ajax-loading').html("No more records!");
                    return;
                }
                $('.ajax-loading').hide(); //hide loading animation once data is received
                $("#userData").append(data); //append data into #results element          
                console.log('data.length');
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
    }
</script>