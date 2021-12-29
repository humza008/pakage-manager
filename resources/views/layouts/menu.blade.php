<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Pakages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{route('pakage_list')}}" class="nav-link {{ request()->is('pakage_list') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pakages_list</p>
                </a>
              </li>
{{--              <li class="nav-item">--}}
{{--                <a href="{{route('transaction_history')}}" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Purcahsed_pakages</p>--}}
{{--                </a>--}}
{{--              </li>--}}
            </ul>
          </li>

<li class="nav-item">
    <a href="{{ route('conncetion_list') }}" class="nav-link {{ request()->is('conncetion_list') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wifi"></i>
        <p>Connections</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('customer_list') }}" class="nav-link ">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>Customers</p>
    </a>
</li>

