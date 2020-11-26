<h4 class="page-title">Question</h4>

<div class="row">
    <div class="col-md-12">
        <a href="<?= URL; ?>question/create" class="btn btn-md btn-primary"><i class="fa fa-plus"></i> Create Questioner</a>
        <hr>
        <table class="table table-border table-striped custom-table datatable mb-0">
            <thead>
                <tr>
                    <th>Questioner</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach(data() as $key): ?>
                <tr>
                    <td><a href="<?= URL; ?>question/viewquestion?title=<?= $key['title']; ?>"><?= ucwords($key['title']); ?></a></td>
                    <td><a href="<?= URL; ?>question/assignpatient?question=<?= $key['title']; ?>" class="btn btn-primary"><i class="fa fa-users"></i> Assign Patient</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
