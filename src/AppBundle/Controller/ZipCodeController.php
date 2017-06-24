<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation as Doc;

class ZipCodeController extends FOSRestController
{
    /**
     * @Rest\Get("/zipcodes", name="app_api_get_zipcodes")
     *
     * @return View
     *
     * @Doc\ApiDoc(
     *      section="ZipCode",
     *      description="Get the list of all zipcodes.",
     *      statusCodes={
     *          200="Returned when successful",
     *          400="Returned if errors",
     *          500="Returned if server error"
     *      }
     * )
     */
    public function getZipCodesAction()
    {
        return $this->get('app.repository.zipcode')->getAllZipCodes();
    }
}
