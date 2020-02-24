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
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * @Route("/api")
 */
class ParisController extends AbstractController
{
    /**
     * @Route("/paris", name="paris", methods="GET")
     * @param ParisRepository $repository
     * @return Response
     * @SWG\Response(
     *     response=200,
     *     description="Return informations about every boroughs of Paris.",
     *     @Model(type=\App\Entity\Paris::class),
     * )
     * @SWG\Tag(name="Paris boroughs")
     * @Security(name="Bearer")
     */
    public function index(ParisRepository $repository, Request $request)
    {
        if ($request->query->get('maxPrice')) {
            $maxPrice = $request->query->get('maxPrice');
            // if a maximum price is set, we send boroughs in our budget
            $paris = $repository->findWhenCheaperThan($maxPrice);
        } elseif ($request->query->get('order') === 'desc') {
            // sent boroughs sort per costPerDay
            $paris = $repository->findBy([], ['costPerDay' => 'DESC']);
        } else {
            // if we don't specify any parameter
            $paris = $repository->findAll();
        }

        foreach ($paris as $details) {
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
     * @SWG\Response(
     *     response=200,
     *     description="Return informations about one borough of Paris.",
     *     @Model(type=\App\Entity\Paris::class),
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="The field used to get the borough."
     * )
     * @SWG\Tag(name="Paris boroughs")
     * @Security(name="Bearer")
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
     * @SWG\Response(
     *     response=200,
     *     description="Update informations about a borough.",
     *     @Model(type=\App\Entity\Paris::class),
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="The field used to get the borough."
     * )
     * @SWG\Tag(name="Paris boroughs")
     * @Security(name="Bearer")
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
     * @SWG\Response(
     *     response=200,
     *     description="Delete a borough.",
     *     @Model(type=\App\Entity\Paris::class),
     * )
     * @SWG\Parameter(
     *      name="id",
     *      in="path",
     *      type="integer",
     *      description="The field used to get the borough."
     * )
     * @SWG\Tag(name="Paris boroughs")
     * @Security(name="Bearer")
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
     * @SWG\Response(
     *     response=200,
     *     description="Delete a borough.",
     *     @Model(type=\App\Entity\Paris::class),
     * )
     * @SWG\Parameter(
     *      name="borough",
     *      in="query",
     *      type="integer",
     *      description="Zip code of the borough.",
     *      required=true,
     * )
     * @SWG\Parameter(
     *      name="latitude",
     *      in="query",
     *      type="number",
     *      description="Latitude of the borough.",
     *      required=true,
     * )
     * @SWG\Parameter(
     *      name="longitude",
     *      in="query",
     *      type="number",
     *      description="Longitude of the borough.",
     *      required=true,
     * )
     * @SWG\Parameter(
     *      name="district",
     *      in="query",
     *      type="string",
     *      description="District of the borough.",
     *      required=true,
     * )
     * @SWG\Parameter(
     *      name="count_hotel",
     *      in="query",
     *      type="string",
     *      description="Set the number of hotels in the borough.",
     *      required=true,
     * )
     * @SWG\Tag(name="Paris boroughs")
     * @Security(name="Bearer")
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
                'logo_path' =>$relation->getPathLogo()
            ];
        }

        $lines = [];
        foreach($object->getSubwayLines() as $line) {
            $lines[] = [
                'number' => $line->getName(),
                'line_logo' => $line->getLineLogo()
            ];
        }

        return [
            'id' => $object->getId(),
            'color' => 'ok',
            'district' => $object->getDistrict(),
            'borough' => $object->getBorough(),
            'prefix' => $object->getPrefix(),
            'average_hotel_price' => $object->getAverageHotelPrice(),
            'average_restaurant_price' => $object->getAverageRestaurantPrice(),
            'average_cost_per_day' => $object->getCostPerDay(),
            'infrastructure'  =>
                $formattedInfrastructure
            ,
            'lines' => $lines,
        ];
    }
}