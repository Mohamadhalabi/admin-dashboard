@if(permission_can('show reviews' ,'admin') )
    <div
            class="menu-item  @if(request()->routeIs('backend.reviews.*')  ) show @endif ">
									<span class="menu-link">
										<span class="menu-icon">
                             <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen004.svg-->
<span class="svg-icon svg-icon-muted "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor"/>
<path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor"/>
</svg></span>
                                            <!--end::Svg Icon-->
                     					</span>
                                            <a class="menu-title"
                                               href="{{route('backend.reviews.index')}}">
                                                <span class="menu-title">{{trans('backend.menu.reviews')}}</span>
                                            </a>

									</span>

    </div>
@endif
