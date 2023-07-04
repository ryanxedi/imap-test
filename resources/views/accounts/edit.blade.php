<x-app>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update {{ $account->label }}</h6>
            </div>
            <div class="card-body">
            	<form action="/accounts/{{ $account->id }}" method="post">
            		@csrf
            		@method('patch')
	            	<div class="row mb-4">
	            		<div class="col-md-4">
	            			<h5>Account label</h5> 
	            			<input class="form-control" name="label" value="{{ $account->label }}">
	            		</div>
	            	</div>
	            	<div class="row mb-3">
		            	<div class="col-md-6">
		            		<h5 class="mb-3">Incoming Server</h5> 
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				IMAP Server 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_server" value="{{ $account->incoming_server }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Username 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_username" value="{{ $account->incoming_username }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Password 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_password" value="{{ $account->incoming_password }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Port 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_port" value="{{ $account->incoming_port }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Security 
		            			</div>
				            	<div class="col-md-6">
				            		<select class="form-select" name="incoming_security">
				            			<option value="none" @if ($account->incoming_security == 'none') selected @endif>None</option>
				            			<option value="ssl"@if ($account->incoming_security == 'ssl') selected @endif>SSL/TLS</option>
				            			<option value="start_tls"@if ($account->incoming_security == 'start_tls') selected @endif>STARTTLS</option>
				            		</select>
				            	</div>
				            </div>
		                </div>
		            	<div class="col-md-6">
		                	<h5 class="mb-3">Outgoing Server</h5> 
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				IMAP Server 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_server" value="{{ $account->outgoing_server }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Username 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_username" value="{{ $account->outgoing_username }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Password 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_password" value="{{ $account->outgoing_password }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Port 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_port" value="{{ $account->outgoing_port }}">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Security 
		            			</div>
				            	<div class="col-md-6">
				            		<select class="form-select" name="outgoing_security">
				            			<option value="none" @if ($account->outgoing_security == 'none') selected @endif>None</option>
				            			<option value="ssl" @if ($account->outgoing_security == 'none') selected @endif>SSL/TLS</option>
				            			<option value="start_tls" @if ($account->outgoing_security == 'none') selected @endif>STARTTLS</option>
				            		</select>
				            	</div>
				            </div>
		                </div>
		            </div>
		            <div class="row">
		            	<div class="col-12">
			            	<button class="btn btn-primary float-right">
			            		Update
			            	</button>
			            </div>
		            </div>
		        </form>
            </div>
        </div>
    </div>
</x-app>