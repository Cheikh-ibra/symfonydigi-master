<?php

namespace App\CRUD\Blog;

use App\Entity\Author;

use Doctrine\ORM\EntityManagerInterface;

class AuthorCRUD
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var \App\Repository\Blog\AuthorRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {

        $this->em = $em;
        $this->repo = $em->getRepository('App:Author');

    }

    /**
     * @param Author $author
     */
    private function persist(Author $author)
    {
        $this->em->persist($author);
        $this->em->flush();
    }

    public function add(Author $author): void
    {
        $this->em->persist($author);
        $this->em->flush();
    }

    /**
     * @param Author $author
     */
    public function update(Author $author): void
    {
        $this->em->persist($author);
        $this->em->flush();
    }

    /**
     * @param int $id
     * @return Author
     */
    public function getOneById(int $id): Author
    {
        return  $this->repo->find($id);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return  $this->repo->findAll();
    }

    /**
     * @param Author $author
     */
    public function delete(Author $author): void
    {
        $this->em->remove($author);
        $this->em->flush();
    }

}