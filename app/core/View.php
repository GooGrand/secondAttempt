<?php


class View
{
    /*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	*/
    function generate($content_view, $template_view, $data = null)
    {

        include 'app/views/'.$template_view;
    }
}