<div id="top-bar">

	<div class="container clearfix">
		<div class="col_half nobottommargin clearfix">

			<div class="top-links">
				{{-- {!! $menu_top->asUl() !!} --}}
				<ul>
 				 
 
                    @if (Sentinel::guest())
                    <li>
                        <a href="">Login / Register</a>
                        <div class="top-link-section">
                            <form id="top-login" role="form" action="{{ url('admin/login') }}">
                                @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @endif
                                <div class="input-group" id="top-login-username">
                                    <span class="input-group-addon"> <i class="icon-user"></i></span>
                                    <input type="email" class="form-control" placeholder="Email address" required=""></div>
                                <div class="input-group" id="top-login-password">
                                    <span class="input-group-addon"> <i class="icon-key"></i></span>
                                    <input type="password" class="form-control" placeholder="Password" required=""></div>
                                <label class="checkbox">
                                    <input type="checkbox" value="remember-me">Remember me</label>
                                <button class="btn btn-danger btn-block" type="submit">Sign in</button>
                            </form>
                        </div>
                    </li>
                        @else
                        <li> <a href="{{ url('/') }}/logout">Logout</a> </li>
                        @if(Sentinel::getUser()->hasAccess('admin'))

                            <li> <a href="{!! url('/') !!}/admin">ADMIN</a> </li>

                        @endif
                    @endif











					{{-- <li> <a href="{{ url('/' . getLang(). '/faqs/') }}">FAQs</a> </li> --}}
					{{-- <li> <a href="{{ url('/' . getLang(). '/contact/') }}">Contact</a> </li> --}}
			 

				</ul>
			</div>
			<!-- .top-links end -->
		</div>
		<div class="col_half fright col_last clearfix nobottommargin">

			<div id="top-social">
				<ul>
					<li> <a href="#" class="si-facebook"> <span class="ts-icon"> <i class="icon-facebook"></i> </span> <span class="ts-text">Facebook</span> </a> </li>
					<li> <a href="#" class="si-twitter"> <span class="ts-icon"> <i class="icon-twitter"></i> </span> <span class="ts-text">Twitter</span> </a> </li>
					<li> <a href="#" class="si-dribbble"> <span class="ts-icon"> <i class="icon-dribbble"></i> </span> <span class="ts-text">Dribbble</span> </a> </li>
					<li> <a href="#" class="si-github"> <span class="ts-icon"> <i class="icon-github-circled"></i> </span> <span class="ts-text">Github</span> </a> </li>
					<li> <a href="#" class="si-pinterest"> <span class="ts-icon"> <i class="icon-pinterest"></i> </span> <span class="ts-text">Pinterest</span> </a> </li>
					<li> <a href="#" class="si-instagram"> <span class="ts-icon"> <i class="icon-instagram2"></i> </span> <span class="ts-text">Instagram</span> </a> </li>
					<li> <a href="tel: " class="si-call"> <span class="ts-icon"> <i class="icon-call"></i> </span> <span class="ts-text">+1 (800) 555-5555</span> </a> </li>
					<li> <a href="mailto: " class="si-email3"> <span class="ts-icon"> <i class="icon-envelope-alt"></i> </span> 
          <span class="ts-text">contact@web.com</span> </a> </li>
				</ul>
			</div>
			<!-- #top-social end -->
		</div>
	</div>
</div>
<!-- #top-bar end -->
