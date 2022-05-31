<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/articles', name: 'article_')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'listing')]
    public function articles(ArticleRepository $articleRepository): \Symfony\Component\HttpFoundation\Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('article/articles.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/new', name: 'new')]
    public function articleNew(Request $request, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        $newArticle = new Article();
        $form = $this->createForm(ArticleType::class, $newArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $this->getUser();
            $articleToSave = $form
                ->getData()
                ->setUser($user);
            $entityManager->persist($articleToSave);
            $entityManager->flush();
            $this->addFlash('success', 'Votre article à été créé avec succès ! ');
            return $this->redirectToRoute('article_listing');
        }

        return $this->render('article/articleNew.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'detail')]
    public function articleDetail ($id, ArticleRepository $articleRepository): \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        $article = $articleRepository->findOneBy([
            'id' => $id ]);

        if (!$article) {
            $this->addFlash('warning', 'Aucun article trouvé.');
            return $this->redirectToRoute('article_listing');
        }

        return $this->render('article/articleDetail.html.twig', [
            'article' => $article
        ]);
    }
}
