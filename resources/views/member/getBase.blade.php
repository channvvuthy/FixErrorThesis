@extends('layout.member.master')
@section('title')
    Member
@stop
@section('content')
    @include('layout.leaders.widget.header')
    @include('layout.member.widget.navbar')
    <div class="col-md-10">
        <div class="pangasu float">
            <ul class="list-unstyled">
                <li><a href="/administrator/index"><img src="{{asset('icon/1489862497_house.png')}}" alt=""></a></li>
                <li><a href="{{route('createUser')}}">Base List</a></li>
            </ul>
        </div>
        <div class="clearfix clear-top-normal" style="margin-top:15px;"></div>
        <form action="{{route('createLayout')}}" class="SystemForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{Session::token()}}">
            @if($errors->first('notice'))
                <div class="alert alert-success">{{$errors->first('notice')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Base List</h4>
                </div>
                <div class="panel-body" style="overflow: auto;">
                    <table class="table table-bordered" style="width:2000px;">
                        <thead>
                        <tr>
                            <th>Basae Name</th>
                            <th>Base Path</th>
                            <th>Date</th>
                            <th>Base Cheker Name</th>
                            <th>Check Result</th>
                            <th>Prolem</th>
                            <th>Checker Name</th>
                            <th>Checker Result</th>
                            <th>Problem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty(Auth::user()->bases))
                            @foreach(Auth::user()->bases as $base)
                                <tr>
                                    <td>{{$base->name}}</td>
                                    <td class="link"><a href="{{$base->your_url.'/'.$base->name}}/index.php"
                                                        target="_blank">{{$base->your_url.'/'.$base->name}}</a></td>
                                    <td>{{Carbon\Carbon::parse($base->created_at)->format('d/m/Y')}}</td>
                                    <td>{{$base->leader_check_name}}</td>
                                    <td>
                                        <select name="" id=""
                                                @if($base->leader_check_result=="0") style="background-color:red;"
                                                @elseif($base->leader_check_result=="1") style="background-color:green;"
                                                @elseif($base->leader_check_result=="2" )style="background-color:darkorange;"
                                                @else style="background-color:blue;" @endif class="form-control">
                                            <option value="0" @if($base->leader_check_result=="0") selected @endif>
                                                Recorect
                                            </option>
                                            <option value="1" @if($base->leader_check_result=="1") selected @endif>
                                                Complete
                                            </option>
                                            <option value="2" @if($base->leader_check_result=="2") selected @endif>
                                                Edited
                                            </option>
                                            <option value="2"
                                                    @if($base->leader_check_result!="0" &&$base->leader_check_result!="1"  && $base->leader_check_result!="2"  && $base->leader_check_result!="3"  ) selected @endif>
                                                Not yet check
                                            </option>
                                        </select>
                                    </td>
                                    <td>{{$base->leader_check_problem}}</td>
                                    <td>{{$base->first_checker_name}}</td>
                                    <td>
                                        <select name="" id=""
                                                @if($base->first_checker_result=="0") style="background-color:red;"
                                                @elseif($base->first_checker_result=="1") style="background-color:green;"
                                                @elseif($base->first_checker_result=="2" )style="background-color:darkorange;"
                                                @else style="background-color:blue;" @endif class="form-control">
                                            <option value="0" @if($base->first_checker_result=="0") selected @endif>
                                                Recorect
                                            </option>
                                            <option value="1" @if($base->first_checker_result=="1") selected @endif>
                                                Complete
                                            </option>
                                            <option value="2" @if($base->first_checker_result=="2") selected @endif>
                                                Edited
                                            </option>
                                            <option value="2"
                                                    @if($base->first_checker_result!="0" &&$base->first_checker_result!="1"  && $base->leader_check_result!="2"  && $base->first_checker_result!="3"  ) selected @endif>
                                                Not yet check
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                        </tbody>
                    </table>
                </div>
                <div class="clearfix clear-top-simple"></div>
            </div>
        </form>
        <div class="reportMember" style="margin-left:0px;">
            <select name="" id="autoSelect" class="form-control">
                <option value="today">Today</option>
                <option value="month">This Month</option>
                <option value="year">This Year</option>
                <option value="last_year">Last Year</option>
            </select>
        </div>
        <div class="reportMember">
            <b>OR</b>
        </div>
        <div class="reportMember">
            <select name="" id="" class="form-control">
                <option value="">Select Date</option>
                @for($i=1;$i<=31;$i++)
                    <option value="@if($i<10)0{{$i}} @else{{$i}} @endif">@if($i<10)0{{$i}} @else{{$i}} @endif</option>
                @endfor
            </select>
        </div>
        <div class="reportMember">
            <select name="" id="" class="form-control">
                <option value="">Select Month</option>
                @for($i=1;$i<=12;$i++)
                    <option value="@if($i<10)0{{$i}} @else{{$i}} @endif">@if($i<10)0{{$i}} @else{{$i}} @endif</option>
                @endfor
            </select>
        </div>
        <div class="reportMember">
            <input type="text" name="" id="" class="form-control" placeholder="2017">
        </div>
        <div class="reportMember">
            <button class="btn btn-success ">Load</button>
        </div>
        <div class="clearfix"></div>
        <hr>
        <table class="table-bordered table memberReport">
            <thead>
            <tr>
                <th>Name</th>
                <th>Version</th>
                <th>Type</th>
                <th>Date</th>
                <th>Month</th>
                <th>Year</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var tr="";
            jQuery.ajax({
                url:"{{route('memberReport')}}",
                type:"GET",
                dataTaype:"json",
                data:{userId:"{{Auth::user()->id}}"},
                success:function (data) {
                    var total=0;
                    for(var i=0;i<data.length;i++){
                        total++;
                        tr+='<tr><td>'+data[i]['baseName']+'</td><td>'+data[i]['versionName']+'</td><td>'+data[i]['typeName']+'</td><td>'+data[i]['day']+'</td><td>'+data[i]['month']+'</td><td>'+data[i]['year']+'</td></tr>';

                    }
                    tr+='<tr><td colspan="6" align="right">Total  '+total+'</td></tr>';
                    $(".memberReport tbody").html(tr);
                },
                complete:function () {

                }
            });

            $("body").on("change","#autoSelect",function () {
               var q=$(this).val();
               var tr="";
                jQuery.ajax({
                    url:"{{route('memberReport')}}",
                    type:"GET",
                    dataTaype:"json",
                    data:{userId:"{{Auth::user()->id}}",q:q},
                    success:function (data) {
                        var total=0;
                        for(var i=0;i<data.length;i++){
                            total++;
                            tr+='<tr><td>'+data[i]['baseName']+'</td><td>'+data[i]['versionName']+'</td><td>'+data[i]['typeName']+'</td><td>'+data[i]['day']+'</td><td>'+data[i]['month']+'</td><td>'+data[i]['year']+'</td></tr>';
                        }
                        tr+='<tr><td colspan="6" align="right">Total  '+total+'</td></tr>';
                        $(".memberReport tbody").html(tr);

                    },
                    complete:function () {

                    }
                });
            });
        });
    </script>
@stop