<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ (!is_null(Auth::guard('admin')->user()->adminInfo->image)) ? asset(Auth::guard('admin')->user()->adminInfo->image) : 'https://st2.depositphotos.com/1006318/5909/v/950/depositphotos_59095529-stock-illustration-profile-icon-male-avatar.jpg' }}" alt="User Image" width="80" height="80">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::guard('admin')->user()->name }}</p>
          <p class="app-sidebar__user-designation">@if (Auth::guard('admin')->user()->isAdmin == 1) {{ "Super Admin"}} @else {{ "Normal Admin"}} @endif</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item @if (Route::currentRouteName() == 'admin.category.list' || Route::currentRouteName() == 'admin.category.add' || Route::currentRouteName() == 'admin.category.update') {{ 'active' }} @endif" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label">Categories</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ route('admin.category.list') }}"><i class="icon fa fa-circle-o"></i> Category Lists</a></li>
            <li><a class="treeview-item" href="{{ route('admin.category.add') }}" rel="noopener"><i class="icon fa fa-circle-o"></i> Category Add</a></li>
          </ul>
        </li>
		<li><a class="app-menu__item @if (Route::currentRouteName() == 'admin.comment.list' || Route::currentRouteName() == 'admin.comment.add' || Route::currentRouteName() == 'admin.comment.update' || Route::currentRouteName() == 'admin.reply.add') {{ 'active' }} @endif" href="{{ route('admin.comment.list') }}"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Comments</span></a>
        </li>
        <li class="treeview"><a class="app-menu__item @if (Route::currentRouteName() == 'admin.product.list' || Route::currentRouteName() == 'admin.product.add' || Route::currentRouteName() == 'admin.product.update') {{ 'active' }} @endif" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-product-hunt"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ route('admin.product.list') }}"><i class="icon fa fa-circle-o"></i> Product Lists</a></li>
            <li><a class="treeview-item" href="{{ route('admin.product.add') }}" rel="noopener"><i class="icon fa fa-circle-o"></i> Product Add</a></li>
          </ul>
        </li>
		<li><a class="app-menu__item @if (Route::currentRouteName() == 'admin.order.list' || Route::currentRouteName() == 'admin.order.update') {{ 'active' }} @endif" href="{{ route('admin.order.list') }}"><i class="app-menu__icon fa fa-first-order"></i><span class="app-menu__label">Orders</span></a></li>
         <li><a class="app-menu__item @if (Route::currentRouteName() == 'admin.payment.list' || Route::currentRouteName() == 'admin.payment.update') {{ 'active' }} @endif" href="{{ route('admin.payment.list') }}"><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Payments</span></a></li>
		@can ('isAdmin')
        <li class="treeview"><a class="app-menu__item @if (Route::currentRouteName() == 'admin.admin.list' || Route::currentRouteName() == 'admin.admin.add' || Route::currentRouteName() == 'admin.admin.update') {{ 'active' }} @endif" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Admins</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ route('admin.admin.list') }}"><i class="icon fa fa-circle-o"></i> Admin Lists</a></li>
            <li><a class="treeview-item" href="{{ route('admin.admin.add') }}"><i class="icon fa fa-circle-o"></i> Admin Add</a></li>
          </ul>
        </li>
		@endcan
        <li class="treeview"><a class="app-menu__item @if (Route::currentRouteName() == 'admin.user.list' || Route::currentRouteName() == 'admin.user.add' || Route::currentRouteName() == 'admin.user.update') {{ 'active' }} @endif" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Users</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ route('admin.user.list') }}"><i class="icon fa fa-circle-o"></i> User Lists</a></li>
            <li><a class="treeview-item" href="{{ route('admin.user.add') }}"><i class="icon fa fa-circle-o"></i> User Add</a></li>
          </ul>
        </li>
      </ul>
    </aside>