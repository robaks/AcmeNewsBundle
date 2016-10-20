<?php

namespace AcmeNewsBundle\Controller;

use AcmeNewsBundle\Entity\News;
use AcmeNewsBundle\Services\NewsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * @Route("/news", name="news_list")
     * @return Response
     */
    public function listAction(Request $request)
    {
        return $this->news($request, 'default/list.html.twig', null);
    }

    /**
     * @Route("/news.xml", name="news_xml_list")
     * @return Response
     */
    public function xmlListAction(Request $request)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

        return $this->news($request, 'default/list.xml.twig', $response);
    }

    /**
     * @Route("/news/{id}", name="show_news")
     * @ParamConverter("news", class="AcmeNewsBundle:News")
     * @param News $news
     * @return Response
     */
    public function newsAction(News $news)
    {
        return $this->render(
            'default/news.html.twig',
            [
                'news' => $news,
            ]
        );
    }

    /**
     * @return Response
     */
    public function hotAction()
    {
        /** @var $newsService NewsService */
        $newsService = $this->container->get('acme.news.service');

        return $this->render(
            'default/hotNews.html.twig',
            [
                'news' => $newsService->getHot(),
            ]
        );
    }

    /**
     * @param Request $request
     * @param $template
     * @param Response $response
     * @return Response
     */
    private function news(Request $request, $template, Response $response = null)
    {
        /** @var $newsService NewsService */
        $newsService = $this->container->get('acme.news.service');

        return $this->render(
            $template,
            [
                'news' => $newsService->getListByPage($request->get('page', 1)),
            ],
            $response
        );
    }
}
