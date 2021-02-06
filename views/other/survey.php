<?php

if(isset($_SESSION['userId'])):

    $query = executeQuery("SELECT * FROM survey_submissions WHERE user_id=".$_SESSION['userId']);
    $submitted = [];
    foreach($query as $el){
        if(!in_array($el->survey, $submitted)){
            array_push($submitted, $el->survey);
        }
    }
?>

<div class="col-12 mt-5 mb-5 pt-5 pb-5 d-flex justify-content-center">
    <div class="col-lg-6 col-sm-12">
        <?php
        $surveys = executeQuery("SELECT id, name FROM survey WHERE active=1");
        foreach($surveys as $survey):
            if(!in_array($survey->id, $submitted)):
        ?>
        <form action="models/other/survey_submit.php" method="POST" id="submit_form_<?= $survey->id ?>" name="submit_form_<?= $survey->id ?>">
            <input type="hidden" name="survey<?= $survey->id ?>" value="<?= $survey->id ?>"/>
            <div class="col-12 mb-5 pb-3 border-bottom">
                <h4><?= $survey->name ?></h4>
                <div class="col-12 mt-4">
                    <?php
                    $questions = executeQuery("SELECT * FROM survey_questions WHERE survey=".$survey->id);
                    foreach($questions as $question):
                    ?>

                    <div class="col-12 d-flex flex-wrap mt-3 mb-3">
                        <div class="col-lg-6 col-sm-12">
                            <p class="h6"><?= $question->name ?></p>
                            <input type="hidden" name="question<?= $question->id ?>" value="<?= $question->id ?>"/>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <select class="form-select" aria-label="Default select example" name="<?= $question->id ?>">
                                <?php
                                $answers = executeQuery("SELECT * FROM survey_question_answers WHERE survey=$survey->id AND question=$question->id");
                                foreach($answers as $answer):
                                ?>

                                <option value="<?= $answer->id ?>"><?= $answer->content ?></option>

                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <?php
                    endforeach;
                    ?>

                    <div class="col-12 mb-3 text-center">
                        <input type="submit" name="submit_survey_btn" id="submit_survey_btn" value="Submit this Survey." class="btn btn-primary"/>
                    </div>
                </div>
            </div>
        </form>

        <?php
        else:
        ?>

        <p class="h5 text-center mb-3 border-bottom pb-3">"<?= $survey->name ?>" survey already submitted.</p>

        <?php
        endif;
        endforeach;
        ?>
    </div>
</div>

<?php
else:
    echo '<div class="col-12 mt-5 mb-5 pt-5 pb-5"><h3 class="text-center">Log in to access this page.</h3></div>';
endif;
?>

<div class="col-12 d-flex justify-content-center mt-5 mb-5 pt-3 pb-3">
    <div class="col-lg-6 col-sm-12 d-flex flex-wrap">
        <?php
        $surveys = executeQuery("SELECT id, name FROM survey WHERE active=1");
        foreach($surveys as $survey):
        ?>

        <div class="col-lg-6 col-sm-12 border-left">
            <p class="h4"><?= $survey->name ?></p>
            <?php
            $questions = executeQuery("SELECT * FROM survey_questions WHERE survey=".$survey->id);
            foreach($questions as $question):
            ?>

            <p>
                <span class="text-danger"><?= $question->name ?></span>
                <br/>
                <?php
                $answers = executeQuery("SELECT * FROM survey_question_answers WHERE survey=$survey->id AND question=$question->id");
                foreach($answers as $answer):
                    $cnt = executeQuery("SELECT COUNT(id) as cnt FROM survey_submissions WHERE question=".$answer->id)[0];
                ?>

                <?= $answer->content ?> -> <?= $cnt->cnt ?>
                <br/>

                <?php
                endforeach;
                ?>

            </p>

            <?php
            endforeach;
            ?>
        </div>

        <?php
        endforeach;
        ?>
    </div>
</div>
