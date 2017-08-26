<?php
ignore_user_abort ( true );
set_time_limit(0);
if ($_POST) {
    file_put_contents('test.txt', json_encode($_POST));
}