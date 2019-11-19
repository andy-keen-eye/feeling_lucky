<div class="container">
</div>
<div class="container-fluid">

    <p><a href="/" class="btn btn-primary" role="button">Create new user</a></p>
    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Username</th>
                <th>Phone number</th>
                <th>Link</th>
                <th>Expire date</th>
                <th>Edit Button</th>
                <th>Delete Button</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($values as $user): ?>
            <tr>
                <td><?= $user["username"] ?></td>
                <td><?= $user["phone_number"] ?></td>
                <td><?= $user["link"] ?></td>
                <td><?= $user["expire_date"] ?></td>
                <td><a href="/edit?userId=
                    <?= $user["id"] ?>
                    " class="btn btn-success edit-user" role="button">Edit this user</a></td>
                <td><button type="button" class="btn btn-danger delete-user" id="delete-user-<?= $user["id"] ?>">Delete this user</button></td>
            </tr>

        <?php endforeach ?>

        <tbody>
    </table>
</div>