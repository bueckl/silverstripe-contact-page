<form $FormAttributes role="form" novalidate>
	<% if Message %>
	<div class="alert alert-danger">
		<p id="{$FormName}_error" class="message $MessageType">$Message.RAW</p>
	</div>
	<% else %>
		<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
	<% end_if %>

	<fieldset>

		<% with $FieldMap %>

		<div class="row">
			<div class="col-md-12">
				$Name.FieldHolder
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				$Email.FieldHolder
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				$Message.FieldHolder
			</div>
		</div>

		<% end_with %>
		
		$Fields.dataFieldByName(SecurityID)

	</fieldset>
	
	<% if Actions %>
	<div class="Actions row">
		<div class="col-md-12">
			<% loop Actions %>$Field<% end_loop %>
		</div>
	</div>
	<% end_if %>

</form>
