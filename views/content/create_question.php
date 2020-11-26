<h4 class="page-title">Create Question</h4>

<script>
    function createQuestion() {
        const _doc = document;

        let container = _doc.querySelector('#questions');

        let questionGroup = _doc.createElement('div');
        questionGroup.setAttribute('class', 'form-group');

        let labelQuestionTitle = _doc.createElement('label');
        labelQuestionTitle.innerText = 'Question:';
        let labelAnswerTitle = _doc.createElement('label');
        labelAnswerTitle.innerText = 'Answer:';

        let labelOptionA = _doc.createElement('label');
        labelOptionA.innerText = 'A.';

        let labelOptionB = _doc.createElement('label');
        labelOptionB.innerText = 'B.';



        let questionContent = _doc.createElement('input');
        questionContent.setAttribute('type', 'text');
        questionContent.setAttribute('name', 'question[]');
        questionContent.setAttribute('class', 'form-control');
        questionContent.setAttribute('required', true);

        let optionA = _doc.createElement('input');
        optionA.setAttribute('type', 'text');
        optionA.setAttribute('name', 'optionsA[]');
        optionA.setAttribute('class', 'form-control');

        let optionB = _doc.createElement('input');
        optionB.setAttribute('type', 'text');
        optionB.setAttribute('name', 'optionsB[]');
        optionB.setAttribute('class', 'form-control');



        let questionAnswer = _doc.createElement('input');
        questionAnswer.setAttribute('type', 'text');
        questionAnswer.setAttribute('name', 'answer[]');
        questionAnswer.setAttribute('class', 'form-control');
        questionAnswer.setAttribute('required', true);

        let hr = _doc.createElement('hr');

        questionGroup.appendChild(labelQuestionTitle);
        questionGroup.appendChild(questionContent);
        questionGroup.appendChild(labelOptionA);
        questionGroup.appendChild(optionA);
        questionGroup.appendChild(labelOptionB);
        questionGroup.appendChild(optionB);
        questionGroup.appendChild(labelAnswerTitle);
        questionGroup.appendChild(questionAnswer);

        container.appendChild(questionGroup);
        container.appendChild(hr);
    }
</script>

<?php if(@get('status') == 'success'): ?>
<div class="alert alert-success">Questioner successfully created.</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <form action="<?= URL; ?>question/post?seq=create" method="post">
            <input type="hidden" name="userid" value="<?= get_session('userid'); ?>">
            <div class="form-group">
                <label for="title">Questioner Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <button type="button" class="btn btn-md btn-primary" onclick="createQuestion();"><i class="fa fa-plus"></i> Create Question</button>
            <hr>
            <div id="questions"></div>
            <button type="submit" class="btn btn-md btn-primary form-control form-group">Create Question</button>
        </form>
    </div>
</div>