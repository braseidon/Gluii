<thead>
	<th width="40" class="text-center">
		<label class="i-checks m-b-none">
			<input type="checkbox"><i></i>
		</label>
	</th>
	<th width="60">ID</th>
	<th class="col-lg-4">Name</th>
	<th>Email</th>
	<th width="80" class="text-center">Friends</th>
	<th class="col-lg-2"></th>
</thead>
<tbody>
	@foreach ($users as $user)
	<tr>
		{{-- Checkbox --}}
		<td class="text-center">
			<label class="i-checks m-b-none">
				<input type="checkbox" name="post[]"><i></i>
			</label>
		</td>
		{{-- ID --}}
		<td>{{ $user->id }}</td>
		{{-- User's Name & Role --}}
		<td>
			<div class="pull-left thumb-sm inline">
				{!! $user->present()->photoThumb('thumb-sm') !!}
			</div>
			<div class="m-l inline">
				<a href="{{ route('admin/users/edit', $user->id) }}" class="block">
					{{ $user->present()->name }}
				</a>
				@if($user->hasAccess('admin'))
					<span class="text-primary">
						Admin
					</span>
				@endif
			</div>
		</td>
		{{-- Email Address --}}
		<td>{{ $user->email }}</td>
		{{-- Friend Count --}}
		<td class="text-center">
			@if(! $user->friendcount->isEmpty())
				{{ $user->friendcount->first()->friend_count }}
			@else
				0
			@endif
		</td>
		{{-- Actions --}}
		<td class="actions text-right">
			@include('admin.users.partials.actions')
		</td>
	</tr>
	@endforeach
</tbody>