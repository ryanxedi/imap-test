<x-app>
	<div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            	<div class="row">
            		<div class="col-6">
                		<h6 class="m-0 font-weight-bold text-primary pt-2">Email Accounts</h6>
                	</div>
                	<div class="col-6 text-right">
                		<a href="/accounts/create">
			                <button class="btn btn-primary btn-sm">
			                	Add new account
			                </button>
			            </a>
			        </div>
			    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Incoming server</th>
                                <th>Incoming username</th>
                                <th>Outgoing server</th>
                                <th>Outgoing username</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($accounts as $account)
	                            <tr>
	                                <td>{{ $account->label }}</td>
	                                <td>{{ $account->incoming_server }}</td>
	                                <td>{{ $account->incoming_username }}</td>
	                                <td>{{ $account->outgoing_server }}</td>
	                                <td>{{ $account->outgoing_username }}</td>
	                                <td>
	                                	<div class="row">
	                                		<div class="col-4">
	                                			<livewire:test-connection :account_id="$account->id">
	                                		</div>
	                                		<div class="col-4">
	                                			<a href="/accounts/{{ $account->id }}/edit">
		                                			<button class="btn btn-warning">
		                                				<i class="fa fa-edit"></i> Edit
		                                			</button>
		                                		</a>
	                                		</div>
	                                		<div class="col-4">
	                                			<form action="/accounts/{{ $account->id }}" method="post">
	                                				@csrf
	                                				@method('delete')
		                                			<button class="btn btn-link">
		                                				<i class="fa fa-times text-danger"></i>
		                                			</button>
		                                		</form>
	                                		</div>
	                                	</div>
	                                </td>
	                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</x-app>