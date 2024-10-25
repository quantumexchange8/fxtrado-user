<div class="col-md-12">
    <div class="header">
    <div class="row">
        <div class="col-lg-12 col-xl-6">
        
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
                <span style="font-size: 12px;color:white">
                    Wallet No: {{ Auth::user()->wallet->wallet_no ?? '' }}
                </span>
                <h2>Balance: <span>$ {{ Auth::user()->wallet->balance ?? 'No wallet found' }}</span></h2>
            </div>
            </div>
            <div class="header__user-profile dropdown-toggle" style="background-color: #171717" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <div class="header__user-profile-icon">
                <img src="assets/img/svg-icon/avatar.svg" class="svgInject" alt="svg">
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
            {{-- <a class="dropdown-item" href="#"><img src="assets/img/svg-icon/settings-line.svg"
                class="svgInject" alt="svg"> Settings</a> --}}
            {{-- <a class="dropdown-item" href="#"><img src="assets/img/svg-icon/user.svg"
            class="svgInject" alt="svg"> Verification</a> --}}
            {{-- <a class="dropdown-item" href="#"><img src="assets/img/svg-icon/lock.svg"
                class="svgInject" alt="svg"> Security</a> --}}
            {{-- <a class="dropdown-item" id="themeChange" href="#"><img src="assets/img/svg-icon/sun.svg"
                class="svgInject sun-icon" alt="svg"><img src="assets/img/svg-icon/moon.svg"
                class="svgInject moon-icon" alt="svg"> Theme</a> --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item red" style="display:flex;gap:16px;align-items: center;">
                    <img src="assets/img/svg-icon/power.svg" class="svgInject" alt="svg">
                    <span>Logout</span>
                </button>
            </form>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>