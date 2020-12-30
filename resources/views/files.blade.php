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
                    <a href="#" class="btn  btn-light-danger font-weight-bold py-3 px-6 mr-2">
                        <b> فرمت درایو </b>
                        <i class="flaticon-warning-sign icon-lg"></i></a>
                    <!--end::Button-->

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
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="#" class="navi-link ">
															<span class="navi-icon mr-4">
																<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Files\Folder-plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                          <rect x="0" y="0" width="24" height="24"/>
                                                                            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                                                             <path d="M11,13 L11,11 C11,10.4477153 11.4477153,10 12,10 C12.5522847,10 13,10.4477153 13,11 L13,13 L15,13 C15.5522847,13 16,13.4477153 16,14 C16,14.5522847 15.5522847,15 15,15 L13,15 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,15 L9,15 C8.44771525,15 8,14.5522847 8,14 C8,13.4477153 8.44771525,13 9,13 L11,13 Z" fill="#000000"/>
                                                                    </g>
                                                                </svg><!--end::Svg Icon--></span>
															</span>
                                            <span class="navi-text font-weight-bolder font-size-lg">پوشه جدید</span>

                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="#" class="navi-link">
															<span class="navi-icon mr-4">
                                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Files\Upload.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                        <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                                                                        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    </g>
                                                                </svg>
                                                                    <!--end::Svg Icon--></span>
															</span>
                                            <span class="navi-text font-weight-bolder font-size-lg">آپلود فایل</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="#" class="navi-link">
															<span class="navi-icon mr-4">
                                                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Files\Deleted-folder.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                                                            <path d="M10.5857864,14 L9.17157288,12.5857864 C8.78104858,12.1952621 8.78104858,11.5620972 9.17157288,11.1715729 C9.56209717,10.7810486 10.1952621,10.7810486 10.5857864,11.1715729 L12,12.5857864 L13.4142136,11.1715729 C13.8047379,10.7810486 14.4379028,10.7810486 14.8284271,11.1715729 C15.2189514,11.5620972 15.2189514,12.1952621 14.8284271,12.5857864 L13.4142136,14 L14.8284271,15.4142136 C15.2189514,15.8047379 15.2189514,16.4379028 14.8284271,16.8284271 C14.4379028,17.2189514 13.8047379,17.2189514 13.4142136,16.8284271 L12,15.4142136 L10.5857864,16.8284271 C10.1952621,17.2189514 9.56209717,17.2189514 9.17157288,16.8284271 C8.78104858,16.4379028 8.78104858,15.8047379 9.17157288,15.4142136 L10.5857864,14 Z" fill="#000000"/>
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
															</span>
                                            <span class="navi-text font-weight-bolder font-size-lg">حذف پوشه</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
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
                                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ki ki-bold-more-hor"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                    <!--begin::Navigation-->
                                                                    <ul class="navi navi-hover py-5">
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-drop"></i>
																					</span>
                                                                                <span class="navi-text">New Group</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-list-3"></i>
																					</span>
                                                                                <span class="navi-text">Contacts</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-rocket-1"></i>
																					</span>
                                                                                <span class="navi-text">Groups</span>
                                                                                <span class="navi-link-badge">
																						<span class="label label-light-primary label-inline font-weight-bold">new</span>
																					</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-bell-2"></i>
																					</span>
                                                                                <span class="navi-text">Calls</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-gear"></i>
																					</span>
                                                                                <span class="navi-text">Settings</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-separator my-3"></li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-magnifier-tool"></i>
																					</span>
                                                                                <span class="navi-text">Help</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="navi-item">
                                                                            <a href="#" class="navi-link">
																					<span class="navi-icon">
																						<i class="flaticon2-bell-2"></i>
																					</span>
                                                                                <span class="navi-text">Privacy</span>
                                                                                <span class="navi-link-badge">
																						<span class="label label-light-danger label-rounded font-weight-bold">5</span>
																					</span>
                                                                            </a>
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
