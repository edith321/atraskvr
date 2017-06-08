<div id="menu">
    <h3>{{trans('app.adminMenuTitle')}}</h3>
    <div>
        <a href="{{ url('/admin/pages/')}}">Pages</a><br/>
        <a href="{{ url('/admin/categories/')}}">Categories</a><br/>
        <a href="{{ url('/admin/upload/')}}">Resources</a><br/>
        <a href="{{ url('/admin/orders/')}}">Orders</a><br/>
        <a href="{{ url('/admin/users/')}}">Users</a><br/>
        <a href="{{ url('/admin/languages/')}}">{{trans('app.adminMenuLanguages')}}</a><br/>
        <a href="{{ url('/admin/menus/')}}">Menus</a><br/>
    </div>
</div>
