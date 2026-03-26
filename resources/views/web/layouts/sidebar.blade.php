<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="image-logo d-flex justify-content-center">
        <img src="{{asset('web/image/logo.png')}}" style="height: 35px !important;" alt="no-logo">
    </div>
    <hr class="hr-logo">
    <!-- SIDEBAR MENU -->
    <ul class="sidebar-menu fixed-menu">
        <li>
            <a href="{{route('adminHome')}}" class="link-sidebar {{ activeRoute('adminHome') }}">
                <svg class="sidebar-icon" width="32" height="32" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.33247 17.1838H15.6658C16.6476 17.1838 17.4436 16.3879 17.4436 15.406V8.73937L10.9991 4.29492L4.55469 8.73937V15.406C4.55469 16.3879 5.35063 17.1838 6.33247 17.1838Z"
                        stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M8.99859 14.0718C8.99859 13.09 9.79453 12.2941 10.7764 12.2941H11.2208C12.2027 12.2941 12.9986 13.09 12.9986 14.0718V17.1829H8.99859V14.0718Z"
                        stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>الرئيسية</span>
            </a>
        </li>


        @can('admins')
            <li>
                <a href="{{route('admins.index')}}" class="link-sidebar {{  activeRoute('admins.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M14.3333 12.5175C16.1811 12.5175 16.9379 14.4267 17.2434 15.8028C17.4084 16.546 16.8074 17.1842 16.0461 17.1842H15.2222M13.4444 9.18418C14.7945 9.18418 15.6667 8.08976 15.6667 6.73973C15.6667 5.3897 14.7945 4.29529 13.4444 4.29529M12.0829 17.1842H5.4726C4.97082 17.1842 4.57599 16.7679 4.67598 16.2762C4.95203 14.9186 5.8536 12.5175 8.77777 12.5175C11.7019 12.5175 12.6035 14.9186 12.8796 16.2762C12.9795 16.7679 12.5847 17.1842 12.0829 17.1842ZM11.2222 6.73973C11.2222 8.08976 10.1278 9.18418 8.77777 9.18418C7.42774 9.18418 6.33332 8.08976 6.33332 6.73973C6.33332 5.3897 7.42774 4.29529 8.77777 4.29529C10.1278 4.29529 11.2222 5.3897 11.2222 6.73973Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>ادارة مدراء النظام</span>
                </a>
            </li>
        @endcan


        @can('roles')
            <li>
                <a href="{{route('role.index')}}" class="link-sidebar  {{ activeRoute('role.index') }}">
                    <svg class="sidebar-icon" width="32" height="32" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.2198 17.1838H6.50827C5.45984 17.1838 4.67748 16.2596 5.21167 15.3575C5.98645 14.0491 7.65479 12.5171 11.2198 12.5171M13.442 15.8505L14.5531 17.1838L17.442 13.1838M13.8865 7.18381C13.8865 8.7793 12.5931 10.0727 10.9976 10.0727C9.40209 10.0727 8.10869 8.7793 8.10869 7.18381C8.10869 5.58832 9.40209 4.29492 10.9976 4.29492C12.5931 4.29492 13.8865 5.58832 13.8865 7.18381Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة الأدوار والصلاحيات</span>
                </a>
            </li>
        @endcan

        @can('users')
            <li>
                <a href="{{route('users.index')}}" class="link-sidebar {{  activeRoute('users.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M14.3333 12.5175C16.1811 12.5175 16.9379 14.4267 17.2434 15.8028C17.4084 16.546 16.8074 17.1842 16.0461 17.1842H15.2222M13.4444 9.18418C14.7945 9.18418 15.6667 8.08976 15.6667 6.73973C15.6667 5.3897 14.7945 4.29529 13.4444 4.29529M12.0829 17.1842H5.4726C4.97082 17.1842 4.57599 16.7679 4.67598 16.2762C4.95203 14.9186 5.8536 12.5175 8.77777 12.5175C11.7019 12.5175 12.6035 14.9186 12.8796 16.2762C12.9795 16.7679 12.5847 17.1842 12.0829 17.1842ZM11.2222 6.73973C11.2222 8.08976 10.1278 9.18418 8.77777 9.18418C7.42774 9.18418 6.33332 8.08976 6.33332 6.73973C6.33332 5.3897 7.42774 4.29529 8.77777 4.29529C10.1278 4.29529 11.2222 5.3897 11.2222 6.73973Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة الموظفين</span>
                </a>
            </li>
        @endcan


        @can('settings')
            <li>
                <a href="{{route('settings.index')}}" class="link-sidebar  {{ activeRoute('settings.index') }}">


                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 6V12" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M16.24 16.24L12 12" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                    <span>ادارة اوقات العمل</span>

                </a>
            </li>
        @endcan


        {{-- @can('excel_import_export')--}}
        <li>
            <a href="{{route('attendance.index')}}" class="link-sidebar  {{ activeRoute('attendance.index') }}">

                <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                    fill="none">
                    <path
                        d="M16.3332 8.29529H12.5554V4.51751M8.99989 13.6286H12.9999M8.99989 10.962H12.9999M14.7777 17.1842H7.22211C6.24027 17.1842 5.44434 16.3882 5.44434 15.4064V6.07307C5.44434 5.09123 6.24027 4.29529 7.22211 4.29529H12.7777L16.5554 8.07307V15.4064C16.5554 16.3882 15.7595 17.1842 14.7777 17.1842Z"
                        stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>سجل الحضور و الانصراف</span>
            </a>
        </li>
        {{-- @endcan--}}



        @can('axes')
            <li>
                <a href="{{route('area')}}" class="link-sidebar {{ activeRoute('area') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M6.33247 17.1838H15.6658C16.6476 17.1838 17.4436 16.3879 17.4436 15.406V8.73937L10.9991 4.29492L4.55469 8.73937V15.406C4.55469 16.3879 5.35063 17.1838 6.33247 17.1838Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة المناطق</span>
                </a>
            </li>
        @endcan

        @can('axes')
            <li>
                <a href="{{route('trips.index')}}" class="link-sidebar {{ activeRoute('trips.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M8.55566 4.29529L4.55566 6.07307V17.1842L8.55566 15.4064M8.55566 4.29529V15.4064M8.55566 4.29529L13.4446 6.07307M8.55566 15.4064L13.4446 17.1842M13.4446 6.07307L17.4446 4.29529V15.4064L13.4446 17.1842M13.4446 6.07307V17.1842"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة الرحلات</span>
                </a>
            </li>
        @endcan

        @can('axes')
            <li>
                <a href="{{route('survey.index')}}" class="link-sidebar {{ activeRoute('survey.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M8.55566 4.29529L4.55566 6.07307V17.1842L8.55566 15.4064M8.55566 4.29529V15.4064M8.55566 4.29529L13.4446 6.07307M8.55566 15.4064L13.4446 17.1842M13.4446 6.07307L17.4446 4.29529V15.4064L13.4446 17.1842M13.4446 6.07307V17.1842"
                            stroke="#565A5D" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة الإستبيانات</span>
                </a>
            </li>
        @endcan

        @can('axes')
            <li>
                <a href="{{route('axesManagement')}}" class="link-sidebar {{ activeRoute('axesManagement') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M8.55566 4.29529L4.55566 6.07307V17.1842L8.55566 15.4064M8.55566 4.29529V15.4064M8.55566 4.29529L13.4446 6.07307M8.55566 15.4064L13.4446 17.1842M13.4446 6.07307L17.4446 4.29529V15.4064L13.4446 17.1842M13.4446 6.07307V17.1842"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة التقارير</span>
                </a>
            </li>
        @endcan
        {{-- @can('buses')--}}
        <!-- <li>
            <a href="{{route('buses.index')}}" class="link-sidebar {{  activeRoute('buses.index') }}">
                <svg class="sidebar-icon" width="32" height="32" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4 10C4 6.22876 4 4.34315 5.17157 3.17157C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.17157C20 4.34315 20 6.22876 20 10V12C20 15.7712 20 17.6569 18.8284 18.8284C17.6569 20 15.7712 20 12 20C8.22876 20 6.34315 20 5.17157 18.8284C4 17.6569 4 15.7712 4 12V10Z"
                        stroke="white" stroke-width="1.5" />
                    <path d="M4 13H20" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M15.5 16H17" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M7 16H8.5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M6 19.5V21C6 21.5523 6.44772 22 7 22H8.5C9.05228 22 9.5 21.5523 9.5 21V20" stroke="white"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M18 19.5V21C18 21.5523 17.5523 22 17 22H15.5C14.9477 22 14.5 21.5523 14.5 21V20"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M20 9H21C21.5523 9 22 9.44772 22 10V11C22 11.3148 21.8518 11.6111 21.6 11.8L20 13"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 9H3C2.44772 9 2 9.44772 2 10V11C2 11.3148 2.14819 11.6111 2.4 11.8L4 13"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19.5 5H4.5" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <span>تقارير انتهاء الذروة</span>
            </a>
        </li> -->
        {{-- @endcan--}}
        <!-- @can('reports')
            <li>
                <a href="{{route('report.index')}}" class="link-sidebar {{ activeRoute('report.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M16.3332 8.29529H12.5554V4.51751M14.7777 17.1842H7.22211C6.24027 17.1842 5.44434 16.3882 5.44434 15.4064V6.07307C5.44434 5.09123 6.24027 4.29529 7.22211 4.29529H12.7777L16.5554 8.07307V15.4064C16.5554 16.3882 15.7595 17.1842 14.7777 17.1842Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة تقارير المشرفين</span>
                </a>
            </li>
        @endcan -->
        <!-- @can('daily_reports')
            <li>
                <a href="{{route('daily_report.index')}}" class="link-sidebar {{ activeRoute('daily_report.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M13.8889 17.1842L11 15.4064L8.11111 17.1842M6.33334 14.5175H15.6667C16.6485 14.5175 17.4444 13.7216 17.4444 12.7397V6.07307C17.4444 5.09123 16.6485 4.29529 15.6667 4.29529H6.33333C5.3515 4.29529 4.55556 5.09123 4.55556 6.07307V12.7397C4.55556 13.7216 5.3515 14.5175 6.33334 14.5175Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة التقارير اليومية</span>
                </a>
            </li>
        @endcan -->
        <!-- @can('notifications')
            <li>
                <a href="{{route('alert.index')}}" class="link-sidebar {{ activeRoute('alert.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M8.33333 14.962C8.33333 14.962 8.33333 17.1842 11 17.1842C13.6667 17.1842 13.6667 14.962 13.6667 14.962M15.6667 8.96195V10.7397L17.4444 14.5175H4.55556L6.33333 10.7397V8.96195C6.33333 6.38463 8.42267 4.29529 11 4.29529C13.5773 4.29529 15.6667 6.38463 15.6667 8.96195Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>إدارة التنبيهات</span>
                </a>
            </li>
        @endcan -->
        <!-- @can('notices')
            <li>
                <a href="{{route('notice.index')}}" class="link-sidebar {{ activeRoute('notice.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.35781 10.7405C5.35781 7.6232 7.88492 5.09609 11.0023 5.09609C14.1196 5.09609 16.6467 7.6232 16.6467 10.7405C16.6467 13.8579 14.1196 16.385 11.0023 16.385C7.88492 16.385 5.35781 13.8579 5.35781 10.7405ZM11.0023 3.49609C7.00126 3.49609 3.75781 6.73954 3.75781 10.7405C3.75781 14.7415 7.00126 17.985 11.0023 17.985C15.0033 17.985 18.2467 14.7415 18.2467 10.7405C18.2467 6.73954 15.0033 3.49609 11.0023 3.49609ZM11.0023 8.42943C11.1986 8.42943 11.3578 8.27024 11.3578 8.07387C11.3578 7.8775 11.1986 7.71832 11.0023 7.71832C10.8059 7.71832 10.6467 7.8775 10.6467 8.07387C10.6467 8.27024 10.8059 8.42943 11.0023 8.42943ZM9.75781 8.07387C9.75781 7.38658 10.315 6.82943 11.0023 6.82943C11.6895 6.82943 12.2467 7.38658 12.2467 8.07387C12.2467 8.76116 11.6895 9.31832 11.0023 9.31832C10.315 9.31832 9.75781 8.76116 9.75781 8.07387ZM11.0005 10.8294C11.4423 10.8294 11.8005 11.1876 11.8005 11.6294V13.4072C11.8005 13.849 11.4423 14.2072 11.0005 14.2072C10.5587 14.2072 10.2005 13.849 10.2005 13.4072V11.6294C10.2005 11.1876 10.5587 10.8294 11.0005 10.8294Z"
                            fill="white" />
                    </svg>
                    <span>إدارة البلاغات</span>
                </a>
            </li>
        @endcan -->


        <!-- @can('notices')
            <li>
                <a href="{{route('suggestion.index')}}" class="link-sidebar {{ activeRoute('suggestion.index') }}">
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.35781 10.7405C5.35781 7.6232 7.88492 5.09609 11.0023 5.09609C14.1196 5.09609 16.6467 7.6232 16.6467 10.7405C16.6467 13.8579 14.1196 16.385 11.0023 16.385C7.88492 16.385 5.35781 13.8579 5.35781 10.7405ZM11.0023 3.49609C7.00126 3.49609 3.75781 6.73954 3.75781 10.7405C3.75781 14.7415 7.00126 17.985 11.0023 17.985C15.0033 17.985 18.2467 14.7415 18.2467 10.7405C18.2467 6.73954 15.0033 3.49609 11.0023 3.49609ZM11.0023 8.42943C11.1986 8.42943 11.3578 8.27024 11.3578 8.07387C11.3578 7.8775 11.1986 7.71832 11.0023 7.71832C10.8059 7.71832 10.6467 7.8775 10.6467 8.07387C10.6467 8.27024 10.8059 8.42943 11.0023 8.42943ZM9.75781 8.07387C9.75781 7.38658 10.315 6.82943 11.0023 6.82943C11.6895 6.82943 12.2467 7.38658 12.2467 8.07387C12.2467 8.76116 11.6895 9.31832 11.0023 9.31832C10.315 9.31832 9.75781 8.76116 9.75781 8.07387ZM11.0005 10.8294C11.4423 10.8294 11.8005 11.1876 11.8005 11.6294V13.4072C11.8005 13.849 11.4423 14.2072 11.0005 14.2072C10.5587 14.2072 10.2005 13.849 10.2005 13.4072V11.6294C10.2005 11.1876 10.5587 10.8294 11.0005 10.8294Z"
                            fill="white" />
                    </svg>
                    <span>إدارة الاقتراحات</span>
                </a>
            </li>
        @endcan -->





        @can('logs')
            <!-- <li>
                <a href="{{route('activity_logs.index')}}" class="link-sidebar  {{ activeRoute('activity_logs.index') }}">

                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                        fill="none">
                        <path
                            d="M16.3332 8.29529H12.5554V4.51751M8.99989 13.6286H12.9999M8.99989 10.962H12.9999M14.7777 17.1842H7.22211C6.24027 17.1842 5.44434 16.3882 5.44434 15.4064V6.07307C5.44434 5.09123 6.24027 4.29529 7.22211 4.29529H12.7777L16.5554 8.07307V15.4064C16.5554 16.3882 15.7595 17.1842 14.7777 17.1842Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>سجل عمليات النظام</span>
                </a>
            </li> -->
        @endcan

        {{-- @can('excel_import_export')--}}
        <!-- <li>
            <a href="{{route('excel_import_export.index')}}"
                class="link-sidebar  {{ activeRoute('excel_import_export.index') }}">

                <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                    fill="none">
                    <path
                        d="M16.3332 8.29529H12.5554V4.51751M8.99989 13.6286H12.9999M8.99989 10.962H12.9999M14.7777 17.1842H7.22211C6.24027 17.1842 5.44434 16.3882 5.44434 15.4064V6.07307C5.44434 5.09123 6.24027 4.29529 7.22211 4.29529H12.7777L16.5554 8.07307V15.4064C16.5554 16.3882 15.7595 17.1842 14.7777 17.1842Z"
                        stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>استيراد وتصدير البيانات</span>
            </a>
        </li> -->
        {{-- @endcan--}}



        {{-- @can('supports')--}}
        <!-- <li>
            <a href="{{route('supports.index')}}" class="link-sidebar {{  activeRoute('supports.index') }}">
                <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                    fill="none">
                    <path
                        d="M14.3333 12.5175C16.1811 12.5175 16.9379 14.4267 17.2434 15.8028C17.4084 16.546 16.8074 17.1842 16.0461 17.1842H15.2222M13.4444 9.18418C14.7945 9.18418 15.6667 8.08976 15.6667 6.73973C15.6667 5.3897 14.7945 4.29529 13.4444 4.29529M12.0829 17.1842H5.4726C4.97082 17.1842 4.57599 16.7679 4.67598 16.2762C4.95203 14.9186 5.8536 12.5175 8.77777 12.5175C11.7019 12.5175 12.6035 14.9186 12.8796 16.2762C12.9795 16.7679 12.5847 17.1842 12.0829 17.1842ZM11.2222 6.73973C11.2222 8.08976 10.1278 9.18418 8.77777 9.18418C7.42774 9.18418 6.33332 8.08976 6.33332 6.73973C6.33332 5.3897 7.42774 4.29529 8.77777 4.29529C10.1278 4.29529 11.2222 5.3897 11.2222 6.73973Z"
                        stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>الدعم الفني</span>
            </a>
        </li> -->
        {{-- @endcan--}}




        {{-- @can('seasons')--}}
        <!-- <li>
            <a href="{{route('seasons.index')}}" class="link-sidebar  {{ activeRoute('seasons.index') }}">


                <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 22 22"
                    fill="none">
                    <path
                        d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12 6V12" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M16.24 16.24L12 12" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <span>أدارة المواسم</span>

            </a>
        </li> -->
        {{-- @endcan--}}

        <li>
            <a href="{{ route('admin.logout') }}" class="link-sidebar logout-button" {{ activeRoute('admin.logout') }}>
                <svg class="sidebar-icon" width="32" height="32" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.99913 8.11024L12.1102 10.9991L8.99913 13.888M8.99913 4.55469H15.6658C16.6476 4.55469 17.4436 5.35063 17.4436 6.33247V15.6658C17.4436 16.6476 16.6476 17.4436 15.6658 17.4436H8.99913M11.888 10.9991H4.55469"
                        stroke="#C65B5B" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>


                <span class="logout-text"> تسجيل الخروج</span>

            </a>


        </li>

    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->