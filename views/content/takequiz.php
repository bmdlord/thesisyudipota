<h4 class="page-title">Question: <?= ucwords(get('question')); ?></h4>

<div class="row">
    <div class="col-md-12">
        <form action="<?= URL; ?>question/donequiz?title=<?= get('question'); ?>&id=<?= get('id'); ?>" method="post">
          <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-check"></i> Done Quiz</button>
          <hr>
          <?php foreach(data() as $key): ?>
            <input type="hidden" value="<?= $key['answer']; ?>" name="answer[]" />
          <?php endforeach; ?>
          <table class="table table-border table-striped custom-table datatable mb-0">
              <thead>
                  <tr>
                      <th>Question</th>
                      <th>A</th>
                      <th>B</th>

                      <th>Answer</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach(data() as $key): ?>
                  <tr>
                      <td style="width: 500px;"><?= ucwords($key['question']); ?></td>
                      <td style="width: 50px;"><?= $key['a']; ?></td>
                      <td style="width: 50px;"><?= $key['b']; ?></td>

                      <td style="width: 350px;">
                        <input type="text" name="user_answer[]" class="form-control col-lg-4" required />
                      </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
        </form>
    </div>
</div>