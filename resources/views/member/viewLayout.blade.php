@extends('layout.member.master')
@section('title')
    Member
@stop
@section('content')
    @include('layout.member.widget.header')

    @include('layout.member.widget.navbar')
    <div class="col-md-10">
        <div class="pangasu float">
            <ul class="list-unstyled">
                <li><a href="/administrator/index"><img src="{{asset('icon/1489862497_house.png')}}" alt=""></a></li>
                <li><a href="{{route('createUser')}}">View Layout</a></li>
            </ul>
        </div>
        <div class="clearfix clear-top-normal" style="margin-top:15px;"></div>
        <div class="panel-default">
            <div class="panel-heading">
                <h4 style="padding:0px;margin:0px;">View PDF Layout</h4>
            </div>
            <div class="panel-body">
                @if(!empty($folders))
                    @foreach($folders as $folder)
                        <a href="{{route('previewFile',['name'=>$folder,'type'=>'pdf'])}}" target="_blank">{{$folder}}</a>
                        <div class="clearfix"></div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop
