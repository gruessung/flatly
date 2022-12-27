<?php

namespace App\Controller;

use Mni\FrontYAML\Parser;

class DataController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    public function generateData($DATA_PATH) {

        $data = $this->getDirContents($DATA_PATH.DIRECTORY_SEPARATOR.'content');
        $slug_to_file = array();
        $nav = array();
        $per_site_type = array();
        $front_yaml = new Parser();
       // dd($data);
        foreach($data as $e) {
            if (is_dir($e)) continue;
            $document = $front_yaml->parse(file_get_contents($e));
            if(!isset($document->getYAML()['slug'])) continue;
            if (isset($document->getYAML()['nav_visibility']) && isset($document->getYAML()['title'])) {
                $weight = (isset($document->getYAML()['nav_weight'])) ? $document->getYAML()['nav_weight'] : 0;
                $nav[] = [
                    'slug' => $document->getYAML()['slug'],
                    'title' => $document->getYAML()['title'],
                    'weight' => $weight
                ];
            }

            //save per site_type
            if (isset($document->getYAML()['site_type'])) {
                $per_site_type['blog_posts'][] = $document->getYAML();
            }

            $slug_to_file[$document->getYAML()['slug']] = str_replace(realpath($DATA_PATH.'/content'), '',$e);

        }

        file_put_contents($DATA_PATH.'/flatly/slug-to-file.json', json_encode($slug_to_file));
        file_put_contents($DATA_PATH.'/flatly/nav.json', json_encode($nav));
        file_put_contents($DATA_PATH.'/flatly/blog_posts.json', json_encode($per_site_type['blog_posts']));


    }

    function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

}