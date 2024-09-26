<script>
    const menus9List = document.querySelectorAll('.menus-1');
        if (menus1List) {
        menus9List.forEach(e => {
            new Menu(e);
        });
        const menus9List = document.querySelectorAll('.menus-1');
        if (menus9List) {
        menus9List.forEach(e => {
            new Menu(e);
        });
    }
}
</script>
<div class="menu menu-vertical  py-4 overflow-hidden" id="menu-1" style="height: 650px">
<div class="menu-block my-2 d-flex align-items-center">
    <div class="avatar avatar-lg avatar-online me-2"><img alt="Avatar" class="rounded-circle shadow" src="assets/img/avatars/7.png"></div>
    <h5 class="menu-text mt-4 mb-1">{{ Auth::user()->name }}</h5>
    <div class="small">
      <a class="menu-link" href="javascript:void(0)">ABC Company, CEO</a>
    </div>
  </div>
  <div class="menu-divider mt-0"></div>
    <ul class="menu-inner">
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
