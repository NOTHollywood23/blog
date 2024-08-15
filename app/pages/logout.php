<?php

if(!empty($_SESSION['USER'])) {
    unset($_SESSION['USER']); // Add the missing semicolon
}

redirect('<?=ROOT?>/home');
