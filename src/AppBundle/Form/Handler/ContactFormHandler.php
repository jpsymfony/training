<?php
namespace AppBundle\Form\Handler;

use AppBundle\Entity\Contact;
use AppBundle\Exception\InvalidFormException;
use AppBundle\Form\Type\ContactType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\ContactManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ContactFormHandler implements FormHandlerInterface
{
    /**
     *
     * @var ContactManagerInterface
     */
    private $manager;

    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @param ContactManagerInterface $contactManager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(ContactManagerInterface $contactManager, FormFactoryInterface $formFactory)
    {
        $this->manager = $contactManager;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function handle(Request $request)
    {
        $form = $this->formFactory->create(
            ContactType::class,
                new Contact(),
                ['method' => $request->getMethod()]);

        // to work, we have to pass the entity name as key, like:
        // {"contact": {"gender": "mister", "lastName": "Brau", "firstName": "laurent"}}
        //$form->handleRequest($request);

        // to work, we don't have to pass the entity name as key, like:
        // {"gender": "mister", "lastName": "Brau", "firstName": "laurent"}
        $form->submit($request->request->all(), $request->getMethod() !== 'PATCH');

        if ($form->isSubmitted() && !$form->isValid()) {
            throw new InvalidFormException('Invalid submitted data', Response::HTTP_UNPROCESSABLE_ENTITY, $form);
        }

        $contact = $form->getData();
        $this->manager->save($contact);

        return $contact;
    }
}