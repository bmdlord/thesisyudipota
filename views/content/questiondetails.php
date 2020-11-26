<h4 class="page-title">Questions (<?= ucwords(get('title')); ?>)</h4>

<div class="row">
    <div class="col-md-12">
        <?php if(sizeof(data()) > 0): ?>
            <?php foreach(data() as $key): ?>
            <div class="col-md-12">
                <div class="blog-view">
                    <article class="blog blog-single-post">
                        <h3 class="blog-title"><?= ucwords($key['question']); ?></h3>
                        <div class="blog-content">
                            <table>
                                <tr>
                                    <td><strong>A.</strong></td>
                                    <td><?= $key['a']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>B.</strong></td>
                                    <td><?= $key['b']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>C.</strong></td>
                                    <td><?= $key['c']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>D.</strong></td>
                                    <td><?= $key['d']; ?></td>
                                </tr>
                            </table>
                            <hr>
                            <p><strong>[ANSWER]: <?= strtoupper($key['answer']); ?></strong></p>
                        </div>
                    </article>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>