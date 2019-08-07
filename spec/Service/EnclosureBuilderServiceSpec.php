<?php

namespace spec\App\Service;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
use App\Factory\DinosaurFactory;
use App\Service\EnclosureBuilderService;
use App\Service\EntityManagerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnclosureBuilderServiceSpec extends ObjectBehavior
{
    function let(DinosaurFactory $dinosaurFactory, EntityManagerInterface $manager)
    {
        $this->beConstructedWith($dinosaurFactory, $manager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EnclosureBuilderService::class);
    }

    function it_builds_enclosure_with_dinosaurs(DinosaurFactory $dinosaurFactory, EntityManagerInterface $manager)
    {
        $dino1 = new Dinosaur('Stegosaurus', false);
        $dino1->setLength(6);

        $dino2 = new Dinosaur('Baby Stegosaurus', false);
        $dino2->setLength(2);

        $dinosaurFactory
            ->growVelociraptor(Argument::type('integer'))
            ->willReturn($dino1, $dino2);

        $enclosure = $this->buildEnclosure(1, 2);

        $enclosure->shouldBeAnInstanceOf(Enclosure::class);
        $enclosure->isSecurityActive()->shouldReturn(true);
        $enclosure->getDinosaurs()[0]->shouldBe($dino1);
        $enclosure->getDinosaurs()[1]->shouldBe($dino2);

        $dinosaurFactory
            ->growVelociraptor(Argument::any())
            ->shouldBeCalledTimes(2);

        $manager
            ->persist(Argument::type(Enclosure::class))
            ->shouldHaveBeenCalled();
        $manager
            ->flush()
            ->shouldHaveBeenCalled();
    }
}
