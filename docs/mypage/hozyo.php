<?php
if(isset($post) == true)
{
    $rec = $post;
}

if(empty($rec['task']) == false)
{
    $task = trim($rec['task']);
}
else
{
    $task=null;
}
if(empty($rec['bytime1_1']) == false)
{
    $bytime1_1 = $rec['bytime1_1'];
}
else
{
    $bytime1_1 = null;
}
if(empty($rec['bytime1_2']) == false)
{
    $bytime1_2 = $rec['bytime1_2'];
}
else
{
    $bytime1_2 = null;
}
if(empty($rec['bytime2_1']) == false)
{
    $bytime2_1 = $rec['bytime2_1'];
}
else
{
    $bytime2_1 = null;
}
if(empty($rec['bytime2_2']) == false)
{
    $bytime2_2 = $rec['bytime2_2'];
}
else
{
    $bytime2_2 = null;
}
if(empty($rec['emotion']) == false)
{
    $emotion = $rec['emotion'];
}
else
{
    $emotion = null;
}
if (empty($rec['time1_1']) == false)
{
    $time1_1 = $rec['time1_1'];
}
else
{
    $time1_1 = null;
}
if (empty($rec['time1_2']) == false)
{
    $time1_2 = $rec['time1_2'];
}
else
{
    $time1_2 = null;
}
if (empty($rec['time2_1']) == false)
{
    $time2_1 = $rec['time2_1'];
}
else
{
    $time2_1 = null;
}
if (empty($rec['time2_2']) == false)
{
    $time2_2 = $rec['time2_2'];
}
else
{
    $time2_2 = null;
}
if (empty($rec['attention']) == false)
{
    $attention = trim($rec['attention']);
}
else
{
    $attention = null;
}
if (empty($rec['strong1']) == false)
{
    $strong1 = trim($rec['strong1']);
}
else
{
    $strong1 = null;
}
if (empty($rec['strong2']) == false)
{
    $strong2 = trim($rec['strong2']);
}
else
{
    $strong2=null;
}
if (empty($rec['strong3']) == false)
{
    $strong3 = trim($rec['strong3']);
}
else
{
    $strong3 = null;
}
