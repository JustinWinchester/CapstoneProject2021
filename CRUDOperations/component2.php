<?php

// inputElement adds an input form that has a placeholder text until the user inputs text
function inputElement($icon, $placeholder, $name, $value){
    $ele = "

        <div class=\"input-group mb-2\">
                        <div class=\"input-group-prepend\">
                            <div class=\"input-group-text bg-warning\">$icon</div>
                        </div>
                        <input type=\"text\" name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\" id=\"inlineFormInputGroup\" placeholder=\"Username\">
                    </div>

    ";
    echo $ele;
}

// inputElement adds an input form that has a placeholder text until the user inputs text
function inputElement2( $placeholder, $name, $value){
    $ele = "

        <div class=\"input-group mb-2\">
                        <div class=\"input-group-prepend\">
                                                 
                        <input type=\"text\" name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\" id=\"inlineFormInputGroup\" placeholder=\"Username\">
                    </div>

    ";
    echo $ele;
}

// buttonElement adds a stylized button with text and an id to link to an action
function buttonElement($btnid, $styleclass, $text, $name, $attr){
    $btn = "
        <button name='$name' '$attr' class='$styleclass' id='$btnid'>$text</button>
    ";
    echo $btn;
}
