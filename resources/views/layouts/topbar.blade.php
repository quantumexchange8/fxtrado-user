<div class="col-md-12">
    <div class="header">
    <div class="row">
        <div class="col-lg-12 col-xl-6">
        <div class="header__price-update">
            <ul>
            <li>3.33223838 BTC<span>Last Trade Price</span></li>
            <li>4.55% <span>Price (24h)</span></li>
            <li>4.82383 BTC<span>Volume (24h)</span></li>
            </ul>
        </div>
        </div>
        <div class="col-lg-12 col-xl-6">
        <div class="header__user">
            <div class="header__sidebar-icon">
            <img src="assets/img/svg-icon/left-bar.svg" class="svgInject" alt="svg">
            </div>
            <div class="header__user-balance">
            <div class="header__user-balance-icon">
                <img src="assets/img/svg-icon/wallet.svg" class="svgInject" alt="svg">
            </div>
            <div class="header__user-balance-text">
                <h2>Balance: <span>$ {{ Auth::user()->wallet->balance ?? 'No wallet found' }}</span></h2>
                {{-- <span class="green">Growth: <img src="assets/img/svg-icon/up-arrow.svg" class="svgInject"
                    alt="svg"> 29.9%
                </span> --}}
            </div>
            </div>
            <div class="header__user-profile dropdown-toggle" style="background-color: #171717" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <div class="header__user-profile-icon">
                <img src="assets/img/svg-icon/avatar.svg" class="svgInject" alt="svg">
                <span>9</span>
            </div>
            <div class="header__user-profile-text">
                <h2>{{Auth::user()->name}}</h2>
                @if (Auth::user()->email_verified_at != null)
                    <span><img src="assets/img/svg-icon/check.svg" class="svgInject" alt="svg"> Verified</span>
                @else
                    <span style="color: #f87171"><img src="assets/img/svg-icon/check-error.svg" class="svgInject" alt="svg"> Unverified</span>
                @endif
            </div>
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="settings.html"><img src="assets/img/svg-icon/settings-line.svg"
                class="svgInject" alt="svg"> Settings</a>
            <a class="dropdown-item" href="verification.html"><img src="assets/img/svg-icon/user.svg"
                class="svgInject" alt="svg"> Verification</a>
            <a class="dropdown-item" href="security.html"><img src="assets/img/svg-icon/lock.svg"
                class="svgInject" alt="svg"> Security</a>
            <a class="dropdown-item" href="api.html"><img src="assets/img/svg-icon/code.svg" class="svgInject"
                alt="svg"> API</a>
            <a class="dropdown-item" id="themeChange" href="#"><img src="assets/img/svg-icon/sun.svg"
                class="svgInject sun-icon" alt="svg"><img src="assets/img/svg-icon/moon.svg"
                class="svgInject moon-icon" alt="svg"> Theme</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item red">
                    <img src="assets/img/svg-icon/power.svg" class="svgInject" alt="svg">
                    Logout
                </button>
            </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>