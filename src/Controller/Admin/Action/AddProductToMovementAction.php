<?php

declare(strict_types=1);

namespace Nextstore\SyliusInventoryPlugin\Controller\Admin\Action;

use Doctrine\ORM\EntityManagerInterface;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovement;
use Nextstore\SyliusInventoryPlugin\Form\Type\AddProductToMovementType;
use Nextstore\SyliusInventoryPlugin\Model\InventoryMovementInterface;
use Nextstore\SyliusInventoryPlugin\Service\InventoryMovementService;
use PhpParser\Node\Expr\Print_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AddProductToMovementAction extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private InventoryMovementService $inventoryMovementService,
        private Environment $twig
    ) {
    }

    public function __invoke(Request $request, $id)
    {
        $referer = (string) $request->headers->get('referer');
        $inventoryMovement = $this->em->getRepository(InventoryMovementInterface::class)->find((int) $id);

        $form = $this->createForm(AddProductToMovementType::class, $inventoryMovement, [
            'warehouse' => $inventoryMovement->getWarehouse()->getCode()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->inventoryMovementService->addProductToMovement($data);
            $this->addFlash('success', 'Successfully added product to movement');
            return new RedirectResponse($referer);
        }

        return new Response($this->twig->render('@NextstoreSyliusInventoryPlugin/Admin/InventoryMovement/add_product.html.twig', [
            'movement' => $inventoryMovement,
            'form' => $form->createView()
        ]));
    }
}
