<nav class="navigation">
    <div class="navigation__header">
      <a href="index.html" class="navigation-header-link">
        <span class="navigation__header-icon-wrapper"><img src="assets/img/logo.svg"
            class="svgInject navigation__header-icon" alt="logo"></span>
        <span class="navigation__header-label">FxTrado</span>
      </a>
    </div>
    <div class="navigation__list">
      <ul>
        <li class="navigation__item">
          <a href="{{ route('dashboard') }}" class="navigation__item-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/dash.svg"
                class="svgInject navigation__item-icon" alt="svg">
            </span>
            <span class="navigation__item-label">Dashboard</span>
          </a>
        </li>
        <li class="navigation__item">
          <a href="{{ route('forex_pair') }}" class="navigation__item-link {{ request()->is('forex_pair') ? 'active' : '' }}">
            <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/dash.svg"
                class="svgInject navigation__item-icon" alt="svg">
            </span>
            <span class="navigation__item-label">Exchange</span>
          </a>
        </li>
        <li class="navigation__item">
          <a href="{{ route('orders') }}" class="navigation__item-link {{ request()->is('orders') ? 'active' : '' }}">
            <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/history.svg"
                class="svgInject navigation__item-icon" alt="svg">
            </span>
            <span class="navigation__item-label">Order History</span>
          </a>
        </li>
        <li class="navigation__item">
          <a href="{{ route('wallet') }}" class="navigation__item-link {{ request()->is('wallet') ? 'active' : '' }}">
            <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/wallet.svg"
                class="svgInject navigation__item-icon" alt="svg">
            </span>
            <span class="navigation__item-label">Wallets</span>
          </a>
        </li>
        <li class="navigation__item">
          <a href="{{ route('profile') }}" class="navigation__item-link {{ request()->is('profile') ? 'active' : '' }}">
            <span class="navigation__item-icon-wrapper"><img src="assets/img/svg-icon/user.svg"
                class="svgInject navigation__item-icon" alt="svg">
            </span>
            <span class="navigation__item-label">Profile</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>