<x-app>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add a new email account</h6>
            </div>
            <div class="card-body">
            	<form action="/accounts" method="post">
            		@csrf
	            	<div class="row mb-4">
	            		<div class="col-md-4">
	            			<h5>Account label</h5> 
	            			<input class="form-control" name="label">
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
				            		<input class="form-control" name="incoming_server" value="imap.mail.us-east-1.awsapps.com">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Username 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_username">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Password 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_password" type="password">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Port 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="incoming_port" value="993">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Security 
		            			</div>
				            	<div class="col-md-6">
				            		<select class="form-select" name="incoming_security">
				            			<option value="none">None</option>
				            			<option value="ssl" selected>SSL/TLS</option>
				            			<option value="start_tls">STARTTLS</option>
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
				            		<input class="form-control" name="outgoing_server" value="smtp.gmail.com">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Username 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_username" value="accessremote835@gmail.com">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Password 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_password" value="r3m0teacc3ss" type="password">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Port 
		            			</div>
				            	<div class="col-md-6">
				            		<input class="form-control" name="outgoing_port" value="465">
				            	</div>
				            </div>
		                	<div class="row mb-3">
		                		<div class="col-md-6">
		            				Security 
		            			</div>
				            	<div class="col-md-6">
				            		<select class="form-select" name="outgoing_security">
				            			<option value="none">None</option>
				            			<option value="ssl" selected>SSL/TLS</option>
				            			<option value="start_tls">STARTTLS</option>
				            		</select>
				            	</div>
				            </div>
		                </div>
		            </div>
		            <div class="row">
		            	<div class="col-12">
			            	<button class="btn btn-primary float-right">
			            		Add new account
			            	</button>
			            </div>
		            </div>
		        </form>
            </div>
        </div>
    </div>
</x-app>