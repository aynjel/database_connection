<?php

function textNode($text, $class){
    $element = "
        <div class='$class' role='alert'>
            $text
        </div>
    ";
    echo $element;
}