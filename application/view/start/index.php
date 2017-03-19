<div class="container">
    <h2>Log Generator Example</h2>
    <p>If you answer the questions with incorrect answers or input, the invalid answer submitting will be logged. </p>
    <div class="box">
        <form id="form" class="text-left" action="<?php echo URL ?>start/process" method="POST">
            1. What is 50 multiplied by 5?
            <br>
            <input type="text" id="question_one" value="" name="question_one">
            <br>
            2. Write the name of the former president of the United States of America.
            <br>
            <input type="text" id="question_two" value="" name="question_two">
            <br>
            <input type="submit" name="submit" class="button" value="Submit">
            <br>
        </form>
    </div>
</div>
