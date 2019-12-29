<?php


namespace App\Controller\API;


use App\Entity\Paris;
use App\Repository\ParisRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/api")
 */
class ParisController extends AbstractController
{
    /**
     * @Route("/paris", name="paris", methods="GET")
     * @param ParisRepository $repository
     * @return Response
     */
    public function index(ParisRepository $repository)
    {
        $paris = $repository->findAll();

        foreach($paris as $details)
        {
            $formattedParis[] =
                $this->arrayOfParis($details);
        }

        /*$formattedParis = json_encode($formattedParis);*/

        $response = new JsonResponse($formattedParis);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/paris/{id}", name="api_paris_show", methods={"GET","HEAD"})
     * @param Paris $paris
     * @return Response
     */
    public function show(Paris $paris)
    {
        $response =  $this->arrayOfParis($paris);

        return new JsonResponse($response);

        /*$response->headers->set('Content-Type', 'application/json');

        return $response;*/
    }

    /**
     * @Route("/paris/{id}/edit", name="api_paris_edit", methods={"PUT","PATCH"})
     * @param Paris $paris
     * @return Response
     */
    public function edit(Paris $paris, Request $request)
    {
        $data = $request->getContent();
        $paris = $this->get('jms_serializer')->deserialize($data, $paris, 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($paris);
        $em->flush();

        $response = new Response($paris);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/paris/{id}/delete", name="api_paris_delete", methods="DELETE")
     * @param \App\Entity\Paris $paris
     * @return Response
     */
    public function delete($id, ParisRepository $repo)
    {
        $paris = $repo->findById($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($paris[0]);
        $em->flush();

        return new JsonResponse('Success', Response::HTTP_OK);
    }

    /**
     * @Route("/paris/create", name="api_paris_create", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->getContent();
        $paris = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Paris', 'json');
        $em = $this->getDoctrine()->getManager();
        $em->persist($paris);
        $em->flush();

        return new JsonResponse(['Success'=>'Items was created.'], Response::HTTP_CREATED);
    }

    public function arrayOfParis($object)
    {
        return [
            'id' => $object->getId(),
            'district' => $object->getDistrict(),
            'borough' => $object->getBorough(),
            'nb_hotels' => $object->getCountHotel(),
            'googleMaps' => [
                'type' => 'point',
                'longitude' => $object->getLongitude(),
                'latitude' =>$object->getLatitude()
            ]
        ];
    }
}