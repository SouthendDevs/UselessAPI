<?php

function resources_path($path = '')
{

    return base_path('/resources/assets' . ($path ? DIRECTORY_SEPARATOR.$path : $path));

}
