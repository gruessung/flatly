<?php

namespace App\Controller;

use Mni\FrontYAML\Parser;

class DataController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    public function generateData($DATA_PATH, $force = false) {

        $path_config = realpath($DATA_PATH.DIRECTORY_SEPARATOR.'flatly/config.json');
        if (!file_exists($path_config)) {
            $config = [];
        } else {
            $config = json_decode(file_get_contents($path_config), true);
        }
        $data = $this->getDirContents($DATA_PATH.DIRECTORY_SEPARATOR.'content');

        if (!$force && isset($config['cnt_content_files']) && count($data) == $config['cnt_content_files']) return;

        $config['cnt_content_files'] = count($data);
        $slug_to_file = array();
        $nav = array();
        $per_site_type = array();
        $per_site_type['blog_posts'] = [];
        $front_yaml = new Parser();

        foreach($data as $e) {
            if (is_dir($e)) continue;
            $document = $front_yaml->parse(file_get_contents($e));
            if(!isset($document->getYAML()['slug'])) continue;
            if(empty($document->getYAML()['slug'])) continue;
           # var_dump($e);
           # var_dump($document->getYAML()['draft']);
            if(isset($document->getYAML()['draft']) && $document->getYAML()['draft']) continue;
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

      #  dd();

        file_put_contents($DATA_PATH.'/flatly/slug-to-file.json', json_encode($slug_to_file));
        file_put_contents($DATA_PATH.'/flatly/nav.json', json_encode($nav));
        file_put_contents($DATA_PATH.'/flatly/blog_posts.json', json_encode($per_site_type['blog_posts']));
        file_put_contents($DATA_PATH.'/flatly/config.json', json_encode($config));


    }

    function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                //$results[] = $path;
            }
        }

        return $results;
    }

}