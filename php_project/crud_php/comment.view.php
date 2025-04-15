<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Partials/head.php'; ?>

    <title>Comments</title>
</head>

<body class='background'>
    <?php require 'Partials/nav.php'; ?>

    <div class="">
        <h2>Comments</h2>
        <?php if (!empty($comments)) : ?>
            <ul class="list-group">
                <?php foreach ($comments as $comment) : ?>
                    <li class="list-group-item">
                        <strong>
                            <p><?= htmlspecialchars($comment['comment']) ?></p>
                        </strong>

                        <small>
                            Posted by
                            <strong><?= htmlspecialchars($comment['name']) ?> </strong>
                            <br>
                            at <?= htmlspecialchars($comment['created_at']) ?>

                            <?php if ($userId === $comment['user_id']) : ?>
                                <div class="edit_form">
                                    <form method="POST" action="comment.php?post_id=<?= $postId ?>" class="commet-form">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <textarea name="new_comment"><?= htmlspecialchars($comment['comment']) ?></textarea>
                                        <button type="submit" name="edit_comment" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit">Save Edit</i>
                                        </button>
                                    </form>

                                    <form method="POST" action="comment.php?post_id=<?= $postId ?>" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" name="delete_comment" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?');">
                                            <i class="fa fa-trash">Delete</i>
                                        </button>
                                    </form>

                                </div>
                            <?php endif; ?>
                        </small>
                        <a href="/posts" class="btn btn-default mt-3">
                            <i class="fa fa-arrow-left"> Back to Posts</i>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No comments found.</p>
            <a href="/posts" class="btn btn-default mt-3">
                <i class="fa fa-arrow-left"> Back to Posts</i>
            </a>
        <?php endif; ?>

    </div>


</body>

</html>