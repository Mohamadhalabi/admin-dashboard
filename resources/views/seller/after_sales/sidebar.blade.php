@if(permission_can('show after sales' ,'seller'))
    <div class="menu-item @if(request()->routeIs('seller.after-sale.*')) here show @endif">
        <a class="menu-link" href="{{ route("seller.after-sale.index") }}">
							<span class="menu-icon">
<!--begin::Svg Icon | path: assets/media/icons/duotune/coding/cod002.svg-->
                                <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com003.svg-->
<span class="svg-icon svg-icon-muted  "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"/>
<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"/>
</svg></span>
                                <!--end::Svg Icon-->
                                <!--end::Svg Icon-->
										</span>
            <span class="menu-title">
                    {{ trans('seller.menu.after_sales') }}</span>
        </a>
    </div>
@endif
<?php
