<style>
  @media (min-width: 768px) {
        .language-mobile {
            display: none !important;
        }
    }
</style>

<nav class="navigation">
  <div class="navigation__header">
    <img src="assets/img/fxtrado_logo.svg" class="svgInject navigation__logo--large" alt="fxtrado logo" style="display: none;">
    <img src="assets/img/fx_logo_small.svg" class="svgInject navigation__logo--small" alt="small logo">
  </div>
  <div class="navigation__list">
    <ul>
      {{-- <li class="navigation__item">
        <a href="{{ route('dashboard') }}" class="navigation__item-link {{ request()->is('dashboard') ? 'active' : '' }}">
          <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/dash.svg"
              class="svgInject navigation__item-icon" alt="svg">
          </span>
          <span class="navigation__item-label">Dashboard</span>
        </a>
      </li> --}}
      <li class="navigation__item">
        <a href="{{ route('forex_pair') }}" class="navigation__item-link {{ request()->is('forex_pair') ? 'active' : '' }}">
          <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/dash.svg"
              class="svgInject navigation__item-icon" alt="svg">
          </span>
          <span class="navigation__item-label">{{ __('exchange') }}</span>
        </a>
      </li>
      <li class="navigation__item">
        <a href="{{ route('orders') }}" class="navigation__item-link {{ request()->is('orders') ? 'active' : '' }}">
          <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/history.svg"
              class="svgInject navigation__item-icon" alt="svg">
          </span>
          <span class="navigation__item-label">{{ __('sidebar_order_history') }}</span>
        </a>
      </li>
      <li class="navigation__item">
        <a href="{{ route('wallet') }}" class="navigation__item-link {{ request()->is('wallet') ? 'active' : '' }}">
          <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/wallet.svg"
              class="svgInject navigation__item-icon" alt="svg">
          </span>
          <span class="navigation__item-label">{{ __('wallet') }}</span>
        </a>
      </li>
      <li class="navigation__item">
        <a href="{{ route('profile') }}" class="navigation__item-link {{ request()->is('profile') ? 'active' : '' }}">
          <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/user.svg"
              class="svgInject navigation__item-icon" alt="svg">
          </span>
          <span class="navigation__item-label">{{ __('profile') }}</span>
        </a>
      </li>
      <li class="navigation__item language-mobile" style="display: flex;items-center" onclick="toggleLanguage()">
        <span class="navigation__item-icon-wrapper">
          <i class="fa-solid fa-language" style="width: 40px;height:30px;cursor: pointer;color:white"></i>
        </span>
        <div style="display: flex;justify-content:flex-end">
          <select class="language-selector" onchange="changeLanguage(event)">
              <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }}>English</option>
              <option value="tw" {{ session('locale') === 'tw' ? 'selected' : '' }}>繁體中文</option>
              <option value="cn" {{ session('locale') === 'cn' ? 'selected' : '' }}>简体中文</option>
              <option value="jpy" {{ session('locale') === 'jpy' ? 'selected' : '' }}>日本語</option>
              <option value="korea" {{ session('locale') === 'korea' ? 'selected' : '' }}>한국인</option>
              <option value="thai" {{ session('locale') === 'thai' ? 'selected' : '' }}>แบบไทย</option>
              <option value="vn" {{ session('locale') === 'vn' ? 'selected' : '' }}>Tiếng Việt</option>
              <!-- Add more languages if necessary -->
          </select>
        </div>
      </li>
    </ul>
  </div>
</nav>