<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a href="Posts.php" class="btn btn-default mt-3">
                            <i class="fa fa-arrow-left"> Back to Posts</i>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No comments found.</p>
        <?php endif; ?>

    </div>
</body>

</html>