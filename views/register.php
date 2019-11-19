<form action="/" method="post">

<div class="form-group">
<input name="username" type="text" class="form-control" placeholder="Enter a username">
<input name="phone_number" type="text" class="form-control" placeholder="Enter a phone number">
</div>

<?php
if (! empty($values[0])) {
    if ($values[0] == 'error') {
        echo ('<label class="control-label" for="inputError2">
            All fields must be filled
            </label>');
    }
    if ($values[0] == 'invalid') {
        echo ('<label class="control-label" for="inputError2">
            Invalid username and/or phone number
            </label>');
    }
}
?>

<input class="btn btn-primary btn-lg btn-block" type="submit" value="Register">
</form>