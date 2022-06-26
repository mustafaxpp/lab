<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item dropdown text-uppercase">
            <button class="btn btn-primary btn-sm dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe"></i> {{ app()->getLocale() }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 0px">
                @foreach ($languages as $lang)
                    @if (app()->getLocale() != $lang['iso'])
                        <a class="dropdown-item"
                            href="{{ route('change_locale', $lang['iso']) }}">{{ $lang['iso'] }}</a>
                    @endif
                @endforeach
            </div>
        </li>

        @can('admin')
      
            @if (auth()->guard('admin')->user()->roles()->count() > 0 && auth()->guard('admin')->user()->roles[0]->role_id != 6)
                <li class="nav-item dropdown">
                    <button class="btn btn-info btn-sm dropdown-toggle ml-1" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-map-marked-alt"></i> {{ session('branch_name') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 0px">
                        @if (count($user_branches))
                            @foreach ($user_branches as $branch)
                                <a class="dropdown-item"
                                    href="{{ route('admin.change_branch', $branch['branch_id']) }}">{{ $branch['branch']['name'] }}</a>
                            @endforeach
                        @else
                            <span class="dropdown-item">
                                {{ __('No other branches') }}
                            </span>
                        @endif
                    </div>
                </li>
            @else
            @endif
        @endcan

        <li>
            <!-- modal button -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalnew">
                <i class="fas fa-plus"></i> نقطه بيع
            </button>

            <!-- Modal -->
            <div class="modal fade1" id="exampleModalnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalnewLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalnewLabel">اضف نقطه بيع</h5><br><br>
                            <p>مجموع البيع اليوم : {{ $point_sale ? $point_sale->total_sale : '0:00' }}</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.add_point_sale') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="price">{{ __('Price') }}</label>
                                    <input type="number" class="form-control" value="{{ $point_sale ? $point_sale->point_sale : '0:00' }}" id="point_sale" name="point_sale"
                                        placeholder="{{ __('Price') }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </li>
    </ul>
    <!-- \Left navbar links -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Theme -->
        <li class="nav-item">
            <a class="nav-link change_theme" href="#">
                <i class="fa fa-moon" aria-hidden="true"></i>
            </a>
        </li>
        <!-- \Theme -->

        @can('view_visit')
            <!-- home visits notification -->
            <li class="nav-item dropdown visits_notification">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge visits_count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"><span class="visits_count">0</span>
                        {{ __('New home visits') }}</span>
                    <div class="dropdown-divider"></div>
                    <div class="list_visits">

                    </div>
                </div>
            </li>
            <!-- \home visits notification -->
        @endcan

        @can('view_chat')
            <!--  messages notifications -->
            <li class="nav-item dropdown show messages_notification">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge unread_messages_count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <span class="dropdown-item dropdown-header"><span class="unread_messages_count">0</span>
                        {{ __('New messages') }}</span>
                    <div class="dropdown-divider"></div>
                    <div class="list_unread_messages">

                    </div>
                </div>
            </li>
            <!--  \messages notifications -->
        @endcan

        <!--  messages notifications -->
        @can('view_product')
            <li class="nav-item dropdown show messages_notification">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                    <i class="fas fa-cubes"></i>
                    <span class="badge badge-danger navbar-badge stock_alerts_count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <span class="dropdown-item dropdown-header"><span class="stock_alerts_count">0</span>
                        {{ __('Stock alerts') }}</span>
                    <div class="dropdown-divider"></div>
                    <div class="list_stock_alerts">

                    </div>
                </div>
            </li>
        @endcan
        <!--  \messages notifications -->

        <!--  logout  -->
        <li class="nav-item">
            <button type="button" class="btn btn-danger btn-sm" role="button"
                onclick="document.getElementById('sign_out').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </button>
            <form id="sign_out" method="POST"
                action="@if (auth()->guard('admin')->check()) {{ route('admin.logout') }}@else{{ route('patient.logout') }} @endif">
                @csrf
            </form>
        </li>
        <!--  \logout  -->

    </ul>
    <!-- \Right navbar links -->

</nav>
