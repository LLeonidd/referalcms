<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-user"></i>
      {{ Auth::user()->name }}
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <div class="dropdown-divider"></div>
    <form method="POST" action="{{ route('logout') }}"  class="dropdown-item">
          @csrf
          <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
              <i class="fa fa-sign-out-alt mr-2"></i>{{ __('Log Out') }}
          </x-dropdown-link>
      </form>
  </div>
</li>
