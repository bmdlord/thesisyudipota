<h4 class="page-title">Question</h4>

<div class="row">
    <div class="col-md-12">
       <?php if(@get('status') == 'done'): ?>
         <div class="alert alert-success">Thank you. see your score from your evaluation.</div>
       <?php endif; ?>
        <table class="table table-border table-striped custom-table datatable mb-0">
            <thead>
                <tr>
                    <th>Evaluation Title</th>
                    <th>No. of Question</th>
                    <th>Score</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(data() as $key): ?>
                <tr>
                    <td><?= ucwords($key['task']); ?></td>
                    <td><?= $key['total']; ?></td>
                    <td><?= $key['score']; ?></td>
                    <td>
                      <?php if($key['status'] == 'not validate'): ?>
                        <a href="<?= URL; ?>question/takequiz?question=<?= $key['task']; ?>&id=<?= $key['id']; ?>" class="btn btn-primary">Take</a>
                      <?php else: ?>
                        <span class="btn btn-default">Already Taken</span>
                      <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
