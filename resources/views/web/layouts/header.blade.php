<style>
    @media (min-width: 1400px) {
        .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
            max-width: 100%;
        }
    }
</style>
<div class="main-header sticky-top mb-2">
    <div class="container w-100">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <img class="image-table" src="{{getFile(auth('web')->user()->image,'web/image/image1.png')}}"
                     alt="no-image">
                <div>
                    <h6 class="name-table d-flex align-items-center">{{auth('web')->user()->full_name}}</h6>
                    <p class="fs-12 text-secondary">مدير النظام</p>
                </div>
            </div>
            <div class="d-flex">
                <div class="header-icon">
                    <ul class="navbar-nav d-flex flex-row">

                        <li class="nav-item dropdown user">
                            <a class="nav-link dropdown-toggle position-relative text-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img style="height: 24px;" src="{{asset('web/image/notification-01.png')}}" alt="no-icon">

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @forelse(\App\Models\Alert::take(3)->get() as $alert) <li>
                                    <a class="dropdown-item" href="{{route('alert.show',[$alert->id])}}">{{$alert->title}}</a>
                                </li>
                                @empty
                                    <p>no notification</p>
                                @endforelse
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="mobile-toggle me-3">
                    <i class="fa-solid fa-bars fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>
