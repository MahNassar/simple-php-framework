<?php

include(VIEWS . "/header.php");

$model = isset($data['model']) ? $data['model'] : null;
?>

<div class="container">

    <h2><?= $model ? 'Update' : 'Create' ?> new article</h2>

    <form method="POST">
        <div class="form-group">
            <label for="title" class="control-label">
                title <span class="required">(required)</span>
            </label>
            <input type="text" class="form-control" name="title" value="<?= $model ? $model['title'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="url" class="control-label">
                url <span class="required">(required)</span>
            </label>
            <input type="text" class="form-control" name="url" value="<?= $model ? $model['url'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="content" class="control-label">
                text <span class="required">(required)</span>
            </label>
            <textarea class="form-control" name="content" cols="100" rows="15" required><?= $model ? $model['content'] : '' ?></textarea>
        </div>
        <input type="submit" type="button" class="btn btn-success">
    </form>

</div>

<?php include(VIEWS . "/footer.php");?>