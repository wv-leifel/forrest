<?php

namespace spec\Leifel\ForrestAdmin\Repositories;

use Leifel\ForrestAdmin\Repositories\VersionRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Leifel\ForrestAdmin\Interfaces\StorageInterface;
use Leifel\ForrestAdmin\Exceptions\MissingVersionException;

class VersionRepositorySpec extends ObjectBehavior
{
    public function let(StorageInterface $mockedStorage) {
        $this->beConstructedWith($mockedStorage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(VersionRepository::class);
    }

    function it_should_store_version($mockedStorage) {
        $mockedStorage->put('version', '39.0')->shouldBeCalled();
        $this->put('39.0');
    }

    function it_should_get_version($mockedStorage) {
        $mockedStorage->has('version')->shouldBeCalled()->willReturn(true);
        $mockedStorage->get('version')->shouldBeCalled()->willReturn('39.0');
        $this->get()->shouldReturn('39.0');
    }

    function it_should_throw_exception_if_version_doesnt_exist($mockedStorage) {
        $mockedStorage->has('version')->shouldBeCalled()->willReturn(false);
        $missingVersionException = new MissingVersionException('No version available');

        $this->shouldThrow($missingVersionException)->duringGet();
    }

}
