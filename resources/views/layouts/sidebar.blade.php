<div class="menu menu-vertical  py-4 overflow-hidden" id="menu-1" style="height: 450px">
  <ul class="menu-inner">
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link">
        <i class="menu-icon ri-file-user-line"></i>

        <h4 class="">
            {{ Auth::user()->name }}
        </h4>

      </a>
    </li>
    <li class="menu-item @if (request()->routeIs('proyectos.index')) active @endif">
      <a href="{{route('leagues.index')}}" class="menu-link ">
        <i class="menu-icon ri-home-smile-line"></i>
        <div>Leagues</div>
      </a>
    </li>
    <li class="menu-item ">
      <a href="{{route('players.index')}}" class="menu-link @if (request()->routeIs('players.index')) active @endif ">
        <i class="menu-icon ri-file-3-line"></i>
        <div>Players</div>
      </a>
    </li>
    <li class="menu-item ">
      <a href="javascript:void(0)" class="menu-link ">
        <i class="menu-icon ri-mail-line"></i>
        <div>Rankigs</div>
      </a>
    </li>

  </ul>
</div>
