<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
            featured content or information.</p>
        <hr class="my-4">
    </div>

    <?php foreach ($data as $key): ?>
        <a class="link" href="/posts/<?= $key['id'] ?>/show"><?= $key['title'] ?></a>
        <p class="media-text"><?= $key['text'] ?></p>
    <?php endforeach; ?>
</div>
