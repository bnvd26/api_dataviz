<?php


namespace App\Controller\API;


use App\Entity\Infrastructure;
use App\Entity\Paris;
use App\Repository\ParisRepository;
use JMS\Serializer\SerializerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

        // $formattedParis = json_decode($formattedParis);

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
     * @Route("/paris/{id}/edit", name="api_paris_edit", methods={"PUT","PATCH", "GET"})
     * @param Paris $paris
     * @return Response
     */
    public function edit(Paris $paris, Request $request, ParisRepository $repository)
    {
        $data = $request->getContent();
        $data_decoded = json_decode($data, true);

        $paris = $repository->find($paris->getId());

        if(!empty($data_decoded)) {
            $paris->setBorough(isset($data_decoded['borough']) ? $data_decoded['borough'] : $paris->getBorough());
            $paris->setLatitude(isset($data_decoded['latitude']) ? $data_decoded['latitude'] : $paris->getLatitude());
            $paris->setLongitude(isset($data_decoded['longitude']) ? $data_decoded['longitude'] : $paris->getLongitude());
            $paris->setDistrict(isset($data_decoded['district']) ? $data_decoded['district'] : $paris->getDistrict());
            $paris->setCountHotel(isset($data_decoded['count_hotel']) ? $data_decoded['count_hotel'] : $paris->getCountHotel());
            $em = $this->getDoctrine()->getManager();
            $em->persist($paris);
            $em->flush();
        }

        return new RedirectResponse('/api/paris/'.$paris->getId());
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
        $paris = new Paris();
        $data_decoded = json_decode($data, true);
        $paris->setBorough($data_decoded['borough']);
        $paris->setLatitude($data_decoded['latitude']);
        $paris->setLongitude($data_decoded['longitude']);
        $paris->setDistrict($data_decoded['district']);
        $paris->setCountHotel($data_decoded['count_hotel']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($paris);
        $em->flush();

        return new JsonResponse(['Success'=>'Items was created.'], Response::HTTP_CREATED);
    }

    public function arrayOfParis($object)
    {
        $formattedInfrastructure = [];

        foreach($object->getInfrastructures() as $relation )
        {
            $formattedInfrastructure[] = [
                'site' => $relation->getSite(),
                'sports' => $relation->getSports(),
            ];
        }

        return [
            'id' => $object->getId(),
            'district' => $object->getDistrict(),
            'borough' => $object->getBorough(),
            'nb_hotels' => $object->getCountHotel(),
            'infrastructure'  =>
                (object) $formattedInfrastructure
            ,
            'googleMaps' => [
                'type' => 'point',
                'longitude' => $object->getLongitude(),
                'latitude' =>$object->getLatitude()
            ]
        ];
    }
}