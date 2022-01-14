<?php

namespace App\Http\App\Controller\Forum;

use App\Application\Forum\Command\TagCommand;
use App\Application\Forum\Dto\TagDto;
use App\Domain\Forum\Entity\Tag;
use App\Domain\Forum\Repository\TagRepository;
use App\Http\Form\Forum\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Http\App\Controller\Forum
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @Route("/admin/forum/tag")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", name="app_tag")
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();

        return $this->render('admin/forum/tag/index.html.twig', [
            'tags' => $tags
        ]);
    }

    /**
     * @param Request $request
     * @param TagCommand $tagCommand
     * @param Tag|null $tag
     * @return Response
     * @Route("/update/{id}", name="update_tag")
     * @Route("/create", name="create_tag")
     */
    public function create(Request $request, TagCommand $tagCommand, ?Tag $tag = null) : Response
    {
        $tag == null ? 
            $tagDto = new TagDto(new Tag()) :
            $tagDto = new TagDto($tag)
            ;

        $form = $this->createForm(TagType::class, $tagDto);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $tagDto->id == null ? 
                $tagCommand->create($tagDto) :
                $tagCommand->update($tagDto)
                ;

            return $this->redirectToRoute('app_tag');
        }

        return $this->render('admin/forum/tag/set_tag.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_tag")
     */
    public function update(Tag $tag, TagCommand $tagCommand): Response
    {
        $tagCommand->delete($tag);
        return $this->redirectToRoute('app_tag');
    }
}
