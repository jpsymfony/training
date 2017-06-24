<?php

namespace AppBundle\Controller;

use AppBundle\Form\Handler\ContactHandler;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @Rest\Post("/", name="app_api_post_contact")
     *
     * @param Request $request
     *
     * @return View
     *
     * @Rest\Post()
     */
    public function postContactAction(Request $request)
    {
        try {
            $category = $this->get(ContactHandler::class)->create($request);

            return $this->view(
                $category, Response::HTTP_CREATED
            );
        } catch (InvalidFormException $e) {
            return $this->view($e->getForm());
        }
    }
}
