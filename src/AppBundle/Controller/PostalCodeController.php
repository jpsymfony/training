<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("api/{version}")
 */
class PostalCodeController extends FOSRestController
{
    /**
     * @Rest\Get("/autocomplete/postal-codes/{postalCode}", name="app_api_get_postalcodes", options={"expose"=true})
     *
     * @return View
     *
     * @Doc\ApiDoc(
     *      section="PostalCode",
     *      description="Get the list of all postalcodes.",
     *      statusCodes={
     *          200="Returned when successful",
     *          400="Returned if errors",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function getPostalCodesAction($postalCode)
    {
        return $this->get('app.repository.postalcode')->getByPostalCode($postalCode);
    }
}
