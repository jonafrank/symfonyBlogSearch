<?php
namespace AppBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
/**
 * PostRepository Test
 */
class PostRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }
    public function testGetAllQuery()
    {
        $query = $this->em->getRepository('AppBundle:Post')
            ->getAllQuery();
        $this->assertEquals("SELECT p FROM AppBundle\Entity\Post p", $query->getDql());
    }

    /**
    * {@inheritDoc}
    */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}
