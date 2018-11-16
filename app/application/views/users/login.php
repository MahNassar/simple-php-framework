<?php

include(VIEWS . "/header.php");
?>

<div class="container">

    <h2>Login</h2>

    <form method="POST">
        <div class="form-group">
            <label for="email" class="control-label">
                Email <span class="required">(required)</span>
            </label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="content" class="control-label">
                Password <span class="required">(required)</span>
            </label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <input type="submit" type="button" class="btn btn-success">
    </form>

</div>

<?php include(VIEWS . "/footer.php");?>