<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Show;
class ShowController extends AbstractController
{
    /**
     * @Route("/show", name="show")
     */
    public function index(): Response
    {
                $repository = $this->getDoctrine()->getRepository(Show::class);
        $shows = $repository->findAll();
        
        return $this->render('show/index.html.twig', [
            'shows' => $shows,
            'resource' => 'spectacles',
        ]);

    }
	    /**
     * @Route("/show/{id}", name="show_show")
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Show::class);
        $show = $repository->find($id);
//Récupérer les artistes du spectacle et les grouper par type
        $collaborateurs = [];
        
        foreach($show->getArtistTypes() as $at) {
            $collaborateurs[$at->getType()->getType()][] = $at->getArtist();
        }

        return $this->render('show/show.html.twig', [
            'show' => $show,
	        'collaborateurs' => $collaborateurs,
        ]);
    }

}
