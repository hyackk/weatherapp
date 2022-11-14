<?php

namespace App\Controller;

use App\Entity\Weather;
use App\Form\WeatherType;
use App\Repository\WeatherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/measurement')]
class MeasurementController extends AbstractController
{
    #[Route('/', name: 'app_measurement_index', methods: ['GET'])]
    public function index(WeatherRepository $weatherRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MEASUREMENT_EDIT');
        return $this->render('measurement/index.html.twig', [
            'weather' => $weatherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WeatherRepository $weatherRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MEASUREMENT_EDIT');
        $weather = new Weather();
        $form = $this->createForm(WeatherType::class, $weather, array('validation_groups' => array('NewWeather')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weatherRepository->save($weather, true);

            return $this->redirectToRoute('app_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurement/new.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurement_show', methods: ['GET'])]
    public function show(Weather $weather): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MEASUREMENT_EDIT');
        return $this->render('measurement/show.html.twig', [
            'weather' => $weather,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Weather $weather, WeatherRepository $weatherRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MEASUREMENT_EDIT');
        $form = $this->createForm(WeatherType::class, $weather, array('validation_groups' => array('EditWeather')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weatherRepository->save($weather, true);

            return $this->redirectToRoute('app_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurement/edit.html.twig', [
            'weather' => $weather,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurement_delete', methods: ['POST'])]
    public function delete(Request $request, Weather $weather, WeatherRepository $weatherRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MEASUREMENT_DELETE');
        if ($this->isCsrfTokenValid('delete'.$weather->getId(), $request->request->get('_token'))) {
            $weatherRepository->remove($weather, true);
        }

        return $this->redirectToRoute('app_measurement_index', [], Response::HTTP_SEE_OTHER);
    }
}
