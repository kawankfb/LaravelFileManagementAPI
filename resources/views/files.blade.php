@extends('layouts.master')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Mobile Toggle-->
                    <!--begin::Heading-->
                    <div class="d-flex flex-column">
                        <!--begin::Title-->
                        <h2 class="text-white font-weight-bold my-2 mr-5">درایو</h2>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Button-->
                    <a href="#" class="btn  btn-light-info font-weight-bold py-3 px-6 mr-2">
                        <span>فضای مصرف شده:</span>
                        <b> {{$used_space}}MB </b>
                        </a>
                    <!--end::Button-->
                    <a href="#" class="btn  btn-light-info font-weight-bold py-3 px-6 mr-2">
                        <span>تعداد فایل ها:</span>
                        <b>{{$file_count}}</b>
                    </a>

                </div>

                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">


            <!--begin::Container-->
            <div class="container">
                <!--begin::Todo Files-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_todo_aside">
                        <!--begin::Card-->
                        <div class="card card-custom card-stretch">
                            <!--begin::Body-->
                            <div class="card-body px-5">
                                <!--begin:Nav-->
                                <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                    <form action="{{$route}}" class="form" method="POST" enctype="multipart/form-data" >
                                        @csrf
                                        <!--begin:Item-->
                                        <div class="navi-item my-2">
                                            <a class="navi-link ">
                                                <span class="navi-text font-weight-bolder font-size-lg">پوشه جدید</span>
                                                <input type="text" name="folder">


                                            </a>
                                        </div>
                                        <!--end:Item-->
                                        <!--begin:Item-->
                                        <div class="navi-item my-2">
                                            <div class="navi-link   d-flex flex-row">

                                                <label class="navi-text font-weight-bolder font-size-lg" for="customFile">فایل</label>
                                                <input type="file" name="file" class="custom-file-input form-control-lg" id="customFile">

                                            </div>
                                        </div>
                                        <!--end:Item-->
                                        <!--begin:Item-->
                                        <div class="navi-item my-2">
                                            <button type="submit" class="btn btn-primary d-flex flex-row">


                                                <span class="navi-text font-weight-bolder font-size-lg">تایید</span>

                                            </button>
                                        </div>

                                            <!--end:Item-->
                                    </form>
                                </div>
                                <!--end:Nav-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Aside-->

                    <!--begin::List-->
                    <div class="flex-row-fluid d-flex flex-column ml-lg-8">
                        <div class="d-flex flex-column flex-grow-1">
                            <!--begin::Head-->

                            <!--end::Head-->
                            @foreach(array_chunk($final, 4) as $chunk)
                                <!--begin::Row-->
                                 <div class="row">
                                    @foreach($chunk as $add)
                                        <!--begin::Col-->
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                                <!--begin::Card-->
                                                <div class="card card-custom gutter-b card-stretch">
                                                    <div class="card-header border-0">
                                                        <h3 class="card-title"></h3>
                                                        <div class="card-toolbar">
                                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                                                <a href="" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ki ki-bold-more-hor"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                    <!--begin::Navigation-->
                                                                    <ul class="navi navi-hover py-5">
                                                                        <li class="navi-item">
                                                                            <form action="{{$add['url']}}" method="post">


                                                                                    @csrf
                                                                                    @method('delete')
                                                                                <button type="submit" class="btn btn-danger justify-content-center ">حذف</button>


                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                    <!--end::Navigation-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="d-flex flex-column align-items-center">

                                                            <!--begin: Icon-->
                                                            <img alt="" class="max-h-65px" src="{{$add['svg_path']}}" />
                                                            <!--end: Icon-->
                                                            <!--begin: Title-->
                                                            <a href="{{$add['url']}}" class="text-dark-75 font-weight-bold mt-15 font-size-lg">{{$add['basename']}}</a>
                                                            <!--end: Title-->

                                                        </div>
                                                    </div>

                                                </div>
                                                <!--end:: Card-->
                                            </div>
                                            <!--end::Col-->
                                    @endforeach

                                </div>
                                <!--end::Row-->
                        @endforeach




                        </div>
                    </div>
                    <!--end::List-->
                </div>
                <!--end::Todo Files-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
