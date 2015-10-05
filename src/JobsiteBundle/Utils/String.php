<?php
namespace JobsiteBundle\Utils;

class String
{
    static public function slugify($text)
    {
        // trim and lowercase
        $text = strtolower(trim($text));
        $text = str_replace(' ','-',$text);
        // replace all non letters or digits by -
        $text = preg_replace('/[^a-zA-Z0-9]/s', '-', $text);

        return $text;
    }
}