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
        // if a maximal price is set
        if ($request->query->get('maxPrice')) {
            $maxPrice = $request->query->get('maxPrice');
            $limitPrice = $maxPrice * 1.10;
            $paris = [];
            $index = 0;

            $paris[] = $repository->findWhenCheaperThan($maxPrice);
            $paris[] = $repository->FindBetween($maxPrice, $limitPrice);
            $paris[] = $repository->findMoreExpensive($limitPrice);
            foreach ($paris as $slice) {
                $tmp = [];
                foreach ($slice as $details) {
                    $occurrencesTotal = 0;
                    $flag = false;
                    $data = $this->arrayOfParis($details, $index);

                    // if the user has selected sports he wants to watch
                    if ($request->query->get('sports') && $index === 0) {
                        $sports = \explode(',', $request->query->get('sports'));
                        $infras = \json_decode(\json_encode($data['infrastructure']), true);
                        foreach ($infras as $infra) {
                            $occurrences = \array_intersect($infra['sports'], $sports);
                            $occurrencesTotal += \count($occurrences);
                            // if there is some sports that the user wants to see in this borough we set the flag to true
                            if (!empty($occurrences)) $flag = true;
                        }
                    }
                    // if we have found sports that the user want to see in the borough we have to put it on the top in order to give him the best results
                    if ($flag) {
                        $tmp[] = [
                            $data,
                            'occurences' => $occurrencesTotal,
                        ];
                    } else {
                        $formattedParis[] = $data;
                    }
                }
                if ($index === 0) {
                    // we sort the array to insert it into $formattedParis, the borough with the maxiumum occurences will be in index 0
                    $occurrences = \array_column($tmp, 'occurences');
                    \array_multisort($occurrences, SORT_ASC, $tmp);
                    foreach ($tmp as $arrayTmp) {
                        \array_unshift($formattedParis, $arrayTmp);
                    }

                }
                $index++;
            }
        } elseif ($request->query->get('order') === 'desc') {
            // sent boroughs sort per costPerDay
            $paris = $repository->findBy([], ['costPerDay' => 'DESC']);
        } else {
            // if we don't specify any parameter
            $paris = $repository->findAll();
        }

        if (!$request->query->get('maxPrice')) {
            foreach ($paris as $details) {
                $formattedParis[] =
                    $this->arrayOfParis($details);
            }
        }


        // $formattedParis = json_decode($formattedParis);

        $response = new JsonResponse($formattedParis);

	$response->setStatusCode(Response::HTTP_OK);

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
     *
     * @param $object
     * @param null $index
     * @return array
     */
    public function arrayOfParis($object, $index = null)

    {
        $formattedInfrastructure = [];

        if($index === 0) {
            $index = '#5DD167';
        } elseif($index === 1){
            $index = '#FFCA0C';
        } elseif($index === 2) {
            $index = '#F77700';
        } else {
            $index = null;
        }

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
            'colorPrice' => $index,
            'district' => $object->getDistrict(),
            'borough' => $object->getBorough(),
            'prefix' => $object->getPrefix(),
            'average_hotel_price' => $object->getAverageHotelPrice(),
            'average_restaurant_price' => $object->getAverageRestaurantPrice(),
            'average_cost_per_day' => $object->getCostPerDay(),
            'coordinates' => $object->getPolygon(),
            'infrastructure'  =>
                $formattedInfrastructure
            ,
            'lines' => $lines,
        ];
    }
}
