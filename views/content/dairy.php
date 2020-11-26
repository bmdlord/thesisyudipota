<h4 class="page-title">Daily Dairy</h4>

<?php if(@get('status') == 'success'): ?>
<div class="alert alert-success">Successfully posted.</div>
<?php elseif(@get('status') == 'deleted'): ?>
<div class="alert alert-success">Successfully remove posted.</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <?php if(get_session('level') == 2): ?>
        <button class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#new_journal"><i class="fa fa-plus"></i> New Journal</button>
        <?php endif; ?>
        <hr>
        <?php if(sizeof(data()) > 0): ?>
            <?php foreach(data() as $key): ?>
            <div class="col-md-12">
                <div class="blog-view">
                    <article class="blog blog-single-post">
                        <h3 class="blog-title"><?= ucwords($key['title']); ?></h3>
                        <h5>Mood Status: <?= ucwords($key['mood']); ?></h5>
                        <div class="blog-info clearfix">
                            <div class="post-left">
                                <ul>
                                    <li><i class="fa fa-calendar"></i> <span><?= $key['date']; ?></span></li>
                                    <li><i class="fa fa-user-o"></i> <span>By <?= ucwords(get_session('userfullname')); ?></span></li>
                                </ul>
                            </div>
                            <div class="post-right"><a href="<?= URL; ?>dairy/remove?id=<?= $key['id']; ?>" onclick="return confirm('Are you sure to remove this?');"><i class="fa fa-trash"></i>Remove</a></div>
                        </div>
                        <div class="blog-content">
                            <?= $key['journal']; ?>
                        </div>
                    </article>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
        <h3>No dairy posted yet.</h3>
        <?php endif; ?>
    </div>
</div>

<div id="new_journal" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-justify">
                <form action="<?= URL; ?>dairy/post" method="post">
                    <div class="form-group">
                        <label for="title"><strong>Journal Title</strong></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <h3>What is your mood today?</h3>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <label>
                                    <input type="radio" name="mood" value="happy" checked>
                                    <i class="fa fa-smile-o"></i>
                                </label>
                            </li>
                            <li class="list-inline-item">
                                <label>
                                    <input type="radio" name="mood" value="sad">
                                    <i class="fa fa-frown-o"></i>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="journal"><strong>Tell me more by creating your journal.</strong></label>
                        <textarea name="journal" id="journal" cols="30" rows="10" placeholder="Write your dairy ..." class="form-control" style="resize: none;" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-md btn-primary float-right text-white">Save</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
