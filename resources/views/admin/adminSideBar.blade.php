<div id="menu">
    <h3>{{trans('app.adminMenuTitle')}}</h3>
    <div>
        <a href="{{ url('/admin/pages/')}}">{{trans('app.adminMenuPages')}}</a><br/>
        <a href="{{ url('/admin/categories/')}}">{{trans('app.adminMenuCategories')}}</a><br/>
        <a href="{{ url('/admin/---/')}}">{{trans('app.adminMenuResources')}}</a><br/>
        <a href="{{ url('/admin/---/')}}">{{trans('app.adminMenuOrders')}}</a><br/>

        <a href="{{ url('/admin/languages/')}}">{{trans('app.adminMenuLanguages')}}</a><br/>

        <a href="{{ url('/admin/users/')}}">{{trans('app.adminMenuUsers')}}</a><br/>
        <a href="{{ url('/admin/menus/')}}">{{trans('app.adminMenuMenus')}}</a><br/>
    </div>
</div>
