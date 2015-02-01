<div class="well bg-white well-sm no-margin no-padding">
	<div class="row">
		<div class="col-sm-12">
			<!-- Cover Photos -->
			<div class="carousel slide profile-carousel" id="myCarousel">
				<div class="air air-top-left wrapper-sm">
					<h4 class="text-white text-md">Jan 1, 2014</h4>
				</div>
				<ol class="carousel-indicators">
					<li class="active" data-slide-to="0" data-target="#myCarousel"></li>
					<li class="" data-slide-to="1" data-target="#myCarousel"></li>
					<li class="" data-slide-to="2" data-target="#myCarousel"></li>
				</ol>
				<div class="carousel-inner">
					<!-- Slide 1 -->
					<div class="item active"><img alt="" src="/images/demo/s1.jpg"></div>
					<!-- Slide 2 -->
					<div class="item"><img alt="" src="/images/demo/s2.jpg"></div>
					<!-- Slide 3 -->
					<div class="item"><img alt="" src="/images/demo/m3.jpg"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="row">
				<!-- Profile Picture + Profile Stats -->
				<div class="col-sm-3 profile-pic">
					<img src="{{ $user->present()->getGravatar(100) }}" width="100" height="100" alt="{{ $user->username }}" />
					<div class="wrapper-sm m-t-sm">

						<!-- Followers -->
						<h4 class="text-lg text-dark-lter m-t-none m-b">
							<strong class="block">{{ $user->present()->followersCount }}</strong>
							<small>Followers</small>
						</h4>

						<!-- Following -->
						<h4 class="text-lg text-dark-lter m-t-none m-b">
							<strong class="block">{{ $user->present()->followingCount }}</strong>
							<small>Following</small>
						</h4>

						@include('backend.profile.partials.follows')
					</div>
				</div>
				<div class="col-sm-6">
					<!-- Username + Job -->
					<h3>
						{{ $user->first_name }} <span class="font-bold">{{ $user->last_name }}</span><br />
						<small>{{ $user->country }}</small>
					</h3>

					<!-- Contact Info -->
					<ul class="list-unstyled m-b-lg">
						<li class="text-muted m-b-xs">
							<i class="fa fa-fw fa-phone"></i>
							{{ $user->getContactInfo('phone_number') }}
						</li>
						<li class="text-muted m-b-xs">
							<i class="fa fa-fw fa-envelope"></i>
							<a href="mailto:{{ $user->getContactInfo('contact_email') }}">{{ $user->getContactInfo('contact_email') }}</a>
						</li>
						<li class="text-muted m-b-xs">
							<i class="fa fa-fw fa-skype"></i>
							<span class="text-white-darken">{{ $user->getContactInfo('skype') }}</span>
						</li>
					</ul>

					<!-- About Me -->
					<p class="text-md text-muted">ABOUT ME</p>
					<p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere</p><br />

					<!-- Interact With User -->
					<a class="btn btn-default btn-xs" href="javascript:void(0);">
						<i class="fa fa-envelope-o"></i>
						Send Message
					</a>
				</div>
				<div class="col-sm-3">
					<!-- Followers -->
					@include('backend.profile.partials.followers')

					<!-- Following -->
					@include('backend.profile.partials.following')
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<hr>
			<div class="wrapper-sm">
				<section class="panel panel-default">
					<header class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active">
								<a data-toggle="tab" href="#profile-recentarticles">
									<i class="fa fa-copy"></i>
									Recent Articles
								</a>
							</li>
							<li class="">
								<a data-toggle="tab" href="#profile-newmembers">
									<i class="fa fa-users"></i>
									New Members
								</a>
							</li>
							<li class="pull-right">
								<a href="javascript:void(0);"><span class="m-t-sm display-inline"><i class="fa fa-rss text-success"></i> Activity</span></a>
							</li>
						</ul>
					</header>
					<div class="panel-body">
						<div class="tab-content m-t-sm">
							<div class="tab-pane fade active in" id="profile-recentarticles">
								@include('backend.profile.partials.recent-articles')
							</div>
							<div class="tab-pane fade" id="profile-newmembers">
								@include('backend.profile.partials.recent-members')
							</div><!-- end tab -->
						</div>
					</div>
				</section>
			</div>
		</div>
	</div><!-- end row -->
</div>