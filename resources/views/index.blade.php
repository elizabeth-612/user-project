<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

<hr>
<div class="container bootstrap snippets bootdey">
    <div class="row">


        <a href="#" class="btn btn-default" onclick="exportResult()">Export User </a>
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">

                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list" id="userList">
                            <thead>
                                <tr>
                                    <th><span>Name</span></th>
                                    <th><span>Gender</span></th>
                                    <th><span>Location</span></th>
                                    <th><span>Email</span></th>
                                    <th><span>Phone</span></th>
                                    <th><span>Picture</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody id="userData">
                                <!-- results appear here -->
                            </tbody>

                        </table>
                        <div class="ajax-loading"><img src="{{ asset('images/loading.gif') }}" /></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="action" tabindex="-1" role="dialog" aria-labelledby="actionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="actionLabel"></h4>
            </div>
            <div class="modal-body">
                <p id="actionMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a href="#" id="actionURL" class="btn btn-primary">Yes</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<style type="text/css">
    body {
        background: #eee;
    }

    .main-box.no-header {
        padding-top: 20px;
    }

    .btn-default {
        background-color: #337ab7 !important;
        color: #fff;
        font-size: 15px;
        display: inline-block;
        width: auto;
        padding: 10px 20px;
        margin: 20px 0;
    }

    .main-box {
        background: #FFFFFF;
        -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
        box-shadow: 1px 1px 2px 0 #CCCCCC;
        margin-bottom: 16px;
        -webikt-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .label {
        border-radius: 3px;
        font-size: 0.875em;
        font-weight: 600;
    }

    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }

    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 60px;
    }

    a {
        color: #3498db;
        outline: none !important;
    }

    .table thead tr th {
        text-transform: uppercase;
        font-size: 0.875em;
    }

    .table thead tr th {
        border-bottom: 2px solid #e7ebee;
    }

    .table tbody tr td:first-child {
        font-size: 1.125em;
        font-weight: 300;
    }

    .table tbody tr td {
        font-size: 0.875em;
        vertical-align: middle;
        border-top: 1px solid #e7ebee;
        padding: 12px 8px;
    }

    a:hover {
        text-decoration: none;
    }

    .ajax-loading {
        text-align: center;
    }
</style>
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

    function exportResult() {

        var url = "{{ route( 'user.export') }}";
        window.location = url;

    }

    @if(Session::has('success'))
    // Create new Notification
    toastr.clear();
    toastr.options = {
        "closeButton": "true",
        "progressBar": "false",
        "debug": "false",
        "positionClass": "toast-top-right",
        "showDuration": "330",
        "hideDuration": "330",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "slideDown",
        "hideMethod": "slideUp",
        "onclick": null
    }
    toastr.success("{{Session::get('success')}}", 'Success');
    @endif

    // Notification if the process was a failure
    @if(Session::has('fail'))
    // Create new Notification
    toastr.clear();
    toastr.options = {
        "closeButton": "true",
        "progressBar": "false",
        "debug": "false",
        "positionClass": "toast-top-right",
        "showDuration": "330",
        "hideDuration": "330",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "slideDown",
        "hideMethod": "slideUp",
        "onclick": null
    }
    toastr.error("{{Session::get('fail')}}", 'Error');
    @endif
</script>