@if(! $user->isMe())
	<div class="friend-buttons">
		{{-- are friends --}}
		@if($user->friendshipWith(Auth::getUser()->id))
			<div class="btn-group">
				{{-- Accepted Request--}}
				@if($user->friendshipWith(Auth::getUser()->id) == 'accepted')
					<div class="dropdown">
						<button type="button" class="dropdown-toggle clear btn btn-primary btn-addon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon icon-user-following"></i> Friends <b class="caret"></b>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Invite to Event</a></li>
							<li><a href="#">Invite to Family</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('user/request/cancel', ['toId' => $user->id]) }}">Remove Friend</a></li>
						</ul>
					</div>
				{{-- Sent Request--}}
				@elseif($user->friendshipWith(Auth::getUser()->id) == 'sent')
					<div class="dropdown">
						<button type="button" class="dropdown-toggle clear btn btn-primary btn-addon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon icon-user-following"></i> Friend Request Sent <b class="caret"></b>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('user/request/cancel', ['toId' => $user->id]) }}">Cancel Friend Request</a></li>
						</ul>
					</div>
				{{-- Pending Request--}}
				@elseif($user->friendshipWith(Auth::getUser()->id) == 'pending')
					<div class="dropdown">
						<button type="button" class="dropdown-toggle clear btn btn-primary btn-addon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon icon-user-following"></i> Respond to Friend Request <b class="caret"></b>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('user/request/accept', ['fromId' => $user->id]) }}">Accept Friend Request</a></li>
							<li><a href="{{ route('user/request/deny', ['fromId' => $user->id]) }}">Deny Friend Request</a></li>
						</ul>
					</div>
				@endif
			</div>
			{{-- Chat --}}
			<button type="button" class="btn btn-default m-l-xs disabled">
				<i class="icon icon-bubble"></i>
			</button>

		{{-- is NOT friends --}}
		@else
			<form action="{{ route('user/request/add') }}" method="POST">
				<input type="hidden" name="toId" value="{{ $user->id }}">
				<button type="submit" class="btn btn-primary btn-addon">
					<i class="icon icon-user-follow"></i> Send Friend Request
				</button>
				<!-- CSRF -->
				{!! Form::token() !!}
			</form>
		@endif
	</div>
@endif