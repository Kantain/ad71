<?php
namespace pw\Services;
use Doctrine\ORM\EntityManager;
use DUT\Models\Commentaire;
use DUT\Models\Article;
use Silex\Application;

class BDServices
{

    private $entityManager;

    public function __construct($app)
    {
        $this->entityManager = $app["em"];
    }

    public function deleteCommFor($idArticle)
    {
        /** @var Commentary $item */
        $repository = $this->entityManager->getRepository("DUT\\Models\\Commentaire");
        $items = $repository->findBy(["id_article" => $idArticle]);
        if (isset($items)) {
            foreach ($items as $item) {
                $this->removeReactionFor($idArticle, $item->getIdCommentary());
                $this->entityManager->remove($item);
            }
            $this->entityManager->flush();
        }
    }
   
    public function removeComm($idArticle, $idComm)
    {
        $repository = $this->entityManager->getRepository("DUT\\Models\\Commentaire");
        $item = $repository->findOneBy(["id_article" => $idArticle, "id_commentaire" => $idComm]);
        if (isset($item)) {
            $this->entityManager->remove($item);
            $this->entityManager->flush();
        }
    }
    
    public function getCommArticle($idArticle)
    {
        $repository = $this->entityManager->getRepository("DUT\\Models\\Commentaire");
        $items = $repository->findBy(["id_article" => $idArticle]);
        if (!isset($items)) {
            $items = [];
        }
        return $items;
    }
    
    public function getComm($idArticle, $idComm)
    {
        $repository = $this->entityManager->getRepository("DUT\\Models\\Commentaire");
        return $repository->findOneBy(["id_article" => $idArticle, "id_commentaire" => $idComm]);
    }

    public function addComm(Commentaire $comm)
    {
        $comm->setCommId($this->getCommArticle($comm->getIdArticle()));
        $this->addObj($comm);
    }
    
    public function getNombreComm($idArticle)
    {
        $comms = $this->getCommArticle($idArticle);
        $maxID = 1;
        if (isset($comms)) {
            $dernierComm =  $comms[sizeof($comms) - 1];
            $max = $dernierComm->getId() + 1;
        }
        return $max;
    }

    public function addObj($objet) {
        $this->entityManager->merge($objet);
        $this->entityManager->flush();
    }
}