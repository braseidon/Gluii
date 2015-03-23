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
		<!-- checkbox -->
		<td class="text-center">
			<label class="i-checks m-b-none">
				<input type="checkbox" name="post[]"><i></i>
			</label>
		</td>
		<!-- ID -->
		<td>{{ $user->id }}</td>
		<!-- name -->
		<td>
			<div class="pull-left thumb-xs">
				{!! $user->present()->photoThumb('thumb-sm', ) !!}
			</div>
			<a href="{{ route('admin/users/edit', $user->id) }}" class="text-md m-l m-t-xs inline">
				{{ $user->present()->name }}
			</a>
		</td>
		<td>{{ $user->email }}</td>
		<td class="text-center">
			@if(! $user->friendcount->isEmpty())
				{{ $user->friendcount->first()->friend_count }}
			@else
				0
			@endif
		</td>
		<td class="actions text-right">
			@include('admin.users.partials.actions')
		</td>
	</tr>
	@endforeach
</tbody>