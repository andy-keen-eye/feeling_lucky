<div class="container">
<form action="/submit_edit" method="post">
    <input type="hidden" name="user_id" value=<?= $values['id'] ?>>

    <label class="col-sm-2">Username</label>
    <input name="username" type="text" value="<?= $values['username'] ?>">
    <br/>
    <label class="col-sm-2">Phone number</label>
    <input name="phone_number" type="text" value="<?= $values['phone_number'] ?>">
    <br/>
    <label class="col-sm-2">Link ID</label>
    <input name="edit_link" type="text" value="<?= $values['link'] ?>">
    <br/>
    <button type="submit" class="btn btn-success">Save</button>
</form>
</div>
