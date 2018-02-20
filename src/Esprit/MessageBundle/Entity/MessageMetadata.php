<?php

namespace Esprit\MessageBundle\Entity;;

use Doctrine\ORM\Mapping as ORM;

use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**

 * @ORM\Entity

 * @ORM\Table(name ="messagemetadata")

 */

class MessageMetadata extends BaseMessageMetadata

{

    /**

     * @ORM\Id

     * @ORM\Column(type="integer")

     * @ORM\GeneratedValue(strategy="AUTO")

     */

    protected $id;



    /**

     * @ORM\ManyToOne(

     *   targetEntity="Esprit\MessageBundle\Entity\Message",

     *   inversedBy="metadata"

     * )

     * @var \FOS\MessageBundle\Model\MessageInterface

     */

    protected $message;



    /**

     * @ORM\ManyToOne(targetEntity="Esprit\UserBundle\Entity\User")

     * @var \FOS\MessageBundle\Model\ParticipantInterface

     */

    protected $participant;

}
