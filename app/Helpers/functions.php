<?php

function setActive($path)
{

    return Request::is($path.'*') ? 'active' :  '';
}
