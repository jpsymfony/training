<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ContactController extends FOSRestController
{
    /**
     * @param Request $request
     *
     * @Rest\Post("/contact", name="app_api_post_contact")
     *
     * @Rest\View(statusCode=201)
     *
     * @return View
     *
     * @Doc\ApiDoc(
     *      section="Contact",
     *      description="Creates a new contact.",
     *      statusCodes={
     *          201="Returned if contact has been successfully created",
     *          422="Returned if errors",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function postContactAction(Request $request)
    {
        try {
            $contact = $this->get('app.form.handler.contact')->handle($request);

            return $this->view($contact);
        } catch (InvalidFormException $e) {
            return $this->view($e->getForm(), $e->getCode());
        }
    }

    /**
     * @param Contact $contact
     * @param ConstraintViolationListInterface $violations
     *
     * @Rest\Post("/contact-fos", name="app_api_post_contact_fos")
     *
     * @ParamConverter("contact", converter="fos_rest.request_body")
     *
     * @Rest\View(statusCode=201)
     *
     * @return View
     *
     * @Doc\ApiDoc(
     *      section="ContactWithFOS",
     *      description="Creates a new contact.",
     *      statusCodes={
     *          201="Returned if contact has been successfully created",
     *          422="Returned if errors",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function postArticleWithFosContraintAction(Contact $contact, ConstraintViolationListInterface $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->get('app.manager.contact')->save($contact);

        return $this->view($contact, Response::HTTP_CREATED);
    }
}
