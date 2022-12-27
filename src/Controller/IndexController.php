<?php

namespace App\Controller;

use Mni\FrontYAML\Parser;
use Parsedown;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    public function __construct(private readonly string $DATA_PATH)
    {

    }

    private function getNavigationArray(): array
    {
        $config = json_decode(file_get_contents($this->DATA_PATH.'/flatly/nav.json'), true);
        $nav = array();
        foreach ($config as $i => $e) {
            $nav[$e['weight']] = $e;
        }

        krsort($nav, SORT_NUMERIC);
        return $nav;
    }


    private function getContentFromFile(string $slug): array
    {
        $slugs_to_site_types = json_decode(file_get_contents($this->DATA_PATH.'/flatly/slug-to-file.json'), true);
        if (key_exists($slug, $slugs_to_site_types)) {
            $front_yaml = new Parser();
            $document = $front_yaml->parse(file_get_contents($this->DATA_PATH.'/content/' . $slugs_to_site_types[$slug]));
            $return = [
                'meta' => $document->getYAML(),
                'content' => $document->getContent(),
                'parsed' => Parsedown::instance()->text($document->getContent()),
                'site_type' => (key_exists('site_type', $document->getYAML()) ? $document->getYAML()['site_type'] : '')
            ];
            return array_merge($return, $document->getYAML());
        } else {
            return [
                'parsed' => Parsedown::instance()->text('## 404 - Nicht gefunden!'),
            ];
        }
    }

    private function getPosts($tag = "", $start_at = 0, $limit = 100): array
    {
        $data = json_decode(file_get_contents($this->DATA_PATH.'/flatly/blog_posts.json'), true);
        $posts = [];
        foreach ($data as $e) {
            if (!empty($tag)) {
                if (isset($e['tags']) && in_array($tag, $e['tags'])) {
                    $posts[$e['date']] = $e;
                }
            } else {
                $posts[$e['date']] = $e;
            }
        }

        krsort($posts, SORT_NUMERIC);

        //if ($start_at)
        return $posts;
    }


    #[Route(path: '/', name: 'index')]
    public function showIndex(Request $request): Response
    {

        (new DataController())->generateData($this->DATA_PATH);

        return $this->render('base.html.twig', ['body' => '', 'site_type' => 'blog_list', 'posts' => $this->getPosts(), 'nav' => $this->getNavigationArray()]);
    }


    #[Route(path: '/tag/{tag}', name: 'tag')]
    public function showBlogListByTag(Request $request): Response
    {
        return $this->render('base.html.twig', ['body' => '', 'site_type' => 'blog_list', 'posts' => $this->getPosts($request->attributes->get('tag', '')), 'nav' => $this->getNavigationArray()]);
    }

    #[Route(path: '/{slug}', name: 'content', requirements: ['slug' => '.+'])]
    public function showContent(Request $request): Response
    {
        $data = $this->getContentFromFile($request->attributes->get('slug'));
        return $this->render('base.html.twig', array_merge($data, ['body' => $data['parsed'], 'nav' => $this->getNavigationArray()]));
    }


}

