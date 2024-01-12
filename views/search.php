
<?php foreach ( $wikies as $wiki) {
    if ($wiki['statut'] === 0) { ?>
        <div class="container wiki-container">
            <div class="row">
                <div class="col-lg-5">
                    <img class="img-fluid wiki-image" src="/wiki/public/imgs/<?= $wiki['image'] ?>" alt="Wiki Image">
                </div>
                <div class="col-lg-7">
                    <div class="wiki-content">
                        <h1 class="wiki-title"><?= $wiki['title'] ?></h1>
                        <ul class="wiki-details">
                            <li><h6><?= $wiki['name'] ?></h6></li>
                            <li><h6><?= $wiki['username'] ?></h6></li>
                            <li class="date"><?= $wiki['creation_date']; ?></li>
                        </ul>
                        <a href="index?id=<?= $wiki['id'] ?>" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#viewContent<?= $wiki['id'] ?>">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for each wiki -->
    <div class="modal fade" id="viewContent<?= $wiki['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= $wiki['centent'] ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php }} ?>